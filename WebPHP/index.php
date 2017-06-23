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

        <title>Troc Services - Accueil</title>
        <!-- Bootstrap core CSS -->
        <link href="./dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="./assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="justified-nav.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="./css/bootstrap-custom.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="./assets/js/ie-emulation-modes-warning.js"></script>
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
                        <li class="active"><a href="index.php">Accueil</a></li>
                        <li><a href="formuler_offre.php">Formuler une offre</a></li>
                        <li><a href="consulterOffre.php">Consulter les offres</a></li>
                        <li><a href="inscription.php">Inscription</a></li>
                        <li><a href="messagerie_bdr.php">Messagerie <span class="badge-read">0</span></a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Jumbotron -->
            <div class="jumbotron">
                <h1>Troc Services !</h1>
                <p class="lead">Vous souhaitez proposer des services ? Proposez à la communauté de <strong>Troc services</strong> ! Gagnez des points que vous pourrez dépensez pour demander un service à une autre personne.</p>
                <p>
                    <a class="btn btn-lg btn-success" href="inscription	.html" " role="button ">S'inscrire !</a></p>
      </div>
      <!-- test connec BDD et affichage -->
	  <?php 
		include 'RequetesBDD.php';
	 
		$app = new RequetesBDD();
		$bdd = $app->connection();
		$result = pg_query($bdd, "SELECT * FROM formulaire where type = true ");
		if (!$result) {
			echo "Une erreur s'est produite.\n";
			exit;
		}
		
		echo"<table>";
		while ($row = pg_fetch_row($result)) {

	

	  
	  echo <<<EOF
	  <tr>
      <!-- Example row of columns -->
      <div class="row ">
        <div class="col-lg-4 ">
		
          <h2>{$row[2]}</h2>
          <p class="text-danger ">{$row[4]}</p>
          <p>departement :{$row[5]} </p>
		  <p>point :{$row[6]} </p>
          <p><a class="btn btn-primary " href="# " role="button ">Détails &raquo;</a></p>
        </div>
		</tr>
EOF;
       }
	   echo"</table>";
	 
	   
	   
	  
?>	   

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>


      <!-- Site footer -->
      <footer class="footer ">
        <p>&copy; 2015 Company, Inc.</p>
      </footer>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="./assets/js/ie10-viewport-bug-workaround.js "></script>


  </body>

</html>