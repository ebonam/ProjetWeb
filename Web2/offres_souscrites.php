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

<title>Troc Services - Messagerie</title>

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


<?php
if (! isset($_SESSION['hash']))
{
	header('Location: login.php');
}
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
                        <li><a href="consulterOffre.php">Consulter les offres</a></li>
                        <li class="active dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $_SESSION["login"] . '<span class="caret"></span></a>
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

		<h2 class="form-signin-heading">Offres souscrites</h2>

		<div class="panel panel-default">
			

			<!-- Table -->
			<table class="table">
				<thead>
					<tr>
						<th>Nom</th>
						<th>Payer</th>
						<th>Prix</th>
						<th>Offre</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$uri = "http://127.0.0.1/BenjaminWeb/v1/api/offres/idUser/" . $_SESSION['login'];
				
				$response = \Httpful\Request::get($uri)->send();
	
				$rep=json_decode($response);
				
				if(!$rep){
					echo "Pas de résultat..\n";
					exit;
				}
				
				
				if (count($rep))
				{
					foreach ($rep as $message)
					{
		   				$uri2 = "http://127.0.0.1/BenjaminWeb/v1/api/souscriptions/" . $message->id;
		                $responce2 = \Httpful\Request::get($uri2)->send();
		                $response2 = json_decode($responce2);

						echo '<tr>';
						echo '<td><a href="profil.php?login=' . $message->createur . '">' . $message->createur . '</a></td>';
						if($response2->valide == "f")
						{
						echo '<td> <a href="avis.php?contact=' . $message->createur . '&idForm=' . $message->id . '"><button type="submit">Payer</button></a> </td>';
						}
						else
						{
							echo '<td></td>';
						}
						echo '<td>' . $message->point . '</td>';
						echo '<td><a href="annonce.php?id=' . $message->id . '">' . $message->Titre . '</a></td>';
						echo '</tr>';
					}
				}
				
				?>
				</tbody>
			</table>
		</div>



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