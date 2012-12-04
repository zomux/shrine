<?php if(!defined('SHRINE_VERSION')) exit('Access Denied'); ?><span class="subtitle">Newly Registered Blogs</span><br/>
<?php if(is_array($listDomains)) { foreach($listDomains as $ar) { ?>
<a href="http://<?php echo $ar['domain']?>"> <?php echo $ar['title']?>(<?php echo $ar['domain']?>) </a> <br/>
<?php } } ?>