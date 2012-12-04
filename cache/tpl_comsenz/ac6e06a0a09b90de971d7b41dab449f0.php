<?php if(!defined('SHRINE_VERSION')) exit('Access Denied'); ?><div class="@subtitle" style="font-size:14px;">Poll: <?php echo $title_poll?> </div>
<?php if(is_array($list_poll)) { foreach($list_poll as $id => $poll) { ?>
<div class="line"> 
<div class="title">
<?php if($need_submit) { ?>
<input name="blogcd_poll" type="radio" id="poll_<?php echo $id?>" />
<?php } ?>
 <?php echo $poll['title']?> <span style="font-size:10px;">| <?php echo $poll['count']?></span> </div>
<div class="rate" style="width:<?php echo $poll['rate']?>%;background:rgb(
<?php echo 150-$poll['rate']; ?>
,
<?php echo 150-$poll['rate']; ?>
,255);"> </div>
</div>
<?php } } ?>
<?php if($need_submit) { ?>
<div style="text-align:center;"><input type="button"  value="submit!" onclick="@submit();"/></div>
<?php } ?>