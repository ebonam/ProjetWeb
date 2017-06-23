<?php
$conn_string = "host=localhost port=5432 dbname=Projet user=postgres password=bonam";
$dbconn = pg_connect($conn_string);
$uriArray = explode("/", $_SERVER['REQUEST_URI']);

switch ($_SERVER['REQUEST_METHOD'])
{
	case "GET" :
		$row=get_Message($dbconn, $uriArray);
echo json_encode($row);		
		break;
	case "POST" :
		$row=post_Message($dbconn, $uriArray);
		break;
	case "PUT" :
		$row=put_Message($dbconn, $uriArray);
		break;
		
	case "DELETE" :
		$row =delete_client($dbconn, $uriArray);
		break;
}

// Messages envoyes 
function get_Message($dbconn, $uriArray)
{
		$arrayResult=null;
		$id = $uriArray[4];
		$idDest=$uriArray[3];
//		$text=$uriArray[5];
	
		if($idDest=='f'){
		$query = "SELECT ID , Destinataire , texte , lu , date
					FROM Message
					WHERE Destinataire = '".$id."';";}
		else {
		$query = "SELECT ID , receveur , texte , lu , date
					FROM Message
					WHERE receveur = '".$id."';";
					}
					
					
					
		$result = pg_query($dbconn, $query);
		while ( $row = pg_fetch_assoc($result)) {
//	$i+=1;
	$arrayResult[]=$row;
	
	
	}
	return 	$arrayResult;
	}

// Envoi d'un message
function post_Message($dbconn, $uriArray)
{
		$id = $uriArray[3];
		$idDest=$uriArray[4];
//		$text=$uriArray[5];
		
		
		
		
		if($idDest=='f'){
		$query = "SELECT ID , Destinataire , texte , lu , date
					FROM Message
					WHERE Destinataire = '".$id."';";}
		else {
		$query = "SELECT ID , receveur , texte , lu , date
					FROM Message
					WHERE receveur = '".$id."';";
					}
					
					
					
		$result = pg_query($dbconn, $query);
		while ( $row = pg_fetch_assoc($result)) {
	$i+=1;
	$arrayResult[]=$row;
	
	
	}
	}

// List des messages recu 
function put_message($dbconn, $uriArray)
{

	
		$id = $uriArray[3];
//		$password = $uriArray[];
		$query = "SELECT ID ,  Receveur , texte , lu , date
					FROM Message
					WHERE Destinataire = 'bonam';";
		$result = pg_query($dbconn, $query);
		while ( $row = pg_fetch_assoc($result)) {

		$Array_Swag[]=$row; //concatene les ligne de resultat
	}
		
		return json_encode($Array_Swag);
	
	
}

?>