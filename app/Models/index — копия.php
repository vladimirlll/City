<?php

use App\Models\Zoom_Api;

$zoom_meeting = new Zoom_Api();

// входные данные
$data = array();
$data['topic'] 		= 'Consultation'; // название конференции
$data['start_date'] = date('Y-m-d\TH:i:s', strtotime("2022-12-12T12:00"));
$data['duration'] 	= 60; // продолжительность
$data['type'] 		= 2;
$password = function() // функция генерации пароля
{
	$label = ["q","w","e","r","t", "y", "u", "i","o","p","a","s","d","f","g","h","j","k","l","z","x","c","v","b","n","m"];
	return "".rand(10,99).$label[rand(0, 25)].rand(10,99);;
};
$data['password'] 	= $password(); //пароль


$response = $zoom_meeting->createMeeting($data);//создаём митинг
// print_r($response);
// echo "<br>";
// if (isset($response->id))
// 	echo 'sozdano';
// else
// 	echo 'net';
//echo (isset($response->id));
echo "<br>";
echo getMetting($response); // выводим митинг на экран

function getMetting($response) // возвращаем инфу про митинг
{
	return "Meeting ID: ". $response->id."<br>"."Time: "	
	. $response->start_time."<br>"."Topic: "	. 
	$response->topic."<br>"."Join URL: ". $response->join_url .
	"<a href='". $response->join_url ."'>Open URL</a>"."<br>"."Meeting Password: ". $response->password;
   }
?>