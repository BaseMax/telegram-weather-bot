<?php
// Max Base
// https://github.com/BaseMax/telegram-weather-bot
include "TinyTelegramBot.php";
$_res=[
	get("http://api.weatherstack.com/current?access_key=*******&query=berlin"),
	get("http://api.weatherstack.com/current?access_key=*******&query=Amsterdam"),
];
$_res[0]=json_decode($_res[0][0], true);
$_res[1]=json_decode($_res[1][0], true);
$chs=[
        '-***001294257647',
        '-***001479103968',
];
foreach($chs as $i=>$ch) {
$res=$_res[$i];
$chatID=[
	'***', // Admin, User ID
	'***', // Support Team, User ID
	$ch,
];
$res='🌤  The weather today

🔻 City: '.$res["location"]["name"].', '.$res["location"]["country"].'

🔸 Temperature: '.$res["current"]["temperature"].' سانتی گراد
🔸 Weather forecast: '.$res["current"]["weather_descriptions"][0].'
🔸 Wind speed: '.$res["current"]["wind_speed"].'
🔸 Sensible temperature:  '.$res["current"]["feelslike"].' سانتی گراد
🔸 Wind direction:  '.$res["current"]["wind_degree"].' '.$res["current"]["wind_dir"].'
🔸 Time: '.$res["current"]["observation_time"].'

* This message is automatically sent daily to the channel at the same time
🔴 ';
foreach($chatID as $chat) {
	$ress=$res;
	if($chat == '-***001479103968') {
		$ress.='@aqaye_holland';
	}
	else if($chat == '-***001294257647') {
		$ress.='@khanome_german';
	}
	sendMessage($chat, $ress);
}
}
