<?php if(!defined('SHRINE_VERSION')) exit('Access Denied'); ?><div>
<div class="label">最近评论</div>
<?php if(is_array($comments)) { foreach($comments as $comment) { ?>
<div class="text" style="border-top:#eee 1px solid;margin-bottom:2px;">
<?php echo str_cut(preg_replace('/<[^>]+>(.*)<\/[^>]+>/U','',$comment->comment_content) ,100) ; ?>
 </div>
<div class="label"><a href="/?p=
<?php echo $comment->comment_post_ID ; ?>
">查看</a> <a href="javascript:" onclick="@delete(
<?php echo $comment->comment_ID ; ?>
);">删除</a> |by 
<?php echo $comment->comment_author ; ?>
</div>
<?php } } ?>
<div>