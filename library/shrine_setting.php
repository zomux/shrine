<?php
class RSetting{
	public static function Load($token=null,$default=null,$app=null){
		global $_CONFIG;
		$app = $app ? $app : $_CONFIG['app_name'];
		$token = $token ? $token : 'setting';
		$cacherSetting = new RCacher('shrine_setting/'.$app,0);
		$szSetting=$cacherSetting->loadContent($token);
		if($szSetting){
			return unserialize($szSetting);
		}else{
			return $default;
		}
	}
	public static function Save($token=null,$var=null,$app=null){
		global $_CONFIG;
		$app = $app ? $app : $_CONFIG['app_name'];
		$token = $token ? $token : 'setting';
		$cacherSetting = new RCacher('shrine_setting/'.$app,0);
		$cacherSetting->save($token,serialize($var));
		return true;
	}
}