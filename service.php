<?php
header("Content-type: text/html; charset=utf-8");
require_once('library/shrine_core.php');
//$_POST=array('a'=>'cosm.minipost','f'=>371,'i'=>2,'p'=>'JTIyJXU2MjExJXU1MTY4JXU2NTg3JXU4QkY3JXU2MjExJXU5OTdGJTIy','t'=>'post');

RService::HandleRequest();

if( isset($_GET['r']) && $_GET['r']==1 ){
	/* remote caller */
	if(empty($_GET['a']) || empty($_GET['f']) || empty($_GET['i']) || empty($_GET['t'])) die('ACCESS DENIED');
	$_app=$_GET['a'];
	$_sfx=$_GET['f'];
	$_id=$_GET['i'];
	$_target=$_GET['t'];
	$_param=empty($_GET['p'])?null:hash_from_string($_GET['p']);
	
	if(!defined('SHRINE_MOD')) define('SHRINE_MOD','remote');
	if(!defined('SHRINE_QUERY')) define('SHRINE_QUERY','call_js');
}else{
	/* local caller */
	if(empty($_POST['a']) || empty($_POST['f']) || empty($_POST['i']) || empty($_POST['t'])) die('ACCESS DENIED');
	$_app=$_POST['a'];
	$_sfx=$_POST['f'];
	$_id=$_POST['i'];
	$_target=$_POST['t'];
	$_param=empty($_POST['p'])?null:hash_from_string($_POST['p']);
	if(!defined('SHRINE_MOD')) define('SHRINE_MOD','local');
	if(!defined('SHRINE_QUERY')) define('SHRINE_QUERY','call_ajax');
}




$_CONFIG['id']=$_id;
$_CONFIG['sfx']=$_sfx;

RShrineCore::SetAppEnv($_app,$_id);
ob_start();

$objApp=RShrineCore::LoadAppInstance($_app,$_id,$_sfx);
if(!$objApp) die('ACCESS DENIED');
if(isset($objApp->_CONFIG)){
	$_CONFIG=array_merge($_CONFIG,$objApp->_CONFIG);
}

$retService=null;
try{
	$retService=RShrineCore::CallService($objApp,$_target,$_param);
}catch(Execption $e){
	RError::Log('error in service');
	return false;
}
$_app_views=ob_get_contents();
ob_clean();
$_app_success=true;
$_app_param=$retService;
			
RShrineCore::BackToClient('call_ajax');
?>