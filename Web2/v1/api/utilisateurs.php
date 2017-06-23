<?php
include ("sql.php");

// TODO: Mieux gérer les erreurs de saisie.

$dbconn = getConnection();

switch ($_SERVER['REQUEST_METHOD'])
{
	case "GET" :
	get_utilisateurs($dbconn);
	break;
	case "POST" :
	post_utilisateurs($dbconn);
	break;
	case "PUT" :
	put_utilisateurs($dbconn);
	break;
	case "DELETE" :
	delete_utilisateurs($dbconn);
	break;
}
function get_utilisateurs($dbconn)
{
	if (isset($_GET['login']))
	{
		$login = $_GET['login'];
		$query = "SELECT * FROM Utilisateur WHERE login ILIKE $1";
		
		$result = pg_query_params($dbconn, $query, array(
			$login
			));
		$arrayResult = pg_fetch_array($result, null, PGSQL_ASSOC);
		$array = array(
			"login" => $arrayResult['login'],
			"mdp" => $arrayResult['mdp'],
			"mail" => $arrayResult['mail'],
			"nom" => $arrayResult['nom'],
			"ville" => $arrayResult['ville'],
			"departement" => $arrayResult['departement'],
			"notation" => $arrayResult['notation'],
			"points" => $arrayResult['points']
			);
		echo json_encode($array);
	}
	else
	{
		$query = "SELECT * FROM Utilisateur";
		
		$arrayToReturn = array();
		
		$result = pg_query($dbconn, $query);
		
		while ($arrayResult = pg_fetch_array($result))
		{
			$array = array(
				"login" => $arrayResult['login'],
				);
			array_push($arrayToReturn, $array);
		}
		
		echo json_encode($arrayToReturn);
	}
}
function post_utilisateurs($dbconn)
{
	$rest_json = file_get_contents("php://input"); // DEBUG $_POST
	$_POST = json_decode($rest_json); // DEBUG $_POST
	$login = $_POST->login;
	$mdp = $_POST->mdp;
	$options = [
	'cost' => 9,
	'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
	];
	$hash = password_hash($mdp, PASSWORD_BCRYPT, $options);
	$mail = $_POST->mail;
	$nom = $_POST->nom;
	$ville = $_POST->ville;
	$departement = $_POST->departement;
	$notation = 3;
	$points = 50;
	$query = "INSERT INTO Utilisateur VALUES ($1, $2, $3, $4, $5, $6, $7, $8);";
	$result = @pg_send_query_params($dbconn, $query, array(
		$login,
		$hash,
		$mail,
		$nom,
		$ville,
		$departement,
		$notation,
		$points
		));
	$res = @pg_get_result($dbconn);
	$return = array(
		"errorCode" => pg_result_error_field($res, PGSQL_DIAG_SQLSTATE)
		);
	echo json_encode($return);
}
function put_utilisateurs($dbconn)
{
	$rest_json = file_get_contents("php://input"); // DEBUG $_POST
	$_POST = json_decode($rest_json); // DEBUG $_POST
	if (isset($_GET['login']))
	{
		$login = $_GET['login'];
		$mdp = $_POST->mdp;
		$options = [
		'cost' => 9,
		'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
		];
		$hash = password_hash($mdp, PASSWORD_BCRYPT, $options);
		$mail = $_POST->mail;
		$nom = $_POST->nom;
		$ville = $_POST->ville;
		$departement = $_POST->departement;
		$notation = $_POST->notation;
		$points = $_POST->points;
		$query = "UPDATE Utilisateur SET mail = $2, nom = $3, ville = $4, departement = $5, notation = $6, points = $7 WHERE login ILIKE $1";
		$result = @pg_send_query_params($dbconn, $query, array(
			$login,
			$mail,
			$nom,
			$ville,
			$departement,
			$notation,
			$points
			));
		$res = @pg_get_result($dbconn);
		$return = array(
			"errorCode" => pg_result_error_field($res, PGSQL_DIAG_SQLSTATE)
			);
		echo json_encode($return);
	}
	else
	{
		$return = array(
			"errorCode" => 1
			);
		echo json_encode($return);
	}
}
function delete_utilisateurs($dbconn)
{
	if (isset($_GET['login']))
	{
		$login = $_GET['login'];
		$query = "DELETE FROM Utilisateur WHERE login ILIKE $1";
		$result = pg_send_query_params($dbconn, $query, array(
			$login
			));
		$res = pg_get_result($dbconn);
		$return = array(
			"errorCode" => pg_result_error_field($res, PGSQL_DIAG_SQLSTATE)
			);
	}
	else
	{
		$return = array(
			"errorCode" => 1
			);
		echo json_encode($return);
	}
}
?>