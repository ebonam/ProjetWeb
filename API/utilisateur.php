<?php
$conn_string = "host=localhost port=5432 dbname=api user=postgres password=postgres";
$dbconn = pg_connect($conn_string);
$uriArray = explode("/", $_SERVER['REQUEST_URI']);

switch ($_SERVER['REQUEST_METHOD'])
{
	case "GET" :
		get_client($dbconn, $uriArray);
		break;
	case "POST" :
		post_client($dbconn, $uriArray);
		break;
	case "PUT" :
		put_client($dbconn, $uriArray);
		break;
	case "DELETE" :
		delete_client($dbconn, $uriArray);
		break;
}
// Connexion et verification du hash, pas le renvoi des informations utilisateurs.
function get_client($dbconn, $uriArray)
{
	if (count($uriArray) >= 5)
	{
		$id = $uriArray[3];
		$password = $uriArray[4];
		$query = "SELECT password FROM utilisateur WHERE pseudonyme ILIKE '" . $id . "';";
		$result = pg_query($dbconn, $query);
		$hash = pg_fetch_array($result, null, PGSQL_ASSOC)['password'];
		$arrayResult = array(
				"verified" => password_verify($password, $hash)
		);
		echo json_encode($arrayResult);
	}
}
// Inscription de l'utilisateur dans la BDD
function post_client($dbconn, $uriArray)
{
	$rest_json = file_get_contents("php://input"); // DEBUG $_POST
	$_POST = json_decode($rest_json); // DEBUG $_POST
	$options = [
			'cost' => 9,
			'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
	];
	$hash = password_hash($password, PASSWORD_BCRYPT, $options) . "\n";
	$query = "INSERT INTO utilisateur VALUES ('" . $_POST->pseudonyme . "', '" . $hash . "');";
	pg_query($dbconn, $query);
}
// Modification des données utilisateur
function put_client($dbconn, $uriArray)
{
	$rest_json = file_get_contents("php://input"); // DEBUG $_POST
	$_POST = json_decode($rest_json); // DEBUG $_POST
	if (count($uriArray) >= 4)
	{
		$id = $uriArray[3];
		$password = $_POST->password;
		$options = [
				'cost' => 9,
				'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
		];
		$hash = password_hash($password, PASSWORD_BCRYPT, $options) . "\n";
		$query = "UPDATE utilisateur SET password = '" . $hash . "' WHERE pseudonyme ILIKE '" . $id . "'";
		pg_query($dbconn, $query);
	}
}
// Suppression de l'utilisateur
function delete_client($dbconn, $uriArray)
{
	if (count($uriArray) >= 4)
	{
		$id = $uriArray[3];
		$query = "DELETE FROM utilisateur WHERE pseudonyme ILIKE '" . $id . "'";
		pg_query($dbconn, $query);
	}
}
?>