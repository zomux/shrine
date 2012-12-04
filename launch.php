<?php
header("Content-type: text/html; charset=utf-8");
require_once('library/shrine_core.php');
//$_POST=array('a'=>'blogcd.weather','f'=>'4085312','i'=>2,'p'=>'JTdCJTdE');
if( isset($_GET['r']) && $_GET['r']==1 ){
	/* remote caller */
	if(empty($_GET['a']) || empty($_GET['f']) || empty($_GET['i'])) die('ACCESS DENIED');
	$_app=$_GET['a'];
	$_sfx=$_GET['f'];
	$_id=$_GET['i'];
	$_param=empty($_GET['f'])?null:hash_from_string($_GET['p']);
	if(!defined('SHRINE_MOD')) define('SHRINE_MOD','remote');
	if(!defined('SHRINE_QUERY')) define('SHRINE_QUERY','launch_js');
}else{
	/* local caller */
	if(empty($_POST['a']) || empty($_POST['f']) || empty($_POST['i'])) die('ACCESS DENIED');
	$_app=$_POST['a'];
	$_sfx=$_POST['f'];
	$_id=$_POST['i'];
	$_param=empty($_POST['f'])?null:hash_from_string($_POST['p']);
	if(!defined('SHRINE_MOD')) define('SHRINE_MOD','local');
	if(!defined('SHRINE_QUERY')) define('SHRINE_QUERY','launch_ajax');
}


$_CONFIG['id']=$_id;
$_CONFIG['sfx']=$_sfx;

RShrine::Launch($_app,$_param);

?>