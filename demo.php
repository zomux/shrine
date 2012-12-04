<?php include('shrine.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SHRINE DEMO PAGE</title>
<script type="text/javascript" src="shrine.js"></script>
</head>

<body>



<script type="text/javascript">
	shrine.launch('demo.general');
</script>

<div>
服务请求测试:<br/><br/>

调用 demo.gerenal 的 square 服务<br/>返回: 
<?php 
	if($ret=RWebApi::Call('http://blog.cc/shrine/service.php',array('app'=>'demo.general','service'=>'square','number'=>36))){
		echo $ret;
	}else{
		echo $ret;
	}
?>
</div>
<div>
调用 demo.gerenal 的 md5 服务<br/>返回: 
<?php 
	if($ret=RWebApi::Call('http://blog.cc/shrine/service.php',array('app'=>'demo.md5','service'=>'square','str'=>'abc'))){
		echo $ret;
	}else{
		echo $ret;
	}
?>
</div>
<div>
<br/><br/>消息发送测试:<br/><br/>
<input type="button" value="发送close消息" onclick=" shrine.send('demo.general','close') " />
</div>
</body>
</html>