<!DOCTYPE html>
<html lang="en">

<head>
<meta name="generator" content="HTML Tidy for HTML5 (experimental) for Windows https://github.com/w3c/tidy-html5/tree/c63cc39" />
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="" />
<meta name="author" content="" />
<link rel="icon" href="../../favicon.ico" />
<title>Troc Services - Messagerie</title>
<!-- Bootstrap core CSS -->
<link href="./dist/css/bootstrap.min.css" rel="stylesheet" />
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="./assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet" />
<!-- Custom styles for this template -->
<link href="justified-nav.css" rel="stylesheet" />
<!-- Custom CSS -->
<link href="./css/bootstrap-custom.css" rel="stylesheet" />
<!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
<!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
<script src="./assets/js/ie-emulation-modes-warning.js"></script>
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<script src="js/jquery-1.11.3.min.js"></script>

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
                        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $_SESSION["login"] . '<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="profil.php?login=' . $_SESSION['login'] . '"">Profil</a></li>
                            <li><a href="logout.php">Déconnexion</a></li>
                        </ul></li>
                        <li class="active"><a href="messagerie_bdr.php">Messagerie <span class="badge-read">' . $count . '</span></a></li>
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
		<h2 class="form-signin-heading">Nouveau message</h2>
		<div class="panel panel-default">
			<!-- Default panel contents -->
			<ul class="nav nav-tabs">
				<li role="presentation"><a href="messagerie_bdr.php">Boite de réception</a></li>
				<li role="presentation"><a href="messagerie_bde.php">Boite d'envoi</a></li>
				<li role="presentation" class="active"><a href="messagerie_send.php">Nouveau message</a></li>
			</ul>

			<script>
					function getFormData($form)
					{
						var unindexed_array = $form.serializeArray();
						var indexed_array =
						{};

						$.map(unindexed_array, function(n, i)
						{
							indexed_array[n['name']] = n['value'];
						});

						return indexed_array;
					}

					$(document).ready(function()
					{
						$("#form-signin").submit(function()
						{
							$("#red-box").fadeOut();
							$("#green-box").fadeOut();
							var postData = getFormData($("#form-signin"));
							$.ajax(
							{
								type : "POST",
								url : "v1/api/messages.php",
								data : JSON.stringify(postData),
								success : function(data)
								{

									var jsonResult = JSON.parse(data);
									if (jsonResult.errorCode == 23503)
									{
										$("#red-box").text("L'utilisateur n'existe pas...");
										$("#red-box").fadeIn();
									} 
									else
									{
										$("#green-box").text("Message envoyé avec succès!");
										$("#green-box").fadeIn();
									}
								}
							});
							return false;
						});
					});
				</script>

			<form id="form-signin" method="post" class="form-signin">
				<div id="red-box" class="alert alert-danger form-signin" role="alert" hidden></div>
				<div id="green-box" class="alert alert-success" role="alert" hidden></div>
				<div style="margin: 5px;" class="input-group">
					<span class="input-group-addon" id="basic-addon1">Nom d&#39;utilisateur</span> 
					<?php
						if(isset($_GET['contact']))
						{
							echo '<input type="text" name="username" class="form-control" placeholder="' . $_GET["contact"] . '" value="' . $_GET["contact"] . '" aria-describedby="basic-addon1" readonly/>';
						}
						else
						{
							echo '<input list="usernamelist" type="text" name="username" class="form-control" placeholder="Nom d&#39;utilisateur" aria-describedby="basic-addon1" />';
							echo '<datalist id="usernamelist">';
							$uri = "http://127.0.0.1/BenjaminWeb/v1/api/utilisateurs/";
							
							$responce = \Httpful\Request::get($uri)->send();
							
							$response1 = json_decode($responce);
							
							foreach ($response1 as $client)
							{
								echo '<option value="' . $client->login . '">';
							}
							echo '</datalist>';
						}
					?>
					
				</div>
				<div style="margin: 5px;" class="input-group">
					<span class="input-group-addon" id="basic-addon1">Message&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;</span>
					<textarea class="form-control" name="msgContent" rows="5" id="comment" placeholder="Contenu du message"></textarea>

				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-default navbar-btn">Envoyer</button>
				</div>
			</form>
		</div>
		<!-- Site footer -->
		<footer class="footer">
			<p>© 2015 Company, Inc.</p>
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