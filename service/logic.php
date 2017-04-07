<?php 

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


// echo "<pre>";
// print_r($list_of_cities);
// echo "</pre>";


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