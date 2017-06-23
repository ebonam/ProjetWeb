<?php
include ("sql.php");
session_start();
// TODO: Mieux gérer les erreurs de saisie.
$dbconn = getConnection();
switch ($_SERVER['REQUEST_METHOD'])
{
	case "GET" :
	get_souscriptions($dbconn);
	break;
	case "POST" :
	post_souscriptions($dbconn);
	break;
	case "PUT" :
	put_souscriptions($dbconn);
	break;
	case "DELETE" :
	break;
}
// Récupère les offres selon les paramètres de l'uri
function get_souscriptions($dbconn)
{
	$idForm = $_GET['idForm'];
	$query = "SELECT valide FROM FormulaireSouscrit WHERE idform = $1";
	$result = @pg_query_params($dbconn, $query, array(
		$idForm)
	);
	$arrayResult = pg_fetch_array($result, null, PGSQL_ASSOC);
	$array = array(
		"valide" => $arrayResult['valide']
	);
	echo json_encode($array);
}
function post_souscriptions($dbconn)
{
	$rest_json = file_get_contents("php://input"); // DEBUG $_POST
	$_POST = json_decode($rest_json); // DEBUG $_POST
							
	$idUser = $_POST->login;
	$idOffre = $_POST->idOffre;
	$valide = "false";
	$query = "INSERT INTO FormulaireSouscrit VALUES ($1, $2, $3)";
	$result = @pg_send_query_params($dbconn, $query, array(
		$idUser,
		$idOffre,
		$valide)
	);
	$res = @pg_get_result($dbconn);
	$return = array(
		"errorCode" => pg_result_error_field($res, PGSQL_DIAG_SQLSTATE)
		);
	echo json_encode($return);
}
function put_souscriptions($dbconn)
{
	$rest_json = file_get_contents("php://input"); // DEBUG $_POST
	$_POST = json_decode($rest_json); // DEBUG $_POST
							
	$idUser = $_POST->Votant;
	$idOffre = $_POST->idOffre;
	$valide = "true";
	$query = "UPDATE FormulaireSouscrit SET valide = $1 WHERE utilisateur = $2 AND idform = $3;";
	echo $query;
	$result = pg_send_query_params($dbconn, $query, array(
		$valide,
		$idUser,
		$idOffre)
	);
	$res = pg_get_result($dbconn);
	$return = array(
		"errorCode" => pg_result_error_field($res, PGSQL_DIAG_SQLSTATE)
		);
	echo json_encode($return);
}
?>