<?php
include 'sql.php';

$dbconn = getConnection();

session_start();
// $_SESSION['login'] = "matmat"; // TODO: En dur, faut enlever Mathieu stp sinon tu vas niquer tout le projet.

/*
 * $conn_string = "host=localhost port=5432 dbname=projetPHP user=postgres password=foo";
 * $dbconn = pg_connect($conn_string);
 * $uriArray = explode("/", $_SERVER['REQUEST_URI']);
 */

switch ($_SERVER['REQUEST_METHOD'])
{
	case "GET" :
		$row = get_Message($dbconn);
		echo json_encode($row);
		break;
	case "POST" :
		post_msg($dbconn);
		break;
	case "PUT" :
		
		break;
	case "DELETE" :
		break;
}

// prend les infos du message et l'ajoute à la BDD
function post_msg($dbconn)
{
	$rest_json = file_get_contents("php://input"); // DEBUG $_POST
	$_POST = json_decode($rest_json); // DEBUG $_POST
	                                  
	// Insérer l'envoyeur ici
	if (isset($_SESSION['login']))
	{
		$envoyeur = $_SESSION['login'];
	}
	$receveur = $_POST->username;
	$msgContenu = $_POST->msgContent;
	$dateTime = date('Y-m-d H:i:s');
	$query = "INSERT INTO message(destinataire,receveur,texte,lu,date) VALUES ('" . $envoyeur . "','" . $receveur . "','" . $msgContenu . "',false,'" . $dateTime . "');";
	$result = @pg_send_query($dbconn, $query);
	$res = @pg_get_result($dbconn);
	$return = array(
			"errorCode" => pg_result_error_field($res, PGSQL_DIAG_SQLSTATE)
	);
	echo json_encode($return);
}
function get_Message($dbconn)
{
	//$uriArray = explode("/", $_SERVER['REQUEST_URI']);
	$arrayResult = null;
	// $id = $uriArray[4];
	// $idDest = $uriArray[3];
	$idDest = $_GET['idDest'];
	$id = $_GET['id'];
	// $text=$uriArray[5];
	
	if ($idDest == 'f')
	{
		$query = "SELECT ID , receveur , texte , lu , date
                                        FROM Message
                                        WHERE Destinataire ILIKE '" . $id . "';";
	}
	else
	{
		$query = "SELECT ID , destinataire , texte , lu , date
                                        FROM Message
                                        WHERE receveur ILIKE '" . $id . "';";
	}
	
	$result = pg_query($dbconn, $query);
	while ($row = pg_fetch_assoc($result))
	{
		// $i+=1;
		$arrayResult[] = $row;
	}
	return $arrayResult;
}

?>