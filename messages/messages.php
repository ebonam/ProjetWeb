<?php
$conn_string = "host=localhost port=5432 dbname=projetPHP user=postgres password=Fjjtdf";
$dbconn = pg_connect($conn_string);
$uriArray = explode("/", $_SERVER['REQUEST_URI']);

switch ($_SERVER['REQUEST_METHOD'])
{
	case "GET" :
	
		break;
	case "POST" :
		post_msg($dbconn, $uriArray);
		break;
	case "PUT" :

		break;
	case "DELETE" :
		break;
}

// prend les infos du message et l'ajoute à la BDD
function post_msg($dbconn, $uriArray)
{
	// Insérer l'envoyeur ici
	$envoyeur = 'matmat';
	$receveur = $_POST['username'];
	$msgContenu = $_POST['msgContent'];
	$dateTime = date('Y-m-d H:i:s');
	$query = "INSERT INTO message(destinataire,receveur,texte,lu,date) VALUES ('".$envoyeur."','".$receveur."','".$msgContenu."',false,'".$dateTime."');";
	$result = pg_query($dbconn, $query);
}
?>