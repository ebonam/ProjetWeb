<?php
class RequetesBDD 
{
	
	public  $dbconn;



public function connection(){
	$conn_string = "host=localhost port=5432 dbname='projetPHP' user=postgres password=postgres";
	$this->dbconn = pg_connect($conn_string);
	

	return $this->dbconn;
}

public function deconnection(){
	pg_close($dbconn);
}

public function ajoutUtilisateur($login, $mdp,$mail,$nom,  $ville, $dep){
	$verifLog = pg_query( $this->dbconn, "SELECT * FROM Utilisateur WHERE login = '$login' ");
	$verifMail = pg_query( $this->dbconn, "SELECT * FROM Utilisateur WHERE mail = '$mail' ");
	if (!$verifLog) {
	  echo "Une erreur s'est produite.\n";
	  exit;
	}
	if (!$verifMail) {
	  echo "Une erreur s'est produite.\n";
	  exit;
	}
	  $rs = pg_fetch_assoc($verifLog);
	  if (!$rs) {
		$rs = pg_fetch_assoc($verifMail);
		if (!$rs) {
			$result = pg_query( $this->dbconn, "INSERT INTO Utilisateur values ('$login', '$mdp', '$mail', '$nom',  '$ville', '$dep',3,50);");
			
			if (!$result) {
			  echo "Une erreur s'est produite.\n";
			  exit;
			}
	    }
		else {
		 echo "Login déjà utilisé";
		exit;
		}
	}
	 else {
		 echo "Mail déjà utilisé";
		exit;
		}
}
	
	


public function getUtilisateurs($arg){
		//$result = pg_query( $this->dbconn, "SELECT login, mail FROM utilisateur;");
		$result = pg_query( $this->dbconn, "SELECT login, mail FROM utilisateur WHERE login = '$arg';");
	if (!$result) {
	  echo "Une erreur s'est produite.\n";
	  exit;
	}
	$tabResult;
	while ($row = pg_fetch_row($result)) {
		$tabResult['login'][] = $row[0];
		$tabResult['mail'][] = $row[1];
	}
	return $tabResult;
	
}


}

?>