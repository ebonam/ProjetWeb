<?php
include ('httpful.phar');

$uri = "http://127.0.0.1/API/connexion/komalis/";

$array = array(
		"pseudonyme" => "komaliss",
		"password" => "onchee"
);

$json = json_encode($array);

$response = \Httpful\Request::delete($uri)->body($json)->sendsJson()->send();
echo $response;
?>