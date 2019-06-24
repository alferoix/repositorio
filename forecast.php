<?php

$urlforcast="http://api.openweathermap.org/data/2.5/forecast?id=6360513&units=metric&lang=es&appid=86ea691aa2e4b1c1eba287ad4a31120d";
$json=file_get_contents($urlforcast);
$data=json_decode($json,true);
//var_dump($data);
$today_id=$data['list'][0]['weather'][0]['id'];
$today_desc=$data['list'][0]['weather'][0]['description'];
$today_date=$data['list'][0]['dt'];
echo gmdate("Y-m-d\TH:i:s\Z", $today_date);
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
    
?>

<html>
<head>
<link href="css/owfont-regular.css" rel="stylesheet" type="text/css">
<title>Pronóstico meteorológico</title>
</head>
<body>
El tiempo en Salamanca<br>
<i class="owf owf-<?php echo $today_id;?> owf-5x"></i>
<br>
<?php echo $today_desc;?>
<br>
<?php echo $max_temp;?>ºC <?php echo $min_temp;?>ºC
</body>
</html>

