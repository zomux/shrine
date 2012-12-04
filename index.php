<?php
	require_once('library/shrine_core.php');
	/* reply service require */
	RService::HandleRequest();
	define('CONSOLE_WELCOME', "SHRINE CONSOLE ACCESSED\r\n");
	if(empty($_SESSION['_shrine_console'])){
		$_SESSION['_shrine_console']=CONSOLE_WELCOME;
		$_SESSION['_shrine_console_deli']='>';
		$_SESSION['_shrine_console_access']=0;
	}

	if(isset($_POST['cmd'])){
		$szResult=RCommand::Run($_POST['cmd'],true);
		if($szResult===null){
			$szResult="Error : This Command Cannot be found in the system.\r\n";
		}
		$_SESSION['_shrine_console'].=$_SESSION['_shrine_console_deli'].$_POST['cmd']."\r\n".$szResult."\r\n";
	}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title></title>
		<style>
			body{ font-size:16px; }
			.input{ font-weight:bold;font-size:18px; }
			input{ border:none;background:white; }
			
		</style>
	</head>
	<body onload="document.getElementById('cmd').focus();">
		<form method="post">
		<pre><?php
			echo $_SESSION['_shrine_console'];
		?></pre>
		<span style="input"><?php echo htmlspecialchars($_SESSION['_shrine_console_deli']); ?><input id="cmd" name="cmd" value="" /></span>
		</form>
	</body>
</html>
