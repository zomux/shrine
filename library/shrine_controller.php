<?php
class RController{

	public static function Exists($ctrl){
		global $_CONFIG;
		if( substr($ctrl,strlen($ctrl)-3,3)!='.js' ) $ctrl.='.js';
		return file_exists($_CONFIG['path_app'].'/controllers/'.$ctrl);
	}
	public static function Load($ctrl){
		return RController::loadController($ctrl);
	}
	public static function LoadController($ctrl){
		if(!RController::Exists($ctrl)){
			RError::Log('loadController : controller('.$ctrl.') does not exist.');
		}else{
			if( substr($ctrl,strlen($ctrl)-3,3)!='.js' ) $ctrl.='.js';
			global $_app_controller;
			$_app_controller=$ctrl;
		}
	}
	public static function RunAtClient($codes){
		global $usrClientCodes;
		$usrClientCodes.=$codes;
	}
	public static function SendToClient($things){
		global $usrMsg;
		if(gettype($things)!='array'){
			$usrMsg['content']=strval($things);
			return;
		}
		foreach ($things as $key=>$val){
			$usrMsg[$key]=$val;
		}
	}
	
	public static function End(){
		ShrineCore::LaunchClient();
	}
	
}
?>
