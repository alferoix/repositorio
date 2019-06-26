<?php

//$urlforcast="http://api.openweathermap.org/data/2.5/forecast/daily?q=London,UK&units=metric&cnt=5&appid=86ea691aa2e4b1c1eba287ad4a31120d";
$urlforcast="https://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22";
$json=file_get_contents($urlforcast);
$data=json_decode($json,true);
var_dump($data);
foreach($data['list'] as $day => $value) { 
	$desc = $value['weather'][0]['description'];
	$max_temp = $value['temp']['max'];
	$min_temp = $value['temp']['min'];
	$pressure = $value['pressure'];
}
    
?>

