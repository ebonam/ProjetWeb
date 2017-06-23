<?php
function getConnection()
{
	$utilisateur = "postgres";
	$password = "postgres";
	$database = "api";
	$conn_string = "host=localhost port=5432 dbname=" . $database . " user=" . $utilisateur . " password=" . $password . "";
	return pg_connect($conn_string);
}
?>