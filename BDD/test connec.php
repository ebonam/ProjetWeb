<?php
$conn_string = "host=localhost port=5432 dbname='Projet Web' user=postgres password=a";
$dbconn = pg_connect($conn_string);
// connexion à une base de données nommée "test" sur l'hôte "mouton" avec un
// nom d'utilisateur et un mot de passe
phpinfo();
=======


$login = "bonam";
if (!$dbconn) {
  echo "Une erreur s'est produite.\n";
  exit;
}
else{
	echo "GG<br />";
}

echo "<br />";
$result = pg_query($dbconn, "SELECT nom, mail FROM utilisateur WHERE login='$login';");
if (!$result) {
  echo "Une erreur s'est produite.\n";
  exit;
}

while ($row = pg_fetch_row($result)) {
  echo "Utilisateur : $row[0]  Mail: $row[1]";
  echo "<br />\n";
}

echo "<br />\n";

//rechercher selon plusieurs domaine en fonction d'un département

//$domaine1 = 'Animalerie';
//$domaine2 = 'Cours';
//$result = pg_query($dbconn, "SELECT * FROM Domaine WHERE nom = '$domaine1' OR nom = '$domaine2' OR nom = '' OR nom = ''");

$vardep = '59';
$domaines =  array('Animalerie', 'Cours', '', '', '', '');
$int = 0;

while ($row = $domaines[$int]) {
	echo "Domaine : $row<br />\n";
		$result2 = pg_query($dbconn, "SELECT f.ID , f.Titre , f.Description , f.date
									FROM Formulaire f
									JOIN ListeFormulaireDomaine lfd ON lfd.IDListe = f.ID
									WHERE lfd.NomDomaine = '$row' AND f.Departement = '$vardep' AND f.Type = false");
								while ($row2 = pg_fetch_row($result2)) {
									echo "Id : $row2[0]  Titre: $row2[1] Description: $row2[2] Date: $row2[3]";
									echo "<br />\n";

									}
									$int = $int +1;
	}

=======
 $result = pg_query($dbconn, "SELECT f.ID , f.Titre , f.Description , f.date 
FROM Formulaire f 
JOIN ListeFormulaireDomaine lfd ON lfd.IDListe = f.ID
WHERE createur = '$login'");
if (!$result) {
  echo "Une erreur s'est produite.\n";
  exit;
}

while ($row = pg_fetch_row($result)) {
  echo "Id : $row[0] Titre: $row[1] Description: $row[2] Date: $row[3]";
  echo "<br />\n";
}
pg_close($dbconn);
?>