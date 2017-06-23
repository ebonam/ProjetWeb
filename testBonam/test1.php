<?php
 

header('Content-Type: text/json; charset=UTF-8');
// obligatoire askip
function index()// function appele apres la lign plus bas

{
$i=0;// pourquoi tu es la toi?

	  $bdd = pg_connect("host=localhost port=5432 dbname=Projet user=postgres password=bonam");
	  
		$result = pg_query($bdd, "SELECT * FROM formulaire where type = true ");
// de la bdd
	if (!$result) {
			echo "Une erreur s'est produite.\n";
//			return 'brawwwwwwwwwwww';
$i++;
			}
			while ( $row = pg_fetch_assoc($result)) {

$Array_Swag[]=$row; //concatene les ligne de resultat
  }
return $Array_Swag;// retourn l'array des fesses
} 



$value=$_GET; // ligne inutile




   $value1 = @call_user_func($value['function']/*, $value['arg']*/); // appel la fonction nommer dans url apres le function=

   echo json_encode($value1); //ligne qui renvoi a la page source neccesairement un print_r car array



?>

