<?php

class chat{
	
	public function chat(){
		global $_CONFIG;
		include($_CONFIG['path_app'].'config_uc.php');
		include($_CONFIG['path_plugins'].'ucenter/client.php');
		$ar=uc_user_login('raphael','zxczxc');
		$id=$ar[0];
		echo uc_avatar($id,'real');
	}

}