<?php 
if(empty($_GET['c'])) exit;
header("Content-type: text/css;");
switch($_GET['c']){ 
	case 'white':?>
.w1{background:url(w1.png) no-repeat;width:15px;height:15px;}
.w2{background:url(w2.png) repeat-x;height:15px;}
.w3{background:url(w3.png) no-repeat;width:15px;height:15px;}
.w4{background:url(w4.png) repeat-y;width:15px;}
.w5{background:url(w5.png);}
.w6{background:url(w6.png) repeat-y;width:15px;}
.w7{background:url(w7.png) no-repeat;width:15px;height:25px;}
.w8{background:url(w8.png) repeat-x;height:25px;}
.w9{background:url(w9.png) no-repeat;width:15px;height:25px;}
.wskin_closer{width:12px;height:13px;background:url(closer.png) no-repeat;cursor:pointer;}
.wskin_closer:hover{background:url(closer_hover.png) no-repeat;}
<?php break;case 'black': ?>


<?php } ?>
