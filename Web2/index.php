<!DOCTYPE html>
<html lang="fr">
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
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/jquery.serialize-object.min.js"></script>
	</head>
	<?php
	session_start();
	include ('httpful.phar');
	?>

	<script>
	//Haut, haut, bas, bas, gauche, droite, gauche, droite, B, A
	var k = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65],
	n = 0;
	$(document).keydown(function (e) {
	    if (e.keyCode === k[n++]) {
	        if (n === k.length) {
	            alert('Konami !!!'); // à remplacer par votre code
	            n = 0;
	            return false;
	        }
	    }
	    else {
	        n = 0;
	    }
	});
	</script>

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
                        <li class="active"><a href="index.php">Accueil</a></li>
                        <li><a href="formuler_offre.php">Formuler une offre</a></li>
                        <li><a href="consulterOffre.php">Consulter les offres</a></li>
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
                        <li class="active"><a href="index.php">Accueil</a></li>
                        <li><a href="formuler_offre.php">Formuler une offre</a></li>
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
			<!-- Jumbotron -->
			<div class="jumbotron">
				<h1>Troc Services !</h1>
				<p class="lead">
					Vous souhaitez proposer des services ? Proposez à la communauté de <strong>Troc services</strong> ! Gagnez des points que vous pourrez dépensez pour demander un service à une autre personne.
				</p>
				<p>
					<a class="btn btn-lg btn-success" href="inscription.php" role="button ">S'inscrire !</a>
				</p>
			</div>
			<!-- Example row of columns -->
			<div class="row ">
				<?php
				$uri = "http://127.0.0.1/BenjaminWeb/v1/api/accueil/";
				$responce = \Httpful\Request::get($uri)->send();
				$response = json_decode($responce);
				for($i = count($response) - 1 ; $i >= count($response) - 3 ; $i--)
				{
				echo '
				<div class="col-lg-4 ">
					<h2>' . $response[$i]->titre . '</h2>
					<p style="overflow: auto;">' . $response[$i]->description . '</p>
					<p>
                    <form action="annonce.php?">
                        <input name="id" value="'. $response[$i]->id . '" hidden></input>
                        <button class="btn btn-default" type="submit">Détails &raquo;</button>
                        </form>
					</p>
				</div>
				';
				}
				?>
			</div>
			<!-- Site footer -->
			<footer class="footer ">
				<p>&copy; 2015 Company, Inc.</p>
			</footer>
		</div>
		<!-- /container -->
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="./assets/js/ie10-viewport-bug-workaround.js "></script>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script>
		window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
		</script>

		<script src="js/jquery-1.11.3.min.js"></script>
		<script src="js/jquery.serialize-object.min.js"></script>
		<script src="./dist/js/bootstrap.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="./assets/js/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>