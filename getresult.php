<?php
  	require_once("inc/session.php");
	require_once("inc/class.user.php");
	$root=$_SERVER["DOCUMENT_ROOT"];
	$result = json_decode(exec('python '.$root.'/mintair/aqping1.py'));
    $temp=$result->temperature;
    $humidity=$result->Humidity;
    $Co2=$result->Co2;
    $tvoc=$result->TvoC;
    $pm2_5=$result->pm2_5;
    $pm10=$result->pm10;
    $aqi=$result->Aindex;
    $aqv=$result->Avalue;
	$data=array(
	 	'temp' =>$temp,
	 	'humidity' =>$humidity,
	 	'co2' =>$Co2,
	 	'tvoc' =>$tvoc,
	 	'pm2_5' =>$pm2_5,
	 	'pm10' =>$pm10,
	 	'aqi' =>$aqi,
	 	'aqv' =>$aqv
	 );
    echo json_encode($data);
             
?>