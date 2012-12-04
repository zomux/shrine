<?php
class AppBlogcdNewlist{
	public $_CONFIG=array(
		'template_engine'=>'comsenz'
	);
	public function main(){
		$arBlogs=RModel::FindModels('blogcd.blog','order by blog_id DESC',null,8);
		global $listDomains;
		$cDomains=new RCacher();
		$cDomains->setCategory('site_index');
        $cDomains->setCacheTime(3600);
        $fileDomains=$cDomains->load('recent_domains');
		if(!$fileDomains){
			$listDomains=array();
			for($i=0;$i<count($arBlogs);$i++){
				$domain=$arBlogs[$i]->domain;
				$modSignup=RModel::FindOneModel('blogcd.signup','where domain="'.$domain.'"');
				if(!$modSignup) $title='';
				else $title=$modSignup->title;
				array_push($listDomains,array('domain'=>$domain,'title'=>$title));
			}
			$cDomains->save('recent_domains',serialize($listDomains));
		}else{
			$listDomains=unserialize($cDomains->loadContent('recent_domains'));
		}
		
		
		
	}
}
?>