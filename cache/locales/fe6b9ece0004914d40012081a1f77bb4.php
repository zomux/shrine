<?php if(!defined('SHRINE_VERSION')) exit('Access Denied'); ?><div class="@box">
<div>COSM OS工具库 &nbsp; <input type="button" value="调整工具" onclick="manager_apps();this.value= this.value=='调整工具'? '结束调整':'调整工具'" /></div>
<?php if(is_array($list_apps)) { foreach($list_apps as $app) { ?>
<div class="@app" onclick="app_load('cosm.<?php echo $app['name']?>','<?php echo $app['parent']?>');">
<div class="@icon" style="background:url(<?php echo $app['icon']?>) no-repeat;"></div>
<div class="@name label" ><?php echo $app['name']?></div>
</div>
<?php } } ?>
<div class="clear"></div>
<div>