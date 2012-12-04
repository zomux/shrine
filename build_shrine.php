<?php 
session_start();
@require_once('config.php');
$address=str_replace('build_shrine.php','',$_SERVER['PHP_SELF']);
$output=file_get_contents('library/shrine.js');
$output=str_replace('{$address}',$address,$output);

if(file_exists('library/extern_jsmin.php') && !$_CONFIG['debug']){
	@require_once('library/extern_jsmin.php');
	define('EXTERN_JSMIN',true);
	$output= JSMin::minify($output);
}else{
	define('EXTERN_JSMIN',false);	
}
if(array_key_exists('default_plugins',$_CONFIG) && $_CONFIG['default_plugins']){
	$arPlugs=split(',',$_CONFIG['default_plugins']);
	for($i=0;$i<count($arPlugs);$i++){
		$p=$arPlugs[$i];
		if(substr($p,strlen($p)-3,3)!='.js'){
			$arFlod=split('/',$p);
			
			$p.='/'.$arFlod[count($arFlod)-1].'.js';
		}
		$p=$_CONFIG['path_plugins'].$p;
		$path=$address.substr($p,0,strrpos($p,'/')+1);
		if(file_exists($p)){
			$output .= "\r\n";
			$cont=file_get_contents($p);
			$cont=str_replace('PATH_PLUGIN','\''.$path.'\'',$cont);
			$output.= EXTERN_JSMIN? JSMin::minify($cont):$cont;
		}
	}
}
file_put_contents('shrine.js',$output);
echo 'BUILD SUCCESSED';
/**
 * 
 *  cache needed
 */
?>