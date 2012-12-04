<?php
class RCompiler{
	public static function preg_match_onview($ms){
		$code=$ms[0];
		$code=preg_replace_callback('/".*?"/',create_function('$ms','$code=$ms[0];$code=\'"\'.str_replace(\'"\',\'\\\'\',RCompiler::compileController(str_replace(\'"\',\'\',$code),false)).\'"\';return $code;'),$code);
		return $code;
	}
	public static function preg_match_str($matches){
			global $aryStrings;
			$code=$matches[0];
			array_push($aryStrings,substr($code,1,strlen($code)-2));
			return '"##SHRINE_STRING_'.strval(count($aryStrings)-1).'##"';
	}
	public static function preg_match_sstr($matches){
			global $aryStrings;
			$code=$matches[0];
			array_push($aryStrings,substr($code,1,strlen($code)-2));
			return '\'##SHRINE_STRING_'.strval(count($aryStrings)-1).'##\'';
	}
	public static function preg_match_style($matches){
			$code=$matches[0];
			$ccode=str_replace(array("\r","\n",'{','}'),'',$code);
			//$ccode=strtoupper(trim($ccode));
			$arySigns=split(',',$ccode);
			$aryComma=array();
			$arySpace=array();
			for($i=0;$i<count($arySigns);$i++){
				$szSpace='';
				$arySpace=split(' ',$arySigns[$i]);
				for($j=0;$j<count($arySpace);$j++){
					$szSub=$arySpace[$j];
					if(!in_array(substr($szSub,0,1),array('.','#','*','+')))
						$szSub='_style_tag_[SHRINE_APP]_'.$szSub;
					$szSub=str_replace('.','._style_[SHRINE_APP]_',$szSub);
					$szSub=str_replace('#','._style_id_[SHRINE_APP]_',$szSub);
					
					$szSpace.=$szSub;
					if($j!=count($arySpace)-1) $szSpace.=' ';
				}
				array_push($aryComma,$szSpace);
			}
			$ccode='';
			for($i=0;$i<count($aryComma);$i++){
				$ccode.=$aryComma[$i];
				if($i!=count($aryComma)-1) $ccode.=',';
			}
			if(substr($code,0,1)=='}') $ccode='}'.$ccode;
			$ccode.='{';
			global $_global_app;
			if(!empty($_global_app)) $ccode=str_replace('[SHRINE_APP]',$_global_app,$ccode);
			return $ccode;
		}
	public static function CompileView($szCode){
		$szCode=str_replace(array("\r","\n"),'',$szCode);
		$szCode=preg_replace_callback('/ on\w+?=".*?"/','RCompiler::preg_match_onview',$szCode);
		/*
		$szCode=preg_replace_callback('/"[^"\\\\]*(?:\\\\.[^"\\\\]*)*"/','preg_match_str',$szCode);
		//$szCode=str_replace(' id="',' id="_WVIEW_##SHRINE_HWND##_',$szCode);
		//$szCode=str_replace(' class="',' class="CSS_'.APP_NAME.'_',$szCode);
		//$szCode=preg_replace_callback('/\<form\s+?.*?\>/','matches2',$szCode);
		//$szCode=preg_replace_callback('/\<form\>/','matches2',$szCode);
		for($i=0;$i<count($aryStrings);$i++){
			$szCode=str_replace('##SHRINE_STRING_'.$i.'##',$aryStrings[$i],$szCode);
		}
		*/
		return $szCode;
	}
	public static function CompileStyle($szCode){
		$szCode=preg_replace_callback('/[^\}]?(.+?)\{/','RCompiler::preg_match_style',$szCode);
		$szCode=str_replace('%resource%/','##SHRINE_PATH_RES##',$szCode);
		$szCode=str_replace('%RESOURCE%/','##SHRINE_PATH_RES##',$szCode);
		global $_global_path_res;
		if(!empty($_global_path_res)) $szCode=str_replace('##SHRINE_PATH_RES##',$_global_path_res,$szCode);
		return $szCode;
	}
	public static function CompileService($szCode){
		global $aryStrings;
		$aryStrings=array();
		$szCode=preg_replace_callback('/"[^"\\\\]*(?:\\\\.[^"\\\\]*)*"/','RCompiler::preg_match_str',$szCode);
		$szCode=preg_replace_callback('/\'[^\'\\\\]*(?:\\\\.[^\'\\\\]*)*\'/','RCompiler::preg_match_sstr',$szCode);
		$szCode=preg_replace('/(class\s+?\w+?\s*?\{)/','\1 public $_METHODS=array(##SHRINE_METHODS_ARRAY##);',$szCode);
		$ms=null;$szMethods='';
		preg_match_all('/public\s+?function\s+?(\w+?)\(([^)]*?)\)\s*?{/',$szCode,$ms,PREG_SET_ORDER);
		if($ms){
			for($i=0;$i<count($ms);$i++){
				if(count($ms[$i])<3) continue;
				$szMethods.='\''.$ms[$i][1].'\'=>\''.strtolower(str_replace('$','',$ms[$i][2])).'\'';
				$szMethods.=($i+1<count($ms))?',':'';
			 }
		}
		preg_replace('/public\s+?function\s+?(\w+?)\(([^)]*?)\)\s*?{/','\0 global $_CONFIG;',$szCode);
		$szCode=str_replace('##SHRINE_METHODS_ARRAY##',$szMethods,$szCode);
		for($i=0;$i<count($aryStrings);$i++) $szCode=str_replace('##SHRINE_STRING_'.$i.'##',$aryStrings[$i],$szCode);
		for($i=0;$i<count($aryStrings);$i++) $szCode=str_replace('##SHRINE_STRING_'.$i.'##',$aryStrings[$i],$szCode);
		return $szCode;
	}
	public static function CompileController($szCode,$isfile=true){
		global $aryStrings;
		$aryStrings=array();
		$szCode=preg_replace_callback('/"[^"\\\\]*(?:\\\\.[^"\\\\]*)*"/','RCompiler::preg_match_str',$szCode);
		$szCode=preg_replace_callback('/\'[^\'\\\\]*(?:\\\\.[^\'\\\\]*)*\'/','RCompiler::preg_match_sstr',$szCode);
		
		$arySpChars=array('=',':','\'','"','[',']','{','}','(',')','/','+','?','-','*','^','%','#',',','.','&','|','\r','\n',' ',';','\t');
		$js_body=$szCode;
		$js_body=' '.$js_body;
		$js_body=preg_replace('/function\s+?([\@\w]+?)\s*?\(/','\1 = function(',$js_body);
		
		$js_body=preg_replace('/(\\W)\\@([a-zA-z]\\w*)(\\W)/','\1__view_##SHRINE_HANDLE##.\2\3',$js_body);
		$js_body=preg_replace('/(\\W)\\@([a-zA-z]\\w*)(\\W)/','\1__view_##SHRINE_HANDLE##.\2\3',$js_body);
		$js_body=preg_replace('/(\W)me(\W)/','\1__view_##SHRINE_HANDLE##\2',$js_body);
		
		$js_body=str_replace('.view','##SHRINE_DOT_LVIEW##',$js_body);
		$js_body=preg_replace('/(\W)view.(\w+?)\(\s*?\)/','\\1##SHRINE_DOT_VIEW##.\\2()',$js_body);
		$js_body=preg_replace('/(\W)view.(\w+?)\(/','\\1##SHRINE_DOT_VIEW##.\\2(',$js_body);
		$js_body=preg_replace('/(\W)view.(\w+)/','\1$S("__shrine_##SHRINE_HANDLE##_\2")',$js_body);
		$js_body=preg_replace('/(\W)view\[(.+?)\]/','\1$S("__shrine_##SHRINE_HANDLE##_"+\2)',$js_body);
		$js_body=preg_replace('/(\W)view(\W)/','\1__view_##SHRINE_HANDLE##.m_container\2',$js_body);
		$js_body=str_replace('##SHRINE_DOT_LVIEW##','.view',$js_body);
		$js_body=str_replace('##SHRINE_DOT_VIEW##','__view_##SHRINE_HANDLE##.m_container',$js_body);
		
		$js_body=str_replace('.process','##SHRINE_DOT_LPROC##',$js_body);
		$js_body=preg_replace('/(\W)process.(\w+?)\(\s*?\)/','\\1##SHRINE_DOT_PROC##.\\2(##SHRINE_HANDLE##)',$js_body);
		$js_body=preg_replace('/(\W)process.(\w+?)\(/','\\1##SHRINE_DOT_PROC##.\\2(##SHRINE_HANDLE##,',$js_body);
		$js_body=preg_replace('/(\W)process.(\w+)/','\1__proc_##SHRINE_PROCESS##.\2',$js_body);
		$js_body=preg_replace('/(\W)process\[(.+?)\]/','\1__proc_##SHRINE_PROCESS##[\2]',$js_body);
		$js_body=preg_replace('/(\W)process(\W)/','\1__proc_##SHRINE_PROCESS##\2',$js_body);
		$js_body=str_replace('##SHRINE_DOT_LPROC##','.process',$js_body);
		$js_body=str_replace('##SHRINE_DOT_PROC##','_process',$js_body);
		
		/* */
		$js_body=str_replace('.server','##SHRINE_DOT_LSERVER##',$js_body);
		$js_body=str_replace('.server','##SHRINE_DOT_LSERVICE##',$js_body);
		$js_body=preg_replace('/(\W)server\[(.*?)\]\(\s*?\)/','\\1shrine.callService(##SHRINE_HANDLE##,\\2)',$js_body);
		$js_body=preg_replace('/(\W)server\[(.*?)\]\(/','\\1shrine.callService(##SHRINE_HANDLE##,\\2,',$js_body);
		$js_body=preg_replace('/(\W)server.(\w+?)\(\s*?\)/','\\1shrine.callService(##SHRINE_HANDLE##,\'\\2\')',$js_body);
		$js_body=preg_replace('/(\W)server.(\w+?)\(/','\\1shrine.callService(##SHRINE_HANDLE##,\'\\2\',',$js_body);
		$js_body=preg_replace('/(\W)server(\W)/','\1shrine.callStatus(##SHRINE_HANDLE##)\2',$js_body);
		$js_body=preg_replace('/(\W)service\[(.*?)\]\(\s*?\)/','\\1shrine.callService(##SHRINE_HANDLE##,\\2)',$js_body);
		$js_body=preg_replace('/(\W)service\[(.*?)\]\(/','\\1shrine.callService(##SHRINE_HANDLE##,\\2,',$js_body);
		$js_body=preg_replace('/(\W)service.(\w+?)\(\s*?\)/','\\1shrine.callService(##SHRINE_HANDLE##,\'\\2\')',$js_body);
		$js_body=preg_replace('/(\W)service.(\w+?)\(/','\\1shrine.callService(##SHRINE_HANDLE##,\'\\2\',',$js_body);
		$js_body=preg_replace('/(\W)service(\W)/','\1shrine.callStatus(##SHRINE_HANDLE##)\2',$js_body);
		$js_body=str_replace('##SHRINE_DOT_LSERVER##','.server',$js_body);
		$$js_body=str_replace('##SHRINE_DOT_LSERVICE##','.server',$js_body);
		
		$js_body=preg_replace('/(\W)page.(\w+)/','\1$E("\2")',$js_body);
		$js_body=preg_replace('/(\W)page(\W)/','\1document.body\2',$js_body);
		
		
		//function {} -> };
		//$countHole=0;
		//$js_body=preg_replace('/=\s+?function\(/','=function(',$js_body);
		
		
		//$js_body=str_replace('SendToServer(','SendToServer(##SHRINE_HANDLE##,',$js_body);
		
		if($isfile) $js_body.="\r\n".'if(typeof(__view_##SHRINE_HANDLE##.main)=="function" ){if(!__view_##SHRINE_HANDLE##.m_plugins){__view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);}else{shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,function(){ __view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);  });}}else if(__view_##SHRINE_HANDLE##.m_plugins){ shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,null);}';
		for($i=0;$i<count($aryStrings);$i++){
			$js_body=str_replace('##SHRINE_STRING_'.$i.'##',$aryStrings[$i],$js_body);
		}
		for($i=0;$i<count($aryStrings);$i++){
			$js_body=str_replace('##SHRINE_STRING_'.$i.'##',$aryStrings[$i],$js_body);
		}
		$js_body=substr($js_body,1,strlen($js_body)-1);
		return $js_body;
	}
	public static function CompileTable($szCode){
		global $_modName;
		if(!isset($_modName)) return false;
		$arySqlKeywords=array('ADD','ASC','DESC','EXIT','PRIMARY','ALL','FETCH','PRINT','ALTER','FILE','PRIVILEGES','AND','FILLFACTOR','PROC','ANY','FLOPPY','PROCEDURE','AS','FOR','PROCESSEXIT','ASC','FOREIGN','PUBLIC','AUTHORIZATION','FREETEXT','RAISERROR','AVG','FREETEXTTABLE','READ','BACKUP','FROM','READTEXT','BEGIN','FULL','RECONFIGURE','BETWEEN','GOTO','REFERENCES','BREAK','GRANT','REPEATABLE','BROWSE','GROUP','REPLICATION','BULK','HAVING','RESTORE','BY','HOLDLOCK','RESTRICT','CASCADE','IDENTITY','RETURN','CASE','IDENTITY_INSERT','REVOKE','CHECK','IDENTITYCOL','RIGHT','CHECKPOINT','IF','ROLLBACK','CLOSE','IN','ROWCOUNT','CLUSTERED','INDEX','ROWGUIDCOL','COALESCE','INNER','RULE','COLUMN','INSERT','SAVE','COMMIT','INTERSECT','SCHEMA','COMMITTED','INTO','SELECT','COMPUTE','IS','SERIALIZABLE','CONFIRM','ISOLATION','SESSION_USER','CONSTRAINT','JOIN','SET','CONTAINS','KEY','SETUSER','CONTAINSTABLE','KILL','SHUTDOWN','CONTINUE','LEFT','SOME','CONTROLROW','LEVEL','STATISTICS','CONVERT','LIKE','SUM','COUNT','LINENO','SYSTEM_USER','CREATE','LOAD','TABLE','CROSS','MAX','TAPE','CURRENT','MIN','TEMP','CURRENT_DATE','MIRROREXIT','TEMPORARY','CURRENT_TIME','NATIONAL','TEXTSIZE','CURRENT_TIMESTAMP','NOCHECK','THEN','CURRENT_USER','NONCLUSTERED','TO','CURSOR','NOT','TOP','DATABASE','NULL','TRAN','DBCC','NULLIF','TRANSACTION','DEALLOCATE','OF','TRIGGER','DECLARE','OFF','TRUNCATE','DEFAULT','OFFSETS','TSEQUAL','DELETE','ON','UNCOMMITTED','DENY','ONCE','UNION','DESC','ONLY','UNIQUE','DISK','OPEN','UPDATE','DISTINCT','OPENDATASOURCE','UPDATETEXT','DISTRIBUTED','OPENQUERY','USE','DOUBLE','OPENROWSET','USER','DROP','OPTION','VALUES','DUMMY','OR','VARYING','DUMP','ORDER','VIEW','ELSE','OUTER','WAITFOR','END','OVER','WHEN','ERRLVL','PERCENT','WHERE','ERROREXIT','PERM','WHILE','ESCAPE','PERMANENT','WITH','EXCEPT','PIPE','WORK','EXEC','PLAN','WRITETEXT','EXECUTE','PRECISION','EXISTS','PREPARE','DATE','HAS','DESCRIBE'
);
		$table=array(
			'name'=>$_modName,'real'=>null,'special'=>false,//special [false,'db','host']
			'connection'=>array('host'=>null,'port'=>null,'database'=>null,'username'=>null,'password'=>null,'driver'=>null),
			'key'=>null,
			'members'=>array(),
			'driver' => null
		);
		$dom = new DOMDocument();
		$dom->loadXML($szCode);
		$szCode=null;
		$eList=$dom->getElementsByTagName('table');
		$eMod=$eList->item(0) ;
		if($eMod->attributes->getNamedItem('real')) $table['real']=$eMod->attributes->getNamedItem('real')->nodeValue;
		for($i=0;$i<$eMod->childNodes->length;$i++){
			$eChild=$eMod->childNodes->item($i);
			switch($eChild->nodeName){
				case 'key':
					$table['key']=$eChild->nodeValue;
					break;
				case 'connection':
					for($j=0;$j<$eChild->childNodes->length;$j++){
						$eMember=$eChild->childNodes->item($j);
						if($eMember->attributes==null ) continue;
						$szE=$eMember->nodeName;
						if(trim($eMember->nodeValue) == '') continue;
						switch(strtolower($szE)){
							case 'host':
								$table['connection']['host']=$eMember->nodeValue;
								break;
							case 'port':
								$table['connection']['port']=$eMember->nodeValue;
								break;
							case 'username':
								$table['connection']['username']=$eMember->nodeValue;
								break;
							case 'password':
								$table['connection']['password']=$eMember->nodeValue;
								break;
							case 'database':
								$table['connection']['database']=$eMember->nodeValue;
								break;
							case 'driver':
								$table['connection']['driver']=$eMember->nodeValue;
								break;
							
						}
					}
					break;
				case 'members': 
					for($j=0;$j<$eChild->childNodes->length;$j++){
						$eMember=$eChild->childNodes->item($j);
						$szE=$eMember->nodeName;
						if($eMember->attributes==null ) continue;
						$type=$eMember->attributes->getNamedItem('type')?strtolower($eMember->attributes->getNamedItem('type')->nodeValue):'text';
						$validate=$eMember->attributes->getNamedItem('validate')?$eMember->attributes->getNamedItem('validate')->nodeValue:false;
						$real=$eMember->attributes->getNamedItem('real')?$eMember->attributes->getNamedItem('real')->nodeValue:$szE;
						$default=$eMember->nodeValue==''?null:$eMember->nodeValue;
						$foreign=$eMember->attributes->getNamedItem('foreign')?$eMember->attributes->getNamedItem('foreign')->nodeValue:$szE;
						if(in_array(strtoupper($real),$arySqlKeywords)) RError::Log("Shrine Error In Model '$_modName' : your field '$real' of member '$szE' is a keyword of SQL. ");
						$strtype=false;
						if(strtolower($type)=='bool'){
							if($default=='true') $default=true;
							else $default=false;
						}else if(strtolower($type)=='array'){
							$strtype=true;
						}else if(strtolower($type)=='text'){
							$strtype=true;
						}else if(strtolower($type)=='int'){
							if(!is_numeric($default)) $default=null;
						}else if(strtolower($type)=='double'){
							if(!is_numeric($default)) $default=null;
						}else if(preg_match('/varchar\(\d+\)/',$type)){ 
							$countsz=str_replace(array('varchar(',')'),'',$type);
							if(!is_numeric($countsz)) RError::Log("Shrine Error In Model '$_modName' :  the type '$type' of member '$szE' is invalid.");
							else if(intval($countsz)>=256 or intval($countsz)<=0) RError::Log("Shrine Error In Model '$_modName' : the bytes of type varchar(n) must lowwer than 256 and greater than 0.");
							$strtype=true;
						}else if(preg_match('/char\(\d+\)/',$type)){
							$countsz=str_replace(array('char(',')'),'',$type);
							if(!is_numeric($countsz)) RError::Log("Shrine Error In Model '$_modName' :  the type '$type' of member '$szE' is invalid.");
							else if(intval($countsz)>=256 or intval($countsz)<=0) RError::Log("Shrine Error In Model '$_modName' : the bytes of type char(n) must lowwer than 256 and greater than 0.");
							$strtype=true;
						}else if(strtolower($type)=='auto'){
							$default='null';
						}else if(strtolower($type)=='primary_key'){
							if(!$table['key']) $table['key']=$szE;
							$type='auto';
							$default='null';
						}else if(strtolower($type)=='string'){
							$strtype=true;
						}else if(strtolower($type)=='float'){
							if(!is_numeric($default)) $default=null;
						}else if(strtolower($type)=='date'){
							if(!is_numeric($default)) $default=null;
						}else if(strtolower($type)=='binary'){
							$strtype=true; // addslashes
						}else continue;
						$table['members'][$szE]=array('real'=>$real,'type'=>$type,'strtype'=>$strtype,'value'=>$default,'foreign'=>$foreign,'validate'=>'');
						// validate comp?
						/*
						if($validate){
							$aryVali=split(',',$validate);
							for($k=0;$k<count($aryVali);$k++){
								$validate=$aryVali[$k];
								if(substr($validate,strlen($validate)-1,1)!=')') $validate.='()';
								$vali=strtoupper(preg_replace('/(\w+)(\(.*\))/','\1',$validate));
								$vali=strtoupper($vali);
								$validate=strtoupper(preg_replace('/(\w+)(\(.*\))/','\2',$validate));
								if(in_array($vali,RValidate::$_array)) $szCode.='array_push($model->_validate["'.$szE.'"],RValidate::'.$vali.$validate.');';
							}
						}
						*/
					}
					break;
			}
		}
		if(!in_array($table['key'],$table['members'])) RError::Log("Shrine Error In Model '$_modName' : your key '".$table['key']."' hasn't been found in the members.");
		if(!$table['real']) $table['real']=$_modName;
		if($table['info']['host']) $table['special']='host';
		else if($table['info']['database']) $table['special']='db';
		return serialize($table);
	}
	public static function CompileModel($szCode){
		global $_modName;
		if(empty($_modName)) return false;
		$ar=explode(',',$_modName);
		if(count($ar)==1){
			$szClass=$ar[0];
			$szClass[0]=strtoupper($szClass[0]);
			$szClass='Model'.$szClass;
		}else{
			$szClass=$ar[1];
			$szClass[0]=strtoupper($szClass[0]);
			$szClass=$ar[0];
			$szClass[0]='Model'.strtoupper($szClass[0]);
		}
		$szCode=preg_replace('/class\s.+?{/','class '.$szClass.' extends RModel{',$szCode);
		return $szCode;
	}
}

?>