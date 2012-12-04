<?php

class AppCosmMinipost{
	public $_CONFIG=array(
		//'template_engine'=>'comsenz'
		//'skin'=>'wskin:move,close'
	);
	public function main(){

	}
	public function post($content){
		if(!is_string($content) || strlen($content)<5 || strlen($content)>300) return false;
		global $base,$table_prefix,$blog_id,$timestart,$wpdb,$prefix,$_wp_using_ext_object_cache,$wp_object_cache,$wpmuBaseTablePrefix,$domain,$path,$current_site,$sites,$current_blog,$blogname,$public,$site_id,$PHP_SELF,$filter,$wp_filter,$merged_filters,$wp_current_filter,$allowedposttags,$allowedtags,$wp_version,$wp_db_version,$tinymce_version,$manifest_version,$required_php_version,$required_mysql_version,$wpmu_version,$tableposts,$tableusers,$tablecategories,$tablepost2cat,$tablecomments,$tablelinks,$tablelinkcategories,$tableoptions,$tablepostmeta,$shortcode_tags,$wp_embed,$wp_registered_sidebars,$wp_registered_widgets,$wp_registered_widget_controls,$wp_registered_widget_updates,$_wp_sidebars_widgets,$_wp_deprecated_widgets_callbacks,$delete_blog_obj,$cookiehash,$dh,$mu_plugins,$mu_plugin,$cets_wpmubd,$v3cdf7428,$wpmu_sitewide_plugins,$activation_time,$plugin_file,$wp_actions,$wp_default_secret_key,$self_matches,$pagenow,$is_iphone,$is_chrome,$is_safari,$is_NS4,$is_opera,$is_macIE,$is_winIE,$is_gecko,$is_lynx,$is_IE,$is_apache,$is_IIS,$is_iis7,$l10n,$wp_taxonomies,$wp_rewrite,$wp,$KeyWordsFilterAds,$wp_the_query,$wp_query,$wp_widget_factory,$locale,$locale_file,$weekday,$weekday_initial,$weekday_abbrev,$month,$month_abbrev,$wp_locale,$_wp_theme_features,$current_user,$wp_roles,$wp_user_roles,$user_login,$userdata,$user_level,$user_ID,$user_email,$user_url,$user_pass_md5,$user_identity,$wp_post_types,$wpsmiliestrans,$wp_smiliessearch;
		require_once('../wp-load.php');
		require_once('../wp-admin/includes/taxonomy.php');
		
		$idCat=get_cat_id('微博');
		if(!$idCat) $idCat=wp_create_category('微博');  

		$my_post = array();
		$my_post['post_title'] = str_cut($content,8).' @'.date('n/j l');
		$my_post['post_content'] = $content;
		$my_post['post_status'] = 'publish';
		$my_post['comment_status'] = 'open';
		$my_post['post_category'] = array($idCat);

		// Insert the post into the database
		return wp_insert_post( $my_post );
	}
}
?>