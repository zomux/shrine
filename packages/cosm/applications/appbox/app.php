<?php
class AppCosmAppbox{
	public $_CONFIG=array(
		'template_engine'=>'comsenz'
	);
	public function main(){
		global $list_apps;
		$ar=RShrine::ListPackage('cosm');
		$list_apps=array();
		foreach($ar as $app){
			$path=RShrine::AppPath($app);
			$fileCfg=$path.'cosm.cfg';
			if(file_exists($fileCfg)){
				if(file_exists($path.'icon.png')){
					$icon='/shrine/packages/cosm/applications/'.str_replace('cosm.','',$app).'/icon.png';
				}else{
					$icon='noicon.png';
				}
				$szCfg=file_get_contents($fileCfg);
				$app=str_replace('cosm.','',$app);
				if($szCfg=='main'){
					array_push($list_apps,array('name'=>$app,'parent'=>'main','icon'=>$icon));
				}else{
					array_push($list_apps,array('name'=>$app,'parent'=>'side','icon'=>$icon));
				}
			}
		}
		RView::Load('default');
	}
}
?>