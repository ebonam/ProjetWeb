<?php
include ("sql.php");

// TODO: Mieux gérer les erreurs de saisie.

$dbconn = getConnection();


switch ($_SERVER['REQUEST_METHOD'])
{
	case "GET" :
		get_domaines($dbconn);
		break;
	case "POST" :
		break;
	case "PUT" :
		break;
	case "DELETE" :
		break;
}
// Récupère les domaines en json
function get_domaines($dbconn)
{
	
		$query = "SELECT * FROM domaine;";
		
		$verif = pg_query($dbconn, $query);
		$rs = pg_fetch_assoc($verif); 
		if (!$rs) {
		  echo "Pas de résultat.\n";
		  exit;
		}
		
		$result = pg_query($dbconn, $query);
		if (!$result) {
		  echo "Une erreur s'est produite.\n";
		  exit;
		}
		
		while ($row = pg_fetch_row($result)) {
		$tabResult['nom'][] = $row[0];
		}
		
		$arrayResult = array(
				"nom" => $tabResult['nom'] 
			);
		echo json_encode($arrayResult);
	
}
?>