<?php

class AppCosmMyposts{ public $_METHODS=array('main'=>'','refresh'=>'');
	public $_CONFIG=array(
		'template_engine'=>'comsenz'
		//'skin'=>'wskin:move,close'
	);
	public function main(){
		/*globalize for wp*/
		global $base,$table_prefix,$blog_id,$timestart,$wpdb,$prefix,$_wp_using_ext_object_cache,$wp_object_cache,$wpmuBaseTablePrefix,$domain,$path,$current_site,$sites,$current_blog,$blogname,$public,$site_id,$PHP_SELF,$filter,$wp_filter,$merged_filters,$wp_current_filter,$allowedposttags,$allowedtags,$wp_version,$wp_db_version,$tinymce_version,$manifest_version,$required_php_version,$required_mysql_version,$wpmu_version,$tableposts,$tableusers,$tablecategories,$tablepost2cat,$tablecomments,$tablelinks,$tablelinkcategories,$tableoptions,$tablepostmeta,$shortcode_tags,$wp_embed,$wp_registered_sidebars,$wp_registered_widgets,$wp_registered_widget_controls,$wp_registered_widget_updates,$_wp_sidebars_widgets,$_wp_deprecated_widgets_callbacks,$delete_blog_obj,$cookiehash,$dh,$mu_plugins,$mu_plugin,$cets_wpmubd,$v3cdf7428,$wpmu_sitewide_plugins,$activation_time,$plugin_file,$wp_actions,$wp_default_secret_key,$self_matches,$pagenow,$is_iphone,$is_chrome,$is_safari,$is_NS4,$is_opera,$is_macIE,$is_winIE,$is_gecko,$is_lynx,$is_IE,$is_apache,$is_IIS,$is_iis7,$l10n,$wp_taxonomies,$wp_rewrite,$wp,$KeyWordsFilterAds,$wp_the_query,$wp_query,$wp_widget_factory,$locale,$locale_file,$weekday,$weekday_initial,$weekday_abbrev,$month,$month_abbrev,$wp_locale,$_wp_theme_features,$current_user,$wp_roles,$wp_user_roles,$user_login,$userdata,$user_level,$user_ID,$user_email,$user_url,$user_pass_md5,$user_identity,$wp_post_types,$wpsmiliestrans,$wp_smiliessearch;
		global $posts;
		require_once('../wp-load.php');
		$posts=get_posts('numberposts=5');

	}
	public function refresh(){
		global $base,$table_prefix,$blog_id,$timestart,$wpdb,$prefix,$_wp_using_ext_object_cache,$wp_object_cache,$wpmuBaseTablePrefix,$domain,$path,$current_site,$sites,$current_blog,$blogname,$public,$site_id,$PHP_SELF,$filter,$wp_filter,$merged_filters,$wp_current_filter,$allowedposttags,$allowedtags,$wp_version,$wp_db_version,$tinymce_version,$manifest_version,$required_php_version,$required_mysql_version,$wpmu_version,$tableposts,$tableusers,$tablecategories,$tablepost2cat,$tablecomments,$tablelinks,$tablelinkcategories,$tableoptions,$tablepostmeta,$shortcode_tags,$wp_embed,$wp_registered_sidebars,$wp_registered_widgets,$wp_registered_widget_controls,$wp_registered_widget_updates,$_wp_sidebars_widgets,$_wp_deprecated_widgets_callbacks,$delete_blog_obj,$cookiehash,$dh,$mu_plugins,$mu_plugin,$cets_wpmubd,$v3cdf7428,$wpmu_sitewide_plugins,$activation_time,$plugin_file,$wp_actions,$wp_default_secret_key,$self_matches,$pagenow,$is_iphone,$is_chrome,$is_safari,$is_NS4,$is_opera,$is_macIE,$is_winIE,$is_gecko,$is_lynx,$is_IE,$is_apache,$is_IIS,$is_iis7,$l10n,$wp_taxonomies,$wp_rewrite,$wp,$KeyWordsFilterAds,$wp_the_query,$wp_query,$wp_widget_factory,$locale,$locale_file,$weekday,$weekday_initial,$weekday_abbrev,$month,$month_abbrev,$wp_locale,$_wp_theme_features,$current_user,$wp_roles,$wp_user_roles,$user_login,$userdata,$user_level,$user_ID,$user_email,$user_url,$user_pass_md5,$user_identity,$wp_post_types,$wpsmiliestrans,$wp_smiliessearch;
		global $posts;
		require_once('../wp-load.php');
		$posts=get_posts('numberposts=5');
		RView::Clear();
		RView::LoadView('default');
	}
}
?>