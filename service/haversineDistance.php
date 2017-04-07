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
			    $a = array_slice($cities, -3);
			    echo "<pre>";
				print_r($a);
				echo "<pre>";
			    // return $this->distance($a, $latlon);
			}, $cities);

			// asort($distances);

			// $top_five_cities = array_slice($cities[key($distances)], 0, 5, true);

			// echo "<pre>";
			// print_r($cities);
			// echo "<pre>";

			// echo "</br></br>";
			// echo 'Closest cities are: ';
			// echo "<pre>";
			// print_r($cities[key($distances)]);
			// echo "<pre>";

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

	public function distance($a, $b){
	    list($lat1, $lon1) = $a;
	    list($lat2, $lon2) = $b;

	    $theta = $lon1 - $lon2;
	 //    echo "<pre>";
		// print_r($theta);
		// echo "</pre>";
	    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	    $dist = acos($dist);
	    $dist = rad2deg($dist);
	    $miles = $dist * 60 * 1.1515;
	    return $miles;
	}



	/**
	* Calculates the great-circle distance between two points, with
	* the Haversine formula.
	* @param float $latitudeFrom Latitude of start point in [deg decimal]
	* @param float $longitudeFrom Longitude of start point in [deg decimal]
	* @param float $latitudeTo Latitude of target point in [deg decimal]
	* @param float $longitudeTo Longitude of target point in [deg decimal]
	* @param float $earthRadius Mean earth radius in [m]
	* @return float Distance between points in [m] (same as earthRadius)
	*/

	public function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000){
		// convert from degrees to radians
		$latFrom = deg2rad($latitudeFrom);
		$lonFrom = deg2rad($longitudeFrom);
		$latTo = deg2rad($latitudeTo);
		$lonTo = deg2rad($longitudeTo);

		$latDelta = $latTo - $latFrom;
		$lonDelta = $lonTo - $lonFrom;

		$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
		cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
		return $angle * $earthRadius;
	}

	

}

