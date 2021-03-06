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
					
		$id= $_GET['id'];
					
			
$uri = "http://127.0.0.1/API/V1/offres.php?id=$id";
                                 								
$array = array(
		"id" => "$id"
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
$type = $rep->type;

if($type[0]) $typeD = "Offre";
else $typeD = "Demande";

$compt = count($titre);
$i = 0;
echo"<center><table>";
	  echo <<<EOF
	  <tr>
      <!-- Example row of columns -->
      <div class="row ">
        <div class="col-lg-4 ">
		
          <h2>$titre[0]</h2>
		  <p>Type : $typeD </p>
		  <p>Crée par : $createur[0] </p>
          <p class="text-danger ">$description[0]</p>
          <p>departement : $departement[0] </p>
		  <p>point : $point[0] </p>
        </div>
		</tr>
EOF;
       
	 
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
