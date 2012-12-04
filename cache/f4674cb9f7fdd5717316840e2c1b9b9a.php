<?php
define('COSM_USER','rafa');
class AppCosmCore{ public $_METHODS=array('main'=>'','saveApp'=>'side,main');
	public $_CONFIG=array(
		//'template_engine'=>'comsenz'
	);
	public function main(){
		echo 'COSM OS CORE LAUNCHED';
		$arSide=RSetting::Load('LIST_SIDE_'.COSM_USER,array());
		$arMain=RSetting::Load('LIST_MAIN_'.COSM_USER,array());
		return array($arSide,$arMain);
	}
	public function saveApp($side,$main){
		RSetting::Save('LIST_SIDE_'.COSM_USER,$side);
		RSetting::Save('LIST_MAIN_'.COSM_USER,$main);
		return true;
	}
}
?>