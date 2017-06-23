<?php
/*
 * Input JSON:
 * => login
 * => mdp
 *
 * Output JSON:
 * => verified : bool
 *
 */
include ("sql.php");

$dbconn = getConnection();

switch ($_SERVER['REQUEST_METHOD'])
{
	case "POST" :
		verifyPassword($dbconn);
		break;
	default :
		break;
}
function verifyPassword($dbconn)
{
	$rest_json = file_get_contents("php://input"); // DEBUG $_POST
	$_POST = json_decode($rest_json); // DEBUG $_POST
	$login = $_POST->login;
	$mdp = $_POST->mdp;
	$query = "SELECT mdp FROM Utilisateur WHERE login ILIKE $1";
	$result = pg_query_params($dbconn, $query, array(
			$login
	));
	$hash = pg_fetch_array($result, null, PGSQL_ASSOC)['mdp'];
	$arrayResult = array(
			"verified" => password_verify($mdp, $hash)
	);
	if ($arrayResult['verified'] == true)
	{
		session_start();	
		$_SESSION["login"] = $login;
		$_SESSION["hash"] = $mdp;
	}
	echo json_encode($arrayResult);
}

?>