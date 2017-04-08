<?php 

class Distance {

	private $lat;
	private $lon;


	function __construct(){
		$this->lat = isset($_POST['latitude']) ? $_POST['latitude'] : null;
		$this->lon = isset($_POST['longitude']) ? $_POST['longitude'] : null;
	}

	function submitted(){
		if(empty($this->lat) || empty($this->lon)){
			throw new Exception("Where are the coordinates?");
		}else{
			$latlon = array($this->lat, $this->lon);

			$cities = $this->data();

			$distances = array_map(function($cities) use($latlon) {
				$result = array();
			    $a = array_slice($cities, -2);
				$distanceFrom = $this->distanceMeasure($this->lat, $this->lon, $a['lat'], $a['lon']);
				$city = $cities['city'];
				$state = $cities['state'];
				$pop = $cities['pop'];
				$result[] = [$distanceFrom,$city,$state,$pop];
				return $result;
			}, $cities);

			asort($distances);


			echo "</br></br>";
			echo 'Closest cities are: ';
			
			echo "<pre>";
			print_r($distances[13481]);
			echo "</pre>";
			echo "<pre>";
			print_r($cities[key($distances)]);
			echo "</pre>";

		}
	}

	public function data(){
		$list_of_cities = array();
		$file_path = fopen('data/US.txt','r');

		if (($headers = fgetcsv($file_path, 0, "\t")) !== FALSE){
			if($headers){
				while(($line = fgetcsv($file_path, 0, "\t")) !== FALSE){
					if ($line){
						if(sizeof($line)==sizeof($headers)){
							$list_of_cities[] = array_combine($headers, $line);
						}
					}
				}
			}
		}

		fclose($file_path);

		return $list_of_cities;
	}

	public function distanceMeasure($lat1, $lon1, $lat2, $lon2) { 
	  	$x = deg2rad($lon1-$lon2) * cos(deg2rad($lat1));
	  	$y = deg2rad($lat1-$lat2); 
	  	$dist = 6371000.0 * sqrt($x*$x + $y*$y);
	  	return $dist;
	}	

}

