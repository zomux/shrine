<?php
$useage="Useage:
command to do with application.
app create [appname]
app check [appname]
app delete [appname]";
$txtAppFile="
<?php
class [CLASSAPP]{
	public function main(){
	
	}
}
?>";
if(count($param)<2){
	echo $useage;
}else{
	switch($param[0]){
		case 'create':
			$szApp=$param[1];
			$szPath=RShrine::AppPath($szApp);
			if(!file_exists($szPath)){
				if(mkdirs($szPath)) echo "$szPath created.\r\n";
				if(mkdirs($szPath.'views')) echo "$szPath/views/ created.\r\n";
				if(mkdirs($szPath.'controllers')) echo "$szPath/controllers/ created.\r\n";
				if(mkdirs($szPath.'locales')) echo "$szPath/locales/ created.\r\n";
				if(mkdirs($szPath.'%resource%')) echo "$szPath/%resource%/ created.\r\n";
				$arySplitApp=explode('.',$szApp);
				if(file_exists($szPath)){
					switch(count($arySplitApp)){
						/* App Class Name : AppPackageClass */
						case 1:
							$xApp=$app;
							$xApp[0]=strtoupper($xApp[0]);
							$xApp='App'.$xApp;
							break;
						case 2:
							$szPack=$arySplitApp[0];
							$xApp=$arySplitApp[1];
							$szPack[0]=strtoupper($szPack[0]);
							$xApp[0]=strtoupper($xApp[0]);
							$xApp='App'.$szPack.$xApp;
							break;
						default:
							echo 'app create:the appname is invaild.';
							break;
					}
					if(isset($xApp)){
						$txtAppFile=str_replace('[CLASSAPP]',$xApp,$txtAppFile);
						if(file_put_contents($szPath.'app.php',$txtAppFile)){
							echo "$szPath/app.php created.";
						}
					}
				}else{
					echo 'app create: access folder fail.';
				}
			}else{
				echo 'app create: the application  already exists.';
			}
			break;
	}
}