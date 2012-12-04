<?php if(!defined('SHRINE_VERSION')) exit('Access Denied'); ?><div class="@city"><?php echo $location['city']?>,<?php echo $location['country']?></div>
<div class="@icon"><img border="0" src="<?php echo $w_current['icon']?>" /></div>
<div class="@condition"><?php echo $w_current['condition']?> ( <?php echo $w_current['temp_c']?>`C / <?php echo $w_current['temp_f']?>`F )&nbsp;&nbsp;&nbsp;<?php echo $w_current['humidity']?></div>
<div class="@desc"><?php echo $w_current['wind']?> </div>