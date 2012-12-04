<?php
	function logger($msg,$category=null){
		RLog::Log($msg,$category);
	}
	class RLog{
		public static $PATH='';
		public static function Log($msg,$category=null){
			file_put_contents( RLog::GetPath($category) , $msg."\r\n" , FILE_APPEND );
			return true;
		}
		public static function Error($msg){
			return RLog::Log($msg,'error');
		}
		public static function Warning($msg){
			return RLog::Log($msg,'warning');
		}
		public static function Record($msg,$category=null){
			return RLog::Log($msg,$category);
		}
		public static function GetPath($category=null){
			global $_CONFIG;
			if(!$category) $fileName='log.txt';
			else $fileName=$category.'.txt';
			/* filename: cfg_path_logs PATH CATEGORY */
			$path=$_CONFIG['path_logs'].RLog::$PATH;
			
			if( !file_exists($_CONFIG['path_logs']) ) mkdir($_CONFIG['path_logs']);
			if( !file_exists($path) ) mkdir($path);
			return $path.$fileName;
		}
		
	}
?>