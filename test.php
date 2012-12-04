<?php
	session_start();
	
	require('library/shrine_core.php');
	if(isset($_POST['text'])){
		if(empty($_SESSION['kaiwa'])){
			$_SESSION['kaiwa']='';
		}
		$text=$_POST['text'];
		$param=array(
			'adcolor'=>'0',
			'asbotname'=>'jabberwacky',
			'conv_id'=>'SE04271759',
			'emotion'=>'',
			'function'=>'',
			'islearning'=>'1',
			'lineref'=>'!01',
			'prevref'=>'ZD000121914',
			'reaction'=>'',
			'sortorder'=>'1',
			'speechtest'=>'1',
			'vText1'=>$_POST['text'],
			'vText1uni'=>$_POST['what'],
			'vText2'=>'',
			'vText3'=>'',
			'vText4'=>'',
			'vText5'=>'',
			'vText6'=>'',
			'vText7'=>'',
			'vText8'=>''
		);
		$ret=RWebApi::Call("http://international.jabberwacky.com/",$param,'post');
		$m=null;
		$r=preg_match("/- .*? - An Artificial Intelligence/", $ret, $m);
		
		if(!$r){
			$say='error occured';
		}else{
			$answer=str_replace(array('- ','An Artificial Intelligence',$text.'.'),'',$m[0]);
			
			$_SESSION['kaiwa']="CdBot: {$answer}\\r\\nMe: {$text}\\r\\n".$_SESSION['kaiwa'];
			$say="<pre><script type=\"text/javascript\">document.write(uniUnesc('".str_replace("'","\\'",$_SESSION['kaiwa'])."'))</script></pre>";
		}
		
	}else{
		$say="";
	}
?>
<html>
<head>
<script type="text/javascript">
$E=function(id){ return document.getElementById(id); };
uniUnesc=function(v){
	return unescape(v.replace(/[|]/g,"%u")).replace(/{\*}/g,"|").replace(/\%u/g,"|");
};
uniEsc=function(v){var c="";var e="";v=v.replace(/[|]/g,"{*}");for(var i=0;i<=v.length;i++){if(v.charCodeAt(i)>255){e=escape(v.charAt(i));if(e.substring(0,2)=="%u"){c+="|"+e.substring(2,e.length)}else{c+=e}}else{c+=v.charAt(i)}}c=c.replace('|201C',"'").replace('|201D',"'").replace('|2018',"'").replace('|2019',"'").replace('`',"'").replace('%B4',"'").replace('|FF20',"").replace('|FE6B',"");return c;};
sub=function(){
	if($E('what').value==''){
		return false;
	}else{ 
		$E('text').value=uniEsc($E('what').value);
		return true;
	}
};
</script>
</head>
<body>

<?php echo $say; ?>
<br/>
<form method="post" onsubmit="sub();">
	<input id="what" type="text" name="what" />
	<input id="text" type="hidden" name="text" />
	
	<input type="submit" value="Say it~" />
</form>
</body>
</html>