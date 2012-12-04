<?php
/* dealing path */
if(!defined('BS')){
	/* setting base path */
	$pathRoot=$_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']);
	$pathRoot=str_replace('\\\\','\\',$pathRoot);
	$pathShrine=dirname(__FILE__);
	$pathRoot=str_replace('\\','/',$pathRoot);
	$pathShrine=str_replace('\\','/',$pathShrine);
	$pathShrine=str_replace($pathRoot,'',$pathShrine);
	$pathShrine=realpath($pathShrine);
	//if($pathShrine[0]=='/') $pathShrine=substr($pathShrine,1,strlen($pathShrine)-1);
	if($pathShrine[strlen($pathShrine)-1]!='/') $pathShrine.='/';
	if($pathShrine=='/') $pathShrine='';
	define('BS',$pathShrine);
	set_include_path(BS);
}

/* config of shrine */
$_CONFIG=array(
//debug configs
	'debug'				=> true,				
	
	'error_display' 	=> false,
	'error_trace'		=> false,
	'error_log_file'	=> false,
//global configs
	'charset'			=>'utf8',
	'locale'			=> null,
	'path_cache'		=>BS.'cache/',
	'path_public'		=>BS.'public/',
	'path_plugins'		=>BS.'plugins/',
	'path_logs'		    =>BS.'logs/',
	'cache_time'		=>	0,
	'template_engine'	=>null,
	'default_plugins'	=>'skins/wskin',
	
//database config
	'db_driver'			=>'mysql',
	'db_host'			=>'blogcd.db.5969029.hostedresource.com',
	'db_port'			=>null,
	'db_username'		=>'blogcd',
	'db_password'		=>'ZXCzxc123',
	'db_database'		=>'blogcd'
	
);
/*
 * debug : set cachetime to 0, error_display to true , error_trace to true 
 * 
 * cache_time : 0 for no cache
 * 
 * 
 * 
 * 
 */
?>