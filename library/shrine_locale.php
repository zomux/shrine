<?php
	class RLocale{
		public static $LOCALE_LANG=null;
		public static $LOCALE_ENCODING=null;
		public static $CACHER=null;
		public static $MODE='service';
		public static function setMode($szMode){
			if( in_array($szMode,array( 'view','style','controller','service' )) ){
				RLocale::$MODE = $szMode;
			}
		}
		public static function SetLocale($szLocale){
			RLocale::$LOCALE_LANG=$szLocale;
			return true;
		}
		public static function SetEncoding($encoding){
			if(strtolower($encoding) != 'utf8' && strtolower($encoding) != 'utf-8'){
				RLocale::$LOCALE_ENCODING = strtolower($encoding);
			}
			return true;
		}
		public static function SetLanguage($szLang){
			return RLocale::SetLocale($szLang);
		}
		public static function Transform($file,$locale=null,$pathLocale=null){
			global $_CONFIG;
			$lang='default';
			$path=$pathLocale;
			if($locale){
				$lang=$locale;
			}else if(RLocale::$LOCALE_LANG){
				$lang=RLocale::$LOCALE_LANG;
			}else if(is_array($_CONFIG) && array_key_exists('locale',$_CONFIG) ){
				$lang=$_CONFIG['locale'];
			}
			
			if(!$path && array_key_exists('app_name', $_CONFIG) && $_CONFIG['app_name']){
				$path=RShrine::AppPath($_CONFIG['app_name']).'locales/';
				/* build path */
				if(RLocale::$MODE!='service') $path.=RLocale::$MODE.'s/';
				if( !file_exists($path) ) mkdir($path);
				
			}
			/* return orignal file  */
			
			if(!$path) return RLocale::_Transform($file);	
			$posSplitter=strrpos($file, '/');
			$fileLocale = null;
			$fileName=substr($file , $posSplitter+1,strlen($file)-$posSplitter-1);
			if($lang) $fileLocale=$path.$fileName.'$'.$lang.'.txt';
			if(file_exists($fileLocale)) return RLocale::_Transform($file,$path.$fileName.'$default.txt',$fileLocale,$lang);
			return RLocale::_Transform($file,$path.$fileName.'$default.txt');
			
			
		}
		public static function _Transform($file,$fileDefault=null,$fileLocale=null,$lang=null){
			$lang=strtolower($lang);
			RLocale::InitCacher();
			$timeFile = filemtime($file);
			if($lang){
				$fileToken=convert_to_under($file).'$'.$lang;
				
				$timeLocale = filemtime($fileLocale);
				if($timeLocale > $timeFile) $timeFile=$timeLocale;
			}else{
				$fileToken=convert_to_under($file).'$default';
			}
			
			$fileOutput=RLocale::$CACHER->load($fileToken,$timeFile) && false;
			if($fileOutput) return $fileOutput;
			/** do locale transform **/
			$text=file_get_contents($file);
			/* sec : take out orignal strs */
			$i=-1;
			$lenText=strlen($text)-1;
			$arOrig=array();
			$chrEndStr = null;
			$curOrig = null;
			$modRecord = false;
			while($i<$lenText){
				$i++;
				$chr = $text[$i];
				if(( $chr =='\'' || $chr=='"' ) && (RLocale::$MODE=='controller' || RLocale::$MODE=='service')){
					if($i>0 && $text[$i-1]!='\\'){
						if(!$chrEndStr){
							/* str mod enter */
							$chrEndStr = $chr ;
							continue;
						}
						if( $chrEndStr == $chr  ){
							/* str mod out */
							$chrEndStr = null;
							continue;
						}
					}
				}
				if( !$chrEndStr && (RLocale::$MODE=='controller' || RLocale::$MODE=='service')) continue;
				
				if($modRecord && $chr=="\n"){
					/* break line is not allowed */
					$curOrig = null;
					$modRecord=false;
				}
				
				if( $chr == '|' ){
					if( $i<$lenText && $text[$i+1]!='|' ){
						/*record mod change */
						if($modRecord){
							
							$arOrig[$curOrig]= null;
							$curOrig = null;
							$modRecord=false;
						}else{
							$curOrig = '';
							$modRecord=true;
						}
						continue;
						
					}
					/* special tansmission chr , ignore next chr */
					$i++;
				}
				if($modRecord){
					$curOrig.=$chr;
				}
			}
			
			/* /sec : take out */
			if($fileDefault){
				/* export default struct */
				
				$szOutput='';
				foreach($arOrig as $k=>$v){
					$szOutput.= '['.$k."]\r\n";
					
				}
				
				file_put_contents($fileDefault,$szOutput);
				
			}
			if($fileLocale){
				$txtLocale=file_get_contents($fileLocale)."\n";
				$lenTxt=strlen($txtLocale);
				$i=0;
				$szCurLine='';
				$szCurKey=null;
				$szCurValue=null;
				$arLocale=array();
				/* take out the locale values to arLocale and add to arOrig */
				while($i<$lenTxt){
					$chr=$txtLocale[$i];
					
					switch($chr){
						case "\n":
							$szCurLine = trim($szCurLine);
							if(strlen($szCurLine)>0 && $szCurLine[0]=='[' && $szCurLine[strlen($szCurLine)-1]==']'){
								/* current line is the key */
								
								if( $szCurKey && $szCurValue){
									/* make the value not break line */
									while($szCurValue[strlen($szCurValue)-1]=="\r" || $szCurValue[strlen($szCurValue)-1]=="\n"){
										$szCurValue=substr($szCurValue,0,strlen($szCurValue)-1);
									}
									$arLocale[$szCurKey]=$szCurValue;
								}
								$szCurLine=str_replace(array("\r"),'',$szCurLine);
								$szCurKey = substr($szCurLine,1,strlen($szCurLine)-2);
								$szCurValue = null;
							}else{
								if( !$szCurValue ) $szCurValue = $szCurLine."\n";
								else $szCurValue .= $szCurLine."\n";
							}
							$szCurLine = '';
						default:
							if($chr!="\n") $szCurLine.=$chr;
					}
					
					$i++;
				}
				
				if( $szCurKey && $szCurValue){
					/* make the value not break line */
					while($szCurValue[strlen($szCurValue)-1]=="\r" || $szCurValue[strlen($szCurValue)-1]=="\n"){
						$szCurValue=substr($szCurValue,0,strlen($szCurValue)-1);
					}
					$arLocale[$szCurKey]=$szCurValue;
				}
				/* end */
				$arDiffOrig=  array_diff_key($arOrig,$arLocale) ;
				
				$szOutput='';
				foreach( $arDiffOrig as $k=>$v ){
					$szOutput.="\r\n[".$k.']';
				}
				
				file_put_contents($fileLocale,$txtLocale.$szOutput);
				/* load from locale to arOrig */
				foreach( $arLocale as $k=>$v ){
					$arOrig[$k]=$v;
				}
			}
			
			/* replace the locale to the file and cache */
			foreach($arOrig as $k=>$v){
				if($v == null ){
					$text=str_replace('|'.$k.'|',$k,$text);
				}else{
					$text=str_replace('|'.$k.'|',$v,$text);
				}
			}
			/* save to cahce and return the path */
			RLocale::$CACHER->save($fileToken,$text);
			
			return RLocale::$CACHER->getPath($fileToken);
		}
		public static function InitCacher(){
			if(!RLocale::$CACHER){
				RLocale::$CACHER = new RCacher();
				RLocale::$CACHER->setCategory('locales');
			}
		}
		
	}

?>