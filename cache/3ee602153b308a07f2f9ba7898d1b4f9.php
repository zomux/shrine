<?php
class AppDemoGeneral{ public $_METHODS=array('main'=>'','setLang'=>'lang','square'=>'number','md5'=>'str');
	public $_CONFIG=array(
		//'template_engine'=>'comsenz'
		'service'=>array('square')
	);
	public function main(){
		
	}
	public function setLang($lang){
		RLocale::SetLocale($lang);
		RView::Clear();
		RView::Load('default');
	}
	
	public function square($number){
		if(!is_numeric($number)) return 0;
		else return $number*$number;
	}
	public function md5($str){
		return md5($str);
	}
}
?>