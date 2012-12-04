<?php
class AppCosmDict{ public $_METHODS=array('main'=>'','query'=>'word');
	public $_CONFIG=array(
		//'template_engine'=>'comsenz'
	);
	public function main(){
		
	}
	public function query($word){ 	
		$mapResult=RWebApi::Call('http://dict.cn/ws.php?utf8=true&q='.$word,null,null,'xml','222.73.68.52');
		return $mapResult;
	}
}
?>