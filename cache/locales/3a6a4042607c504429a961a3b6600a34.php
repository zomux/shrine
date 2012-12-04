<?php
function api_location_by_ip($ip){
	$mapLocation=array();
	$xml =null;
	$xml = RWebApi::Call("http://ipinfodb.com/ip_query.php?ip=".$ip,null,'get',null,'209.44.107.13');
	if(!$xml) return null;
	preg_match("@<Status>(.*?)</Status>@si",$xml,$match);
	if(count($match)<2 || $match[1]!='OK' ) return null;
	preg_match("@<CountryName>(.*?)</CountryName>@si",$xml,$match);
	$mapLocation['country']=$match[1];
	preg_match("@<CountryCode>(.*?)</CountryCode>@si",$xml,$match);
	$mapLocation['country_code']=$match[1];
	preg_match("@<RegionCode>(.*?)</RegionCode>@si",$xml,$match);
	$mapLocation['region_code']=$match[1];
	preg_match("@<City>(.*?)</City>@si",$xml,$match);
	$mapLocation['city']=$match[1];
	preg_match("@<Latitude>(.*?)</Latitude>@si",$xml,$match);
	$mapLocation['latitude']=$match[1];
	preg_match("@<Longitude>(.*?)</Longitude>@si",$xml,$match);
	$mapLocation['longtitude']=$match[1];
	preg_match("@<Timezone>(.*?)</Timezone>@si",$xml,$match);
	$mapLocation['timezone']=$match[1];
	preg_match("@<Gmtoffset>(.*?)</Gmtoffset>@si",$xml,$match);
	$mapLocation['gmtoffset']=$match[1];
	preg_match("@<Dstoffset>(.*?)</Dstoffset>@si",$xml,$match);
	$mapLocation['dstoffset']=$match[1];
	return $mapLocation;
}
function api_weather_google($location) {
	/* get weather by latitude and longtitude */
	if( !array_key_exists('latitude',$location) || !array_key_exists('longtitude',$location) ) return null;
	$la=intval($location['latitude'])*1000;
	$lo=intval($location['longtitude'])*1000;
	$requestAddress = 'http://www.google.com/ig/api?hl='.country2language($location['country']).'&weather=,,,'.$la.'000,'.$lo.'000';
	$xml_str = RWebApi::Call($requestAddress,null,'get',null,'64.233.189.99');
	$xml_str=mb_convert_encoding($xml_str,'utf-8','gbk,auto');
	$xml = new SimplexmlElement($xml_str);
	
	$mapWeather=array('info'=>null,'current'=>null,'forecasts'=>array());
	$google='http://www.google.com';

	foreach($xml->weather as $xWeather) {
		foreach($xWeather->forecast_information as $xInfo) {
			$mapWeather['info']=array(
				'date'=>$xInfo->forecast_date['data']
			);
		}

		foreach($xWeather->current_conditions as $xCurrent) {
			$mapWeather['current']=array(
				'condition'=>$xCurrent->condition ['data'],
				'temp_f'=>$xCurrent->temp_f['data'],
				'temp_c'=>$xCurrent->temp_c['data'],
				'humidity'=>$xCurrent->humidity['data'],
				'icon'=>$google.$xCurrent->icon['data'],
				'wind'=>$xCurrent->wind_condition['data'],
			);
		}
		foreach($xWeather->forecast_conditions as $xCond) {
			$mapCond=array(
				'day'=>$xCond->day_of_week['data'],
				'temp_low'=>$xCond->low['data'],
				'temp_high'=>$xCond->high['data'],
				'humidity'=>$xCond->humidity['data'],
				'icon'=>$google.$xCond->icon['data'],
				'condition'=>$xCond->condition['data'],
			);
			array_push($mapWeather['forecasts'],$mapCond);
		}
	}
	return $mapWeather;
}
function country2language($country){ 
	switch(strtolower($country)){
		case 'china': return 'zh_CN';
		case 'japan': return 'ja';
		default: return 'en';
	}
}


class AppCosmWeather{
	public $_CONFIG=array(
		'template_engine'=>'comsenz'
	);
	public function main(){
		global $location,$w_current,$forecasts;
		$location=RSetting::Load('loc:'.$_SERVER["HTTP_X_REAL_IP"]);
		if(!$location){
			$location=api_location_by_ip($_SERVER["HTTP_X_REAL_IP"]);
			if($location) RSetting::Save('loc:'.$_SERVER["HTTP_X_REAL_IP"],$location);
		}
		$weather=api_weather_google($location);
		$w_current=$weather['current'];
		$forecasts=$weather['forecasts'];
		array_shift($forecasts);
		RView::LoadView('default');

		
	}
}
?>