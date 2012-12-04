<?php
class RView{
	public static function Exists($view){
		return file_exists(RView::Path($view));
	}
	public static function Path($view){
		global $_CONFIG;
		return $_CONFIG['path_views'].(strpos($view,'.')===false?$view.'.html':$view);
	}
	public static function Clear(){
		if(SHRINE_QUERY=='call_ajax' || SHRINE_QUERY=='call_js')RShrineCore::PushCommand('clear',null);
		ob_clean();
	}
	public static function Load($view){
		RView::LoadView($view);
	}
	public static function LoadView($view){
		
		RView::OutputView($view);
	}
	public static function _echo($file){
		global $CONFIG;
		foreach($GLOBALS as $k=>$v){eval('global $'.$k.' ;');}
		/* replace de handle */
		$fCache=RShrineCore::GetCache($file,'view');
		$szCache=str_replace('##SHRINE_HANDLE##',$_CONFIG['app_id'], file_get_contents( $fCache ) );
		eval('?>'.$szCache.'<?php ');
		//$fTmp=$_CONFIG['path_cache'].'tmpv_'.time().'.php';
		//file_put_contents($fTmp, str_replace('##SHRINE_HANDLE##',$_CONFIG['app_id'], file_get_contents( $fCache ) ) );
		//@include($fTmp);
		//unlink($fTmp);
	}
	public static function OutputView($view){
		global $_CONFIG;
		$pathView=$_CONFIG['path_views'].((strpos($view,'.')===false?$view.'.html':$view));
		if (!file_exists($pathView)){
			RError::Log('RView : your view ('.$view.') does not exist.');
			return false;
		}
		
		switch($_CONFIG['template_engine']){
			case 'smarty':
				global $usrSmarty;
				if(empty($usrSmarty)){
					if(!RShrine::InitTemplateEngine($_CONFIG['template_engine'])){
						$_CONFIG['template_engine']=null;
						RView::_echo($pathView);
					}
				}
				//output smarty
				$usrSmarty->display(RShrineCore::GetCache($pathView,'view'));
				break;
			case 'comsenz':
				/* globalize */
				$pathView=RView::Path($view);
				$tpl=RTemplateComsenz::Load($pathView);
				RView::_echo($tpl);
				break;
			default :
				RView::_echo(RView::Path($view));
				break;
			
		}
		return true;
	}
	public static function Write($code){
		RView::Output($code);
	}
	public static function Output($code){
		$code=RCompiler::CompileView($code);
		echo $code;
	}
	public static function LoadStyle($css){
		global $_app_styles,$_CONFIG;
		if( substr($css,strlen($css)-4,4)!='.css' ) $css.='.css';
		if(!file_exists($_CONFIG['path_resource'].$css) && !file_exists($_CONFIG['path_app'].$css)) return false;
		if(!in_array($css,$_app_styles)) array_push($_app_styles,$css);
		return true;
	}
	public static function  LoadCSS($css){
		return RView::LoadStyle($css);
		
	}
	public static function LoadSkin($skin,$param=null){
		if(!$skin){
			RShrineCore::PushCommand('set_skin',null);
			return true;
		}else{
			if(gettype($param)!='string') return false;
			RShrineCore::PushCommand('set_skin',$skin.':'.$param);
			return true;
		}
		
	}
	public static function setTitle($title=null){
		RShrineCore::PushCommand('set_title',$title);
		return true;
	}
}
?>