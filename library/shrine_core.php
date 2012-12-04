<?php
/**
 * ideapad
 *
 *	
 *
 *	
 *
 *  user system inchance
 *  
 *  js messagebox 
 *	
 *
 *	
 *  View set_mover
 */
session_start();
/* load libraries */
if(defined('BS')){
	set_include_path(BS);
	require_once('config.php');
}else{
	require_once('config.php');
	set_include_path(BS);
}

require_once('shrine_functions.php');
require_once('shrine_log.php');
require_once('shrine_error.php');
require_once('shrine_json.php');
require_once('shrine_compiler.php');
require_once('shrine_cacher.php');
require_once('shrine_locale.php');
require_once('shrine_service.php');
require_once('shrine_view.php');
require_once('shrine_controller.php');
require_once('shrine_table.php');
require_once('shrine_database.php');
require_once('shrine_model.php');
require_once('shrine_command.php');
require_once('shrine_template.php');
require_once('shrine_setting.php');
require_once('shrine_webapi.php');

restore_include_path();
//Warning : do not modify these configs unless you understand it.
//SEC : CORE CONFIG 
define('SHRINE_PATH_APPS',BS.'applications/');
define('SHRINE_PATH_PACKS',BS.'packages/');
define('SHRINE_PATH_MODELS',BS.'models/');
define('SHRINE_PATH_TABLES',BS.'models/tables/');
define('SHRINE_ENCODING','UTF-8');
define('SHRINE_VERSION','1.0');


class RShrineCore{
	public static $LIST_COMMANDS=array('set_sfx'=>1,'write'=>2,'clear'=>3,'set_controller'=>4,'set_style'=>5,'load_plugin'=>6,'set_skin'=>7,'set_title'=>8);
	public static $STACK_COMMANDS=array();
	public static function PushCommand($cmd,$param=null){
		if(array_key_exists($cmd,RShrineCore::$LIST_COMMANDS)){
			$idCmd=RShrineCore::$LIST_COMMANDS[$cmd];
			switch($idCmd){
				case 2: // set content
					if(!$param || trim($param)==''){
						return false;
					}
					break;
			}
			RShrineCore::$STACK_COMMANDS[$idCmd]=$param;
			return true;
		}
		return false;
	}
	public static function RemoveCommand($cmd){
		if(array_key_exists($cmd,RShrineCore::$LIST_COMMANDS) && RShrineCore::$STACK_COMMANDS[RShrineCore::$LIST_COMMANDS[$cmd]]){
			unset(RShrineCore::$STACK_COMMANDS[RShrineCore::$LIST_COMMANDS[$cmd]]);
			return true;
		}
		return false;
	}
	public static function ExportCommands(){
		$szExport='';
		foreach(RShrineCore::$STACK_COMMANDS as $k=>$v){
			$v=$v===null? '':hash_to_string(strval($v));
			$szExport.= $k.':'.$v.';';
		}
		return $szExport;
	}
	public static function SaveAppConfig($sfx,$id){
		global $_CONFIG;
		$_SESSION['_shrine_cfg_'.$sfx.'_'.$id]=$_CONFIG;
		return true;
	}
	public static function LoadAppConfig($sfx,$id){
		global $_CONFIG;
		$k='_shrine_cfg_'.$sfx.'_'.$id;
		if(array_key_exists($k,$_SESSION)){
			$_CONFIG=$_SESSION[$k];
			return true;
		}else{
			return false;
		}
	}
	public static function LoadAppInstance($app,$id,$sfx){
		global $_shrine_sfx_key,$_CONFIG;
		
		if(!RShrine::AppExists($app)) return null;
		$k='_shrine_app_'.$sfx.'_'.$id;
		$_shrine_sfx_key=$k;
		$arySplitApp=explode('.',$app); 
		switch(count($arySplitApp)){
			/* App Class Name : AppPackageClass */
			case 1:
				$szPack=null;		
				$szApp=$app;
				$szApp[0]=strtoupper($szApp[0]);
				$szApp='App'.$szApp;
				break;
			case 2:
				$szPack=$arySplitApp[0];
				$szApp=$arySplitApp[1];
				$szPack[0]=strtoupper($szPack[0]);
				$szApp[0]=strtoupper($szApp[0]);
				$szApp='App'.$szPack.$szApp;
				break;
			default:
				return false;
				break;
		}
		$pathApp=RShrine::AppPath($app);
		if(array_key_exists($k,$_SESSION) && is_object($_SESSION[$k])){
			$fileApp=$pathApp.'app.php';
			if(!file_exists($fileApp)) $fileApp=$pathApp.'service.php';
			if(file_exists($fileApp)){
				try{
					include_once( RShrineCore::GetCache($fileApp,'service') );
				}catch(Exception $e){
					RError::Log('error in file ('.$fileApp.').');
					return null;
				}
				if(!class_exists($szApp)){
					RError::Log('cannot find  class ('.$szApp.').');
					return null;
				}
				$_SESSION[$k]=unserialize($_SESSION[$k]);
				return $_SESSION[$k];
			}
			return null;
			
		}else{
			$_app_success=false;
			$fileApp=$pathApp.'app.php';
			if(!file_exists($fileApp)) $fileApp=$pathApp.'service.php';
			if(file_exists($fileApp)){
				try{
					include_once( RShrineCore::GetCache($fileApp,'service') );
				}catch(Exception $e){
					
					RError::Log('error in file ('.$fileApp.').');
					return false;
				}
				if(!class_exists($szApp)){
					RError::Log('cannot find  class ('.$szApp.').');
					return false;
				}
				$objApp=null;
				try{
					eval('$objApp=new '.$szApp.'();'); 
				}catch(Exception $e){
					return null;
				}
				if($objApp){
					$_SESSION[$k]=$objApp;
					if(isset($objApp->_CONFIG)){
						$_CONFIG=array_merge($_CONFIG,$objApp->_CONFIG);
					}
				}
				return $objApp;
			}
			return null;
		}
	}
	public static function SetAppEnv($app,$id=null){
		global $_CONFIG,$_app_views,$_app_controllers,$_app_styles,$_app_param,$_app_success,$_app_code;
		
		$_app_success=false;
		$_app_views='';
		$_app_controller=null;
		$_app_styles=array();
		$_app_code=null;
		$_app_param=null;
		
		$arySplitApp=explode('.',$app);
		switch(count($arySplitApp)){
			case 1:
				$szPack=null;
				$szApp=$app;
				break;
			case 2:
				$szPack=$arySplitApp[0];
				$szApp=$arySplitApp[1];
				break;
			default:
				return false;
				break;
		}
		$pathApp=RShrine::AppPath($app);
		$_CONFIG['app_name']=$app;
		$_CONFIG['package_name']=$szPack;
		$_CONFIG['app_launch']=true;
		$_CONFIG['path_app']=$pathApp;
		$_CONFIG['path_resource']=$pathApp.'%resource%/';
		$_CONFIG['path_views']=$pathApp.'views/';
		$_CONFIG['path_controllers']=$pathApp.'controllers/';
		$_CONFIG['path_locales']=$pathApp.'locales/';
		
		if(!$id) return ;
		$_CONFIG['id']=$id;
		$_CONFIG['app_id']=$id;
		$_CONFIG['app_handle']=$id;
	}
	public static function GetCache($szFile,$szType){
		global $_CONFIG,$_global_cacher;
		if(!file_exists($szFile)){
			return false;
		}
		if(empty($_global_cacher)){
			$_global_cacher=new RCacher();
		}
		/* fix locale in config */
		if(!array_key_exists('locale', $_CONFIG)) $_CONFIG['locale']=null;
		if( $_CONFIG['locale']!='disable' && in_array($szType,array( 'service','view','style','controller' ))){
				RLocale::SetMode($szType);
				$szFile = RLocale::Transform($szFile);
		}
		
		$szCacheName=convert_to_under($szFile);
		if(!array_key_exists('debug',$_CONFIG) || !$_CONFIG['debug']) $szRet=$_global_cacher->load($szCacheName,filemtime($szFile));
		else $szRet=null;
		if($szRet){
			return $szRet;
		}else{
			$szCode=file_get_contents($szFile);
			switch($szType){
				case 'service':
					$szComp=RCompiler::CompileService($szCode);
					if(!$szComp) return false;
					break;
				case 'view':
					$szComp=RCompiler::CompileView($szCode);
					if(!$szComp) return false;
					break;
				case 'style':
					$szComp=RCompiler::CompileStyle($szCode);
					if(!$szComp) return false;
					break;
				case 'controller':
					$szComp=RCompiler::CompileController($szCode);
					if(!$szComp) return false;
					break;
				case 'table':
					$szComp=RCompiler::CompileTable($szCode);
					if(!$szComp) return false;
					break;
				case 'model':
					$szComp=RCompiler::CompileModel($szCode);
					if(!$szComp) return false;
					break;
				default:
					return false;
			}
			$_global_cacher->save($szCacheName,$szComp);
			return $_global_cacher->getPath($szCacheName);
		
		}
	}
	public static function ProductSFX(){
		while(1){
			$sfx=date('jHis');
			if(empty($_SESSION['SFX_'.$sfx])){
				return $sfx;
			}
		}
	}
	public static function RunService(){
		
	}
	public static function CallService($oApp,$ctrl,$params){
		if(gettype($params)!='array')	$params=array($params);
		if(!is_object($oApp) || !array_key_exists($ctrl,$oApp->_METHODS)) return false;
		$szParam=$oApp->_METHODS[$ctrl];
		$aryParam=split(',',$szParam);
		$aryPost=array();
		$bParamComp=true;
		if(count($aryParam)>0){
			for($i=0;$i<count($aryParam);$i++){
				if(trim($aryParam[$i])=='') continue;
				if(!array_key_exists($aryParam[$i],$params)){
					$bParamComp=false;break;
				}
				array_push($aryPost,$params[$aryParam[$i]]);
			}
			
			if(!$bParamComp && count($params)==count($aryParam)){
				$aryPost=$params;
			}
		}
		
		try{
			$funcret=@call_user_func_array(array($oApp,$ctrl),$aryPost);
		}catch(Expection $e){
			$funcret=null;
		}
		if(!is_null($funcret)) RController::SendToClient($funcret);
		return $funcret;
	}
	public static function LaunchApp($app,$params=null){ 
		global $_CONFIG,$_CONFIGBAK,$_app_views,$_app_controller,$_app_styles,$_app_param,$_app_success,$_app_code;
		if(gettype($params)!='array') $params=array();
		if(gettype($app)!='string'){
			RError::Log('runApplication : appname must be a string.');
			return false;
		}
		if(!RShrine::AppExists($app)){
			RError::Log('runApplication : app('.$app.') does not exists.');
		}
		//SEC: make a copy of configs
		$_CONFIGBAK=$_CONFIG;
		if(empty($_CONFIG['id'])){
			global $clientID;
			if(empty($clientID)) $clientID = 100;
			$_CONFIG['id']=$clientID+1;
		}
		RShrineCore::SetAppEnv($app,$_CONFIG['id']);
		//SEC: load user's app
		
		
			//SEC: load user's main service
			ob_start();
			
			$objApp=RShrineCore::LoadAppInstance($app,$_CONFIG['app_handle'],$_CONFIG['sfx']);
			if(!$objApp) return false;
			
			
			
			//ok let's run user's main process
			$retService=null;
			try{
				$retService=RShrineCore::CallService($objApp,'main',$params);
			}catch(Exception $e){
				RError::Log('runApplication : can not call the mian service of .');
				return false;
			}
			/* get view code */
			
			
			if(ob_get_contents()=='' && isset($_CONFIG['default_view'])){
				RView::Load($_CONFIG['default_view']);
			}elseif(ob_get_contents()=='' && RView::Exists('default')){
				RView::Load('default');
			}
			if(count($_app_styles)==0 && isset($_CONFIG['default_style'])){
				RView::LoadStyle($_CONFIG['default_style']);
			}elseif(count($_app_styles)==0 && file_exists($_CONFIG['path_resource'].'default.css')){
				RView::LoadStyle('default');
			}
			if($_app_controller==null && isset($_CONFIG['default_controller'])){
				RController::Load($_CONFIG['default_controller']);
			}elseif($_app_controller==null && RController::Exists('default')){
				RController::Load('default');
			}
			if(isset($_CONFIG['default_skin']) && $_CONFIG['default_skin']){
				$arSkin=split(':',$_CONFIG['default_skin']);
				if(count($arSkin)>1){
					$pSkin=$arSkin[1];
				}else{
					$pSkin=null;
				}
				RView::LoadSkin($arSkin[0],$pSkin);
			}
			
			$_app_views=ob_get_contents();
			ob_clean();
			
			$_app_success=true;
			$_app_param=$retService;
			return true;		
	}
	public static function BackToClient($method_caller){
		//launch_ajax,launch_php,launch_js,call_ajax,call_js,service
		global $_CONFIG,$_CONFIGBAK,$_app_views,$_app_controller,$_app_styles,$_app_param,$_app_success,$_app_code,$_shrine_sfx_key;
		if(!is_array($_app_styles)){
			RError::Log('App Processing: Fatal Error Found.');
			return false;
		}
		if(!empty($_shrine_sfx_key) && array_key_exists($_shrine_sfx_key,$_SESSION)){
			$_SESSION[$_shrine_sfx_key]=serialize($_SESSION[$_shrine_sfx_key]);
		}
		switch($method_caller){ 
			case 'launch_php':
				global $clientID,$clientSFX;
				if(!$_app_success) break;
				/* decide unique id and sfx */
				if(empty($clientID)) $clientID = 100;
				/* give the pi and vi */
				$pi=$clientID++;
				$vi=$clientID++;
				echo '<div id="__container_'.$vi.'" _vid="'.$vi.'">';
				/* wirte view code to client */
				echo $_app_views;
				/* script */
				$sz='1#';
				if($_app_controller) RShrineCore::PushCommand('set_controller',$_app_controller);
				if(count($_app_styles)>0) RShrineCore::PushCommand('set_style',implode(',',$_app_styles));
				$sz.= RShrineCore::ExportCommands().' #';
				$sz.= $_app_param!=null? hash_to_string($_app_param):''; 
				$sz.= '#';
				if($_app_code) $sz.= hash_to_string($_app_code);
				echo '
				</div>
				<script type="text/javascript" defer="defer">
				var p=new Process("'.$_CONFIG['app_name'].'",null,'.$pi.');
				var v=new View(p.m_id,null,null,null,'.$vi.');
				_constructor.setToApp($E("__container_'.$vi.'"),'.$vi.',"'.$_CONFIG['app_name'].'",true);
				_callback_launch("'.$sz.'",'.$vi.',null);
				shrine.idUnique='.$clientID.';
				</script>
				';
				break;
			case 'call_ajax':
			case 'launch_ajax':
				if($_app_success){
					echo '1#';
					if(trim($_app_views)!='') RShrineCore::PushCommand('write',$_app_views);
					if($_app_controller) RShrineCore::PushCommand('set_controller',$_app_controller);
					if(count($_app_styles)>0) RShrineCore::PushCommand('set_style',implode(',',$_app_styles));
					echo RShrineCore::ExportCommands().' #';
					echo $_app_param!=null? hash_to_string($_app_param):''; echo '#';
					if($_app_code) echo hash_to_string($_app_code);
					
				}else{
					echo '0#'.$_app_views;
				}
				exit;
				break;
			case 'launch_js':
				if($_app_success){
					header('Content-type: text/javascript;');
					$sz='1#';
					if(trim($_app_views)!='') RShrineCore::PushCommand('write',$_app_views);
					if($_app_controller) RShrineCore::PushCommand('set_controller',$_app_controller);
					if(count($_app_styles)>0) RShrineCore::PushCommand('set_style',implode(',',$_app_styles));
					$sz.= RShrineCore::ExportCommands().' #';
					$sz.= $_app_param!=null? hash_to_string($_app_param):''; 
					$sz.= '#';
					if($_app_code) $sz.= hash_to_string($_app_code);
					echo '_callback_launch("'.$sz.'",'.$_CONFIG['app_id'].',null);';
				}else{
					$sz='0#system error';
				}
				echo '_callback_launch("'.$sz.'",'.$_CONFIG['app_id'].',null);';
			case 'call_js':
				if($_app_success){
					header('Content-type: text/javascript;');
					$sz='1#';
					if(trim($_app_views)!='') RShrineCore::PushCommand('write',$_app_views);
					if($_app_controller) RShrineCore::PushCommand('set_controller',$_app_controller);
					if(count($_app_styles)>0) RShrineCore::PushCommand('set_style',implode(',',$_app_styles));
					$sz.= RShrineCore::ExportCommands().' #';
					$sz.= $_app_param!=null? hash_to_string($_app_param):''; 
					$sz.= '#';
					if($_app_code) $sz.= hash_to_string($_app_code);
					echo '_callback_launch("'.$sz.'",'.$_CONFIG['app_id'].',null);';
				}else{
					$sz='0#system error';
				}
				echo '_callback_service("'.$sz.'",'.$_CONFIG['app_id'].',null);';
				break;
			default:
				return false;
		}
		if( isset($_CONFIGBAK) && $_CONFIGBAK ){
			$_CONFIG=$_CONFIGBAK;
			$_CONFIGBAK = null;
		}
	}
}
/**
 * 
 * @author zomux2000
 *
 */
class RShrine{
	public static function AppExists($szApp){
		$arySplitApp=explode('.',$szApp);
		switch(count($arySplitApp)){
			case 1:
				return file_exists(SHRINE_PATH_APPS.$szApp);
				break;
			case 2:
				return file_exists(SHRINE_PATH_PACKS.$arySplitApp[0].'/applications/'.$arySplitApp[1]);
				break;
			default:
				
				return false;
				break;
		}
	}
	public static function AppPath($szApp){
		$arySplitApp=explode('.',$szApp);
		switch(count($arySplitApp)){
			case 1:
				return SHRINE_PATH_APPS.$szApp.'/';
			case 2:
				return SHRINE_PATH_PACKS.$arySplitApp[0].'/applications/'.$arySplitApp[1].'/';
				break;
			default:
				
				return false;
				break;
		}
	}
	public static function PackageExists($szPack){
		return file_exists(SHRINE_PATH_PACKS.$szPack);
	}
	public static function ListPackage($szPack){
		if(!RShrine::PackageExists($szPack)) return array();
		$hDir=opendir(SHRINE_PATH_PACKS.$szPack.'/applications');
		$arApps=array();
		while(($file=readdir($hDir))!==false){
			if($file!='.' && $file!='..' && file_exists(SHRINE_PATH_PACKS.$szPack.'/applications/'.$file.'/app.php')){
				array_push($arApps,$szPack.'.'.$file);
			}
		}
		return $arApps;
	}
	public static function InitTemplateEngine($szEngine){
		global $_CONFIG;
		switch($szEngine){
			case 'smarty':
				if (file_exists('plugins/smarty/smarty.class.php')){
					include_once('plugins/smarty/smarty.class.php');
					if(!class_exists('Smarty')) return false;
					global $usrSmarty;
					
					$usrSmarty=new Smarty();
					$usrSmarty->left_delimiter=$_CONFIG['smarty_left_delimiter'];
					$usrSmarty->right_delimiter=$_CONFIG['smarty_right_delimiter'];
					$usrSmarty->compile_dir=$_CONFIG['path_cache'].'smarty/';
					$usrSmarty->template_dir=$_CONFIG['path_views'];
					return true;
				}else{
					return false;
				}
				break;
			default:
				return false;
		}
	}
	public static function Launch($app,$params=null){
		global $_CONFIG;
		
		if(!defined('SHRINE_MOD')) define('SHRINE_MOD','local');
		if(!defined('SHRINE_QUERY')) define('SHRINE_QUERY','launch_php');
		if(!is_array($params)) $params=array();
		if(empty($_CONFIG['sfx'])){
			$_CONFIG['sfx']=RShrineCore::ProductSFX();
			RShrineCore::PushCommand('set_sfx',$_CONFIG['sfx']);
		}
		
		RShrineCore::LaunchApp($app,$params);
		RShrineCore::BackToClient(SHRINE_QUERY);
		
	}
	public static function RunApplication($app,$param=null){
		
		
	}
}

?>