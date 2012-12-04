<?php
class RService{
	public static function Call($app,$service,$protocol='get',$accept=null,$show=false){
		global $_CONFIG;
		if(!RShrine::AppExists($app)){
			if($show) echo 'ACCESS DENIED';
			return null;
		}
		$oApp=RShrineCore::LoadAppInstance($app,0,0);
		if(!$oApp){
			if($show) echo 'ACCESS DENIED';
			return null;
		}
		
		if(!array_key_exists('service',$_CONFIG) || !is_array($_CONFIG['service']) || !in_array($service,$_CONFIG['service'])){
			if($show) echo 'ACCESS DENIED';
			return null;
		}
		/* make param */
		try{
			switch($protocol){
				case 'get':
					$param=$_GET;
					break;
				case 'post':
					$param=$_POST;
					break;
				case 'serialize':
					$param=unserialize(file_get_contents('php://input'));
					break;
				case 'xml':
				case 'soap':
					$param=xml2array(file_get_contents('php://input'));
					break;
				case 'json':
					$json=new RJSON();
					$param=hash_from_string(file_get_contents('php://input'));
					$param=$json->decode($param);
					break;
				case 'shrine':
					$param=hash_from_string(file_get_contents('php://input'));
					break;
			}
		}catch(Expection $e){
			$param=array();
		}
		$ret=RShrineCore::CallService($oApp,$service,$param);
		/* make output */
		switch($accept){
			case 'serialize':
				if($show) echo serialize($ret);
				break;
			case 'xml':
			case 'soap':
				if($show) echo array2xml($ret);
				break;
			case 'shrine':
				if($show) echo hash_to_string($ret);
				break;
			case 'json':
				if($show){$json=new RJSON();echo $json->encode($ret);}
				break;
			default:
				if($show) echo $ret===null? 'null':strval($ret);
		}
		return $ret;
	}
	public static function HandleRequest(){
		if( isset($_GET['app']) && isset($_GET['service']) ){
			/* webapi service  */
			$proto= isset($_GET['protocol']) ? $_GET['protocol']:'get';
			$accept= isset($_GET['accept']) ? $_GET['accept']:null;
			RService::Call($_GET['app'],$_GET['service'],$proto,$accept,true);
			exit;
		}
	}
}

?>