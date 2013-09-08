<?php
class Location{
	
	public $cityName;
	public $countryCode;
	public $regionName;
	public $countryName;
	public $latitude;
	public $longitude;
	
	function getLocationByIp(){
		$data = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='. $_SERVER["REMOTE_ADDR"]));
		if ( $data ){
			$this->cityName = $data['geoplugin_city'];
			$this->countryCode = $data['geoplugin_countryCode'];
			$this->regionName = $data['geoplugin_regionName'];
			$this->countryName = $data['geoplugin_countryName'];
			$this->latitude = $data['geoplugin_latitude'];
			$this->longitude = $data['geoplugin_longitude'];
		}
	}
	
	function getDefaultLocation(){
		$this->cityName = 'San Francisco';
		$this->countryCode = 'US';
		$this->regionName = 'California';
		$this->countryName = 'United States';
		$this->latitude = '37.7879309';
		$this->longitude = '-122.4074981';
	}
	
}
?>