<?php
include ("sql.php");
session_start();
// TODO: Mieux gérer les erreurs de saisie.
$dbconn = getConnection();
switch ($_SERVER['REQUEST_METHOD'])
{
	case "GET" :
	get_offres($dbconn);
	break;
	case "POST" :
	post_offres($dbconn);
	break;
	case "PUT" :
	break;
	case "DELETE" :
	break;
}
// Récupère les offres selon les paramètres de l'uri
function get_offres($dbconn)
{
	
	
	if (isset($_GET['id'])){
		$query = "SELECT f.Titre , f.Description , f.createur , f.departement, f.point , f.id , f.date , f.type FROM Formulaire f
		JOIN ListeFormulaireDomaine lfd ON lfd.IDListe = f.ID
		WHERE id = " . $_GET['id'] . ";";
	}
		else if (isset($_GET['idUser'])){
		$query = "SELECT f.Titre , f.Description , f.createur , f.departement, f.point , f.id , f.date , f.type FROM Formulaire f
		JOIN FormulaireSouscrit fs ON fs.IDForm = f.ID
		WHERE fs.Utilisateur = '" . $_GET['idUser'] . "';";
	}
	
	
	
	else
	{
		$json = json_decode($_GET['json']);
		$domainesArray = $json->domaine;
		$i = count($domainesArray);
		while ($i<5)
		{
			$domainesArray[$i] = '';
			$i = $i+1;
		}
		$query = "SELECT f.Titre , f.Description , f.createur , f.departement, f.point , f.id , f.date , f.type FROM Formulaire f
		JOIN ListeFormulaireDomaine lfd ON lfd.IDListe = f.ID
		WHERE f.Departement = " . $json->departement . "
		AND f.Type =  " . $json->type . "
		AND f.point <  " . $json->prixmax . "
		AND ( lfd.NomDomaine =  '" . $domainesArray[0] . "'
			OR lfd.NomDomaine = '" . $domainesArray[1] . "'
			OR lfd.NomDomaine = '" . $domainesArray[2] . "'
			OR lfd.NomDomaine = '" . $domainesArray[3] . "'
			OR lfd.NomDomaine = '" . $domainesArray[4] . "'
			);";
}
// Retaffer sur l'export JSON et les erreurs en JSON.
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
$arrayResult = array();
while ($row = pg_fetch_row($result)) {
	$tabResult['Titre']= html_entity_decode($row[0]);
	$tabResult['Description'] = html_entity_decode($row[1]);
	$tabResult['createur'] = $row[2];
	$tabResult['departement'] = $row[3];
	$tabResult['point'] = $row[4];
	$tabResult['id'] = $row[5];
	$tabResult['date'] = $row[6];
	$tabResult['type'] = $row[7];
	array_push($arrayResult, $tabResult);
}
/*$arrayResult = array(
	"titre" => $tabResult['Titre'] ,
	"description" => $tabResult['Description'],
	"createur" => $tabResult['createur'],
	"departement" => $tabResult['departement'],
	"point" => $tabResult['point'],
	"id" => $tabResult['id'],
	"date" => $tabResult['date'],
	"type" => $tabResult['type']
	);*/
echo json_encode($arrayResult);
}
function post_offres($dbconn)
{
	$rest_json = file_get_contents("php://input"); // DEBUG $_POST
	$_POST = json_decode($rest_json); // DEBUG $_POST
							$login 		= $_SESSION['login'];
							$titre 		= htmlentities($_POST->titre);
				$boolType	= $_POST->boolType;
			$description = htmlentities($_POST->description);
							$dep		= $_POST->dep;
							$prix		= $_POST->prix;
							$date		= $date = date("Y-m-d H:i:s",time());
				$domaine	= $_POST->domaine;
	
	
		
	$query = "INSERT INTO Formulaire (createur, titre, type, description, departement, point, date) VALUES ($1, $2, $3, $4, $5, $6, $7);";
	$result = @pg_send_query_params($dbconn, $query, array(
			$login,
			$titre,
			$boolType,
			$description,
			$dep,
			$prix,
			$date
	));
	
	
	//permet de récupérer le dernier ajouté pour faire la table ListeFormulaireDomaine
	$queryMaxId = "select MAX(id) from Formulaire;";
	$result1 = @pg_query($dbconn,$queryMaxId);
	$row = @pg_fetch_row($result1);
	$maxID = $row[0];
	//echo 'ID recupérée : ' .$maxID ;
	/*print_r($encule);
	print_r($domaine);
	echo count($domaine);
	foreach($domaine as $domaine){
		echo $domaine;
	}
	*/
	
	foreach($domaine as $valeur)
	{
		//echo $valeur;
		$result = @pg_send_query($dbconn, "INSERT Into ListeFormulaireDomaine VALUES ('$maxID','$valeur');");
	}
	$res = @pg_get_result($dbconn);
	
	
	$return = array(
			"errorCode" => pg_result_error_field($res, PGSQL_DIAG_SQLSTATE)
	);
	
	echo json_encode($return);
}
?>