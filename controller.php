<?php
require_once('library/shrine_core.php');
header("Content-type: text/javascript;");
//$_POST=array('a'=>'test','i'=>'3','p'=>'1','t'=>'default');
if(empty($_GET['a']) || empty($_GET['i']) || empty($_GET['p']) || empty($_GET['t'])) die('ACCESS DENIED');
$_app=$_GET['a'];
$ctrl=$_GET['t'];
$_id=$_GET['i'];
$_proc=$_GET['p'];
$_CONFIG['app_name']=$_app;
$_CONFIG['app_id']=$_id;
if(!RShrine::AppExists($_app)) die('ACCESS DENIED');
$path=RShrine::AppPath($_app);
if(substr($ctrl,strlen($ctrl)-3,3)!='.js'){
	
	$ctrl.='.js';
}
$ctrl=$path.'controllers/'.$ctrl;
if(!file_exists($ctrl)) die('ACCESS DENIED');
$code=file_get_contents(RShrineCore::GetCache($ctrl,'controller'));
$code=str_replace('##SHRINE_HANDLE##',$_id,$code);
$code=str_replace('##SHRINE_PROC##',$_proc,$code);
echo $code;
?>