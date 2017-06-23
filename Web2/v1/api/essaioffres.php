<?php
include ('httpful.phar');

$uri = "http://127.0.0.1/API/V1/offres.php?departement=59&type=true&prixmax=50&domaines=Animalerie,Cours";

$array = array(
		"type" => "true",
		"departement" => "59",
		"prixmax" => "komaliss"
);

$json = json_encode($array);

$response = \Httpful\Request::GET($uri)->body($json)->sendsJson()->send();
echo $response;
?>