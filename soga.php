<?php
	ini_set('display_errors','on');

	file_put_contents("test.txt","wow");
	echo file_get_contents("test.txt");
	
	exit;
	//include('library/shrine_core.php');
	//echo unescape(base64_decode('JXU5QTZDJXU2NzVD'));
	
	//$o=array('asdasd'=>'sadasd','asdfas'=>1,'c'=>array(1,2,3));

	//var_dump( hash_from_string('JTdCJTIyYXNkYXNkJTIyJTNBJTIyc2FkYXNkJTIyJTJDJTIyYXswNkZmFzJTIyJTNBMSUyQyUyMmMlMjIlM0ElNUIxJTJDMiUyQzMlNUQlN0Q='));
	//echo hash_to_string('<div id="sasa">');
	
?>
<!--
<html>
<head>
		
</head>
<body><pre>
		<?php
		//$_modName='test';
		//echo file_get_contents(RShrineCore::GetCache('models/test.php','model'));
		//include('models/test.php');
		//$test=new ModelTest();
		//var_dump(RDatabase::LoadTable('test'));
		//$test->title=date('h-m-s');
		//var_dump($test);
		//$test->save();
		//$arr = array('a','b');
		//$obj = (object)$arr;
		//var_dump($obj);
		//echo mysql_error();
		?>
</pre></body>
</html>
-->
<html>
	<head>
	<script type="text/javascript" src="shrine.js" ></script>
	</head>
	<body>
	<?php //RShrine::Launch('test'); ?>
	<?php //RShrine::Launch('chat'); ?>
	</body>
</html>
