<?php
include ('httpful.phar');

$uri = "http://127.0.0.1/BenjaminWeb/v1/api/avis/";

$array = array(
		"Cible" => "onche", // UNIQUE
		"Votant" => "onche",
		"Description" => "onche",
		"date" => "01/01/1996",
		"note" => 3
);

$json = json_encode($array);

$response = \Httpful\Request::get($uri)->body($json)->sendsJson()->send();
echo $response;
?>