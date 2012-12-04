<?php

class RError{
	public static function Log($str){
		global $_CONFIG;
		$szMessage='Error : '.$str."\r\n";
		$szTrace='';
		$aryTrace=debug_backtrace();
		foreach ($aryTrace as $v){
			$szTrace.='File: '.$v['file']."\r\nFuntion: ".$v['function']."\r\n Line:".$v['line']."\r\n";
		}
		if($_CONFIG['error_trace']) $szMessage.=$szTrace;
		RLog::Error($szMessage);
		if($_CONFIG['error_display']) die($szMessage);
	}
	
}

?>