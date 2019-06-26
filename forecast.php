<?php
//Openweathermaps URL parameters
$LANGUAGE="es";
$CITY_ID="6360513";
$UNITS="metric";
$APPID="86ea691aa2e4b1c1eba287ad4a31120d";

//Openweathermaps call
$urlforcast="http://api.openweathermap.org/data/2.5/forecast?id=$CITY_ID&units=$UNITS&lang=$LANGUAGE&appid=$APPID";

//Data received
$json=file_get_contents($urlforcast);
$data=json_decode($json,true);

//Current weather
$today_id=$data['list'][0]['weather'][0]['id'];
$today_desc=$data['list'][0]['weather'][0]['description'];
$today_date=$data['list'][0]['dt'];
$today=gmdate("Ymd", $today_date);
$today_min=100;
$today_max=-100;
$today_temp=round($data['list'][0]['main']['temp']);
foreach($data['list'] as $day => $value) { 
		
	if($today==gmdate("Ymd", $value['dt']))
	{
		if($today_min>$value['main']['temp_min'])
		{
			$today_min=$value['main']['temp_min'];
		}
		if($today_max<$value['main']['temp_max'])
		{
			$today_max=$value['main']['temp_max'];
		}
	}
}
$today_min=round($today_min);
$today_max=round($today_max);

//Tomorrow weather
$tomorrow_date=strtotime('+1 day', $today_date);
$tomorrow=gmdate("Ymd", $tomorrow_date);
echo $tomorrow;
$tomorrow_min=100;
$tomorrow_max=-100;
foreach($data['list'] as $day => $value) { 
		
	if($tomorrow==gmdate("Ymd", $value['dt']))
	{
		if($tomorrow_min>$value['main']['temp_min'])
		{
			$tomorrow_min=$value['main']['temp_min'];
		}
		if($tomorrow_max<$value['main']['temp_max'])
		{
			$tomorrow_max=$value['main']['temp_max'];
			$tomorrow_id=$value['weather'][0]['id'];
			$tomorrow_desc=$value['weather'][0]['description'];
		}
	}
}
$tomorrow_min=round($tomorrow_min);
$tomorrow_max=round($tomorrow_max);
/*
foreach($data['list'] as $day => $value) { 
	$desc = $value['weather'][0]['description'];
	$icon = $value['weather'][0]['icon'];
	$id = $value['weather'][0]['id'];
	$url_icon="http://openweathermap.org/img/w/$icon.png";
	//echo "<img src=$url_icon>";
	$max_temp = $value['main']['temp_max'];
	$min_temp = $value['main']['temp_min'];
	$pressure = $value['pressure'];
}
*/    
?>

<html>
<head>
<link href="css/owfont-regular.css" rel="stylesheet" type="text/css">
<title>Pronóstico meteorológico</title>
</head>
<body>
El tiempo en Salamanca hoy<br>
<i class="owf owf-<?php echo $today_id;?> owf-5x"></i>
<br>
<?php echo $today_desc;?>
<br>
<?php echo $today_temp;?>ºC
<br>
<?php echo $today_max;?>ºC <?php echo $today_min;?>ºC
<br>
El tiempo en Salamanca mañana<br>
<i class="owf owf-<?php echo $tomorrow_id;?> owf-5x"></i>
<br>
<?php echo $tomorrow_desc;?>
<br>
<?php echo $tomorrow_max;?>ºC <?php echo $tomorrow_min;?>ºC
</body>
</html>

