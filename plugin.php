<?php
require_once('library/shrine_core.php');
header("Content-type: text/css;");
//$_GET=array('a'=>'test','i'=>'3','p'=>'1','t'=>'default.css');
if(empty($_GET['p']) || empty($_GET['addr'])) die('ACCESS DENIED');
$plugin=$_GET['p'];
$addr=$_GET['addr'];
$path='plugins/'.$plugin.'/'.basename($plugin).'.js';
if(!file_exists($path)) exit;
$sz=file_get_contents($path);
$sz=str_replace('PATH_PLUGIN',"'".$addr.'plugins/'.$plugin.'/\'',$sz);
echo $sz;
?>