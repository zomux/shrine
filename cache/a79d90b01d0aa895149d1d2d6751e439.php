<?php if(!defined('SHRINE_VERSION')) exit('Access Denied'); ?><div class="subtitle"><?php echo $location['city']?>,<?php echo $location['country']?></div>
<div>
<div style="display:block;width:150px;height:100px;float:left;text-align:center;">
<div class="label">现在</div>
<div><img border="0" src="<?php echo $w_current['icon']?>" /></div>
<div class="text"><?php echo $w_current['condition']?> ( <?php echo $w_current['temp_c']?><sup>o</sup>C / <?php echo $w_current['temp_f']?><sup>o</sup>F )</div>
<div class="text"><?php echo $w_current['humidity']?> </div>
</div>
<?php if(is_array($forecasts)) { foreach($forecasts as $cast) { ?>
<div style="display:block;width:150px;height:100px;float:left;text-align:center;">
<div class="label"><?php echo $cast['day']?></div>
<div><img border="0" src="<?php echo $cast['icon']?>" /></div>
<div class="text"><?php echo $cast['condition']?></div>
<div class="text"><?php echo $cast['temp_low']?><sup>o</sup>C - <?php echo $cast['temp_high']?><sup>o</sup>C</div>
</div>
<?php } } ?>
<div class="clear"></div>
</div>