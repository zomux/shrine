<?php
class RWebApi{
	public static function Call($url,$param=null,$protoSend='get',$protoReceive=null,$ip=null){
		if(!$protoSend) $protoSend='get';
		$token=RWebApi::TokenBox($url);
		if($token){
			if(array_key_exists('protocol_send',$token)) $protoSend=$token['protocol_send'];
			if(array_key_exists('protocol_receive',$token)) $protoReceive=$token['protocol_receive'];
			if(array_key_exists('ip',$token)) $ip=$token['ip'];
			if(array_key_exists('url',$token)) $url=$token['url'];
		}
		$szResponse=RWebApi::SockOpen($url,$param,$protoSend,$ip);
		if(!$protoReceive){
			return $szResponse;
		}else{
			switch($protoReceive){
				case 'xml':
				case 'soap':
					return xml2array($szResponse);
				break;
				default:
					return $szResponse;
			}
		}
	}
	public static function TokenBox($token){
		
		return null;
	}
	public static function SockOpen($url,$param,$method='get', $ip = '',$limit = 0,$cookie = '',  $timeout = 15, $block = TRUE) {
		$return = '';
		$matches = parse_url($url);
		/* GET Param -> query */
		if($method=='get' && is_array($param)){
			$arExps=array();
			foreach($param as $k=>$v){
				array_push($arExps,strval($k).'='.strval($v));
			}
			$exp=implode('&',$arExps);
			if(isset($matches['query']) && $matches['query']){
				$matches['query']=$matches['query'].'&'.$exp;
			}else{
				$matches['query']=$exp;
			}
		}
		$host = $matches['host'];
		$path = $matches['path'] ? $matches['path'].(isset($matches['query']) && $matches['query'] ? '?'.$matches['query'] : '') : '/';
		$port = !empty($matches['port']) ? $matches['port'] : 80;

		switch($method){
			case 'post':
				if(is_array($param)){
					$arExps=array();
					foreach($param as $k=>$v){
						array_push($arExps,strval($k).'='.strval($v));
					}
					$exp=implode('&',$arExps);
				}
				$out = "POST $path HTTP/1.0\r\n";
				$out .= "Accept: */*\r\n";
				//$out .= "Referer: $boardurl\r\n";
				$out .= "Accept-Language: zh-cn\r\n";
				$out .= "Accept-Charset: utf-8\r\n";
				$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
				$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
				$out .= "Host: $host\r\n";
				$out .= 'Content-Length: '.strlen($exp)."\r\n";
				$out .= "Connection: Close\r\n";
				$out .= "Cache-Control: no-cache\r\n";
				$out .= "Cookie: $cookie\r\n\r\n";
				$out .= $exp;
			break;
			case 'get':
				$out = "GET $path HTTP/1.0\r\n";
				$out .= "Accept: */*\r\n";
				//$out .= "Referer: $boardurl\r\n";
				$out .= "Accept-Language: zh-cn\r\n";
				$out .= "Accept-Charset: utf-8\r\n";
				$out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
				$out .= "Host: $host\r\n";
				$out .= "Connection: Close\r\n";
				$out .= "Cookie: $cookie\r\n\r\n";
			break;
			case 'xml':
			case 'soap':
			case 'json':
			case 'shrine':
				if(is_array($param)){
					if($method=='shrine'){
						$param=hash_to_string($param);
					}else if($method=='json'){
						$json=new RJSON();
						$param=$json->encode($param);
					}else{
						$param=array2xml($param);
					}
				}else if(!is_string($param)){
					$param=strval($param);
				}
				$out = "POST $path HTTP/1.1\r\n";
				$out .= "Accept: */*\r\n";
				//$out .= "Referer: $boardurl\r\n";
				$out .= "Accept-Language: zh-cn\r\n";
				$out .= "Accept-Charset: utf-8\r\n";
				$out .= "Content-Type: application/soap+xml; charset=utf-8\r\n";
				$out .= "Host: $host\r\n";
				$out .= 'Content-Length: '.strlen($param)."\r\n";
				$out .= "Cache-Control: no-cache\r\n";
				$out .= "Cookie: $cookie\r\n\r\n";
				$out .= $param;
			break;
		} 
		$fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
		if(!$fp) {
			return '';
		} else {
			stream_set_blocking($fp, $block);
			stream_set_timeout($fp, $timeout);
			@fwrite($fp, $out);
			$status = stream_get_meta_data($fp);
			if(!$status['timed_out']) {
				while (!feof($fp)) {
					if(($header = @fgets($fp)) && ($header == "\r\n" ||  $header == "\n")) {
						break;
					}
				}

				$stop = false;
				while(!feof($fp) && !$stop) {
					$data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
					$return .= $data;
					if($limit) {
						$limit -= strlen($data);
						$stop = $limit <= 0;
					}
				}
			}
			@fclose($fp);
			return $return;
		}
	}
}

?>