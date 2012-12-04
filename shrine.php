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
	//set_include_path(BS);
}
require_once('library/shrine_core.php');
?>