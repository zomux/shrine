<?php
class test2{
	public $_CONFIG=array('default_skin'=>'wskin:white');
	public function main(){
		RView::Write('test3');
		return 1;
	}
	public function testa($a){
		
		return ++$a;
	}
}

?>