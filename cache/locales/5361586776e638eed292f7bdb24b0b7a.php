<?php if(!defined('SHRINE_VERSION')) exit('Access Denied'); ?><div>
<div class="label">最近发布博文</div>
<?php if(is_array($posts)) { foreach($posts as $post) { ?>
<div class="text" style="border-top:#eee 1px solid;margin-bottom:2px;">
<?php echo str_cut($post->post_content ,100) ; ?>
 </div>
<div class="label"><a href="/?p=
<?php echo $post->ID ; ?>
" target="_blank">查看</a> 
<?php echo str_cut($post->post_title ,12) ; ?>
 @
<?php echo $post->post_date ; ?>
 |评论:
<?php echo $post->comment_count ; ?>
 </div>
<?php } } ?>
<div>