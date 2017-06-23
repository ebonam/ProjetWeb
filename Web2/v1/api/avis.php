<?php
include ("sql.php");
// TODO: Mieux gérer les erreurs de saisie.
$dbconn = getConnection();
switch ($_SERVER['REQUEST_METHOD'])
{
	case "GET" :
		get_avis($dbconn);
		break;
	case "POST" :
		post_avis($dbconn);
		break;
	case "PUT" :
		// put_avis($dbconn);
		break;
	case "DELETE" :
		// delete_avis($dbconn);
		break;
}
function get_avis($dbconn)
{
	if (isset($_GET['IDAvis']))
	{
		$IDAvis = $_GET['IDAvis'];
		$query = "SELECT * FROM Avis WHERE IDAvis = $1";
		
		$result = pg_query_params($dbconn, $query, array(
				$IDAvis
		));
		$arrayResult = pg_fetch_array($result, null, PGSQL_ASSOC);
		$array = array(
				"IDAvis" => $arrayResult['IDAvis'],
				"Cible" => $arrayResult['Cible'],
				"Votant" => $arrayResult['Votant'],
				"Description" => $arrayResult['Description'],
				"date" => $arrayResult['date'],
				"note" => $arrayResult['note']
		);
		echo json_encode($array);
	}
	else
	{
		$query = "SELECT * FROM Avis";
		
		$arrayToReturn = array();
		
		$result = pg_query($dbconn, $query);
		
		while ($arrayResult = pg_fetch_array($result))
		{
			$array = array(
					"IDAvis" => $arrayResult['idavis'],
					"Cible" => $arrayResult['cible'],
					"Votant" => $arrayResult['votant'],
					"Description" => $arrayResult['description'],
					"date" => $arrayResult['date'],
					"note" => $arrayResult['note']
			);
			array_push($arrayToReturn, $array);
		}
		
		echo json_encode($arrayToReturn);
	}
}
function post_avis($dbconn)
{
	$rest_json = file_get_contents("php://input"); // DEBUG $_POST
	$_POST = json_decode($rest_json); // DEBUG $_POST
	$Cible = $_POST->Cible;
	$Votant = $_POST->Votant;
	$Description = $_POST->Description;
	$date = date("Y-m-d H:i:s", time());
	$note = $_POST->note;
	$query = "INSERT INTO Avis (Cible, Votant, Description, date, note) VALUES ($1, $2, $3, $4, $5);";
	$result = @pg_send_query_params($dbconn, $query, array(
			$Cible,
			$Votant,
			$Description,
			$date,
			$note
	));
	$res = @pg_get_result($dbconn);
	$return = array(
			"errorCode" => pg_result_error_field($res, PGSQL_DIAG_SQLSTATE)
	);
	echo json_encode($return);
}
/*
* function put_utilisateurs($dbconn)
* {
* $rest_json = file_get_contents("php://input"); // DEBUG $_POST
* $_POST = json_decode($rest_json); // DEBUG $_POST
* if (isset($_GET['login']))
* {
* $login = $_GET['login'];
* $mdp = $_POST->mdp;
* $options = [
* 'cost' => 9,
* 'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM)
* ];
* $hash = password_hash($mdp, PASSWORD_BCRYPT, $options);
* $mail = $_POST->mail;
* $nom = $_POST->nom;
* $ville = $_POST->ville;
* $departement = $_POST->departement;
* $notation = $_POST->notation;
* $points = $_POST->points;
* $query = "UPDATE Utilisateur SET mdp = $2, mail = $3, nom = $4, ville = $5, departement = $6, notation = $7, points = $8 WHERE login ILIKE $1";
* $result = @pg_send_query_params($dbconn, $query, array(
* $login,
* $hash,
* $mail,
* $nom,
* $ville,
* $departement,
* $notation,
* $points
* ));
* $res = @pg_get_result($dbconn);
* $return = array(
* "errorCode" => pg_result_error_field($res, PGSQL_DIAG_SQLSTATE)
* );
* echo json_encode($return);
* }
* else
* {
* $return = array(
* "errorCode" => 1
* );
* echo json_encode($return);
* }
* }
* function delete_utilisateurs($dbconn)
* {
* if (isset($_GET['login']))
* {
* $login = $_GET['login'];
* $query = "DELETE FROM Utilisateur WHERE login ILIKE $1";
* $result = pg_send_query_params($dbconn, $query, array(
* $login
* ));
* $res = pg_get_result($dbconn);
* $return = array(
* "errorCode" => pg_result_error_field($res, PGSQL_DIAG_SQLSTATE)
* );
* }
* else
* {
* $return = array(
* "errorCode" => 1
* );
* echo json_encode($return);
* }
* }
*/
?>