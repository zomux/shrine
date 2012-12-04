<?php
class RCommand{
	public static function Run($cmd,$bFetch=false){
		global $param,$_CONFIG;
		$param=explode(' ',$cmd); 
		$command=$param[0];
		array_shift($param);
		$file='commands/'.$command.'.php';
		if(file_exists($file)){
			if(bFetch) ob_start();	
			
			@include($file);
			
			if(bFetch){
				$szOutput = ob_get_contents();
				ob_clean();
				return $szOutput;
			}else{
				return true;
			}
		}else{
			return null;
		}
	}
}