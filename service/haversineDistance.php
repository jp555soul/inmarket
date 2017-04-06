<?php 

$list_of_cities = explode("\n", file_get_contents('data/US.txt'));

echo "<pre>";
print_r($list_of_cities);
echo "</pre>";

class Distance {

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


	//$ref = array(49.648881, -103.575312);

	

	// $items = array(
	//     '0' => array('item1','otheritem1details....','55.645645','-42.5323'),
	//     '1' => array('item1','otheritem1details....','100.645645','-402.5323')
	// );

	// $distances = array_map(function($item) use($ref) {
	//     $a = array_slice($item, -2);
	//     return distance($a, $ref);
	// }, $items);

	// asort($distances);

	// echo 'Closest item is: ', var_dump($items[key($distances)]);


	public function distance($a, $b){
	    list($lat1, $lon1) = $a;
	    list($lat2, $lon2) = $b;

	    $theta = $lon1 - $lon2;
	    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	    $dist = acos($dist);
	    $dist = rad2deg($dist);
	    $miles = $dist * 60 * 1.1515;
	    return $miles;
	}

}

