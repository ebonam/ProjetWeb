<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Offres</title>

    <!-- Bootstrap core CSS -->
    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="./assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="justified-nav.css" rel="stylesheet">
    <link href="consulterOffre.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="./assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
            <div class="masthead">
                <h3 class="text-muted">Troc Services</h3>
                <nav>
                    <ul class="nav nav-justified">
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="formuler_offre.php">Formuler une offre</a></li>
                        <li class="active"><a href="consulterOffre.php">Consulter les offres</a></li>
                        <li><a href="inscription.php">Inscription</a></li>
                        <li><a href="messagerie_bdr.php">Messagerie <span class="badge-read">0</span></a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>

			
	<?php 
	include ('httpful.phar');
					
		$dep= $_POST['dep'];
		$type= $_POST['type'];
		$prixmax= $_POST['prixmax'];
		if(!$_POST['domaine']){
			echo "Aucun domaine n'a été choisi";
			exit;
		}
		$arrayDomaine = $_POST['domaine'];
		$i = count($arrayDomaine);
		while ($i<5){
			$arrayDomaine[$i] = '';
			$i = $i+1;
		}
					
			
$uri = "http://127.0.0.1/API/V1/offres.php?departement=$dep&type=$type&prixmax=$prixmax&domaines=$arrayDomaine[0],$arrayDomaine[1],$arrayDomaine[2],$arrayDomaine[3],$arrayDomaine[4]";
                                 								
$array = array(
		"type" => "$type",
		"departement" => "$dep",
		"prixmax" => "$prixmax"
);

$json = json_encode($array);

$response = \Httpful\Request::GET($uri)->body($json)->sendsJson()->send();
$rep=json_decode($response);
if(!$rep){
	echo "Pas de résultat..\n";
	exit;
}
$titre = $rep->titre;
$description = $rep->description;
$createur = $rep->createur;
$departement = $rep->departement;
$point = $rep->point;
$id = $rep->id;

$compt = count($titre);
$i = 0;
		echo"<center><table>";
while ($i<$compt){
	  echo <<<EOF
	  <tr>
      <!-- Example row of columns -->
      <div class="row ">
        <div class="col-lg-4 ">
		
          <h2>$titre[$i]</h2>
          <p>departement : $departement[$i] </p>
		  <p>point : $point[$i] </p>
          <p><a class="btn btn-primary " href="detail_offre.php?id=$id[$i]" " role="button ">Détails &raquo;</a></p>
        </div>
		</tr>
EOF;
       
	   $i= $i+1;}
	 
	   echo"</table></center>";
	   
	   
	  
?>	   
     
	  
      <!-- Site footer -->
      <footer class="footer">
        <p>&copy;</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
