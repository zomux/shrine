<?php
require_once('library/shrine_core.php');
header("Content-type: text/css;");
//$_GET=array('a'=>'test','i'=>'3','p'=>'1','t'=>'default.css');
if(empty($_GET['a']) || empty($_GET['t'])) die('ACCESS DENIED');
$_app=$_GET['a'];
$ctrl=$_GET['t'];
$_CONFIG['app_name']=$_app; 

if(!RShrine::AppExists($_app)) die('ACCESS DENIED');
$path=RShrine::AppPath($_app);
if(substr($ctrl,strlen($ctrl)-4,4)!='.css'){
	
	$ctrl.='.css';
}
$ctrl=str_replace('%25resource%25/','%resource%/',$ctrl);
$ctrl2=$path.'%resource%/'.$ctrl;
$ctrl=$path.$ctrl;
if(!file_exists($ctrl)){
	$ctrl=$ctrl2;
	if(!file_exists($ctrl)) die('ACCESS DENIED');
}
global $_global_app,$_global_path_res;
$_global_app=str_replace('.','_',$_app);
$_global_path_res=$path.'%25resource%25/';
@include(RShrineCore::GetCache($ctrl,'style'));
?>