<?php
class test{
	public $_CONFIG=array('default_skin'=>'wskin:white');
	public function main(){
		RView::Write('| i# test1|');
		return 1;
	}
	public function testa($a){
		
		return ++$a;
	}
}

?>