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