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

<!-- Custom styles for this template -->
<link href="annonces.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="./css/bootstrap-custom.css" rel="stylesheet">

<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="./assets/js/ie-emulation-modes-warning.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<?php
session_start();
include ('httpful.phar');
?>

<body>

	<div class="container">

		<!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
		<div class="masthead">
			<h3 class="text-muted">Troc Services</h3>
			 <?php
                if (isset($_SESSION['hash']))
                {
                $uri = "http://127.0.0.1/BenjaminWeb/v1/api/messages/v/" . $_SESSION['login'];
                $responce = \Httpful\Request::get($uri)->send();
                $response1 = json_decode($responce);
                $count = count($response1);
                echo '<nav>
                    <ul class="nav nav-justified">
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="formuler_offre.php">Formuler une offre</a></li>
                        <li class="active"><a href="consulterOffre.php">Consulter les offres</a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $_SESSION["login"] . '<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profil.php?login=' . $_SESSION['login'] . '"">Profil</a></li>
                            <li><a href="logout.php">Déconnexion</a></li>
                        </ul></li>
                        <li><a href="messagerie_bdr.php">Messagerie <span class="badge-read">' . $count . '</span></a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </nav>';
                }
                else
                {
                echo '<nav>
                    <ul class="nav nav-justified">
                        <li><a href="index.php">Accueil</a></li>
                        <li class="active"><a href="formuler_offre.php">Formuler une offre</a></li>
                        <li><a href="consulterOffre.php">Consulter les offres</a></li>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon compte<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="login.php">Connexion</a></li>
                            <li><a href="inscription.php">Inscription</a></li>
                        </ul></li>
                        <li><a href="messagerie_bdr.php">Messagerie <span class="badge-read">0</span></a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </nav>';
                }
                ?>
		</div>

		<div class="container">

			<h2 class="form-signin-heading">Annonces</h2>

            <?php

                if(isset($_GET['json']))
                {
                    $array = json_decode($_GET['json']);
                    $printrow = 0;  
                    for($i = 0 ; $i < count($array) ; $i++)
                    {
                        if($i % 2 == 0)
                        {
                            echo '<div class="row">';
                                $printrow = $i;
                        }
                        echo '
                        <div class="col-sm-6 col-md-6">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">' . $array[$i]->Titre . '</h3>
                                </div>
                                <div class="panel-body">
                                    <div style="overflow: auto;" class="col-sm-6 col-md-6">Description: ' . $array[$i]->Description . '</div>
                                    <div class="col-sm-6 col-md-6">Par: ' . $array[$i]->createur . '<br>Prix: ' . $array[$i]->point . ' Points</div>
                                    <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                           <form action="annonce.php?">
                                            <input name="id" value="'. $array[$i]->id . '" hidden></input>
                                            <button class="btn btn-default" type="submit">Plus d\'information</button>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        ';
                        if($i == $printrow + 1 || count($array) == 1)
                        {
                         echo '</div>';
                        }
                    }
                }

            ?>
		<!-- Site footer -->
		<footer class="footer">
			<p>&copy; 2015 Company, Inc.</p>
		</footer>

	</div>
	<!-- /container -->


	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="./assets/js/ie10-viewport-bug-workaround.js"></script>


	<!-- Bootstrap core JavaScript
    ================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>
		window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
	</script>
	<script src="./dist/js/bootstrap.min.js"></script>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="./assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>