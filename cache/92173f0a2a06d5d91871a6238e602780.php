<?php
class AppCosmNotepad{ public $_METHODS=array('main'=>'','save'=>'txt');
	public $_CONFIG=array(
		'template_engine'=>'comsenz'
	);
	public function main(){
		global $txt;
		$txt=RSetting::Load('text','');
	}
	public function save($txt){
		RSetting::Save('text',$txt);
	}
}
?>