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

<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/sha1.js"></script>

<title>Troc Services - Inscription</title>

<!-- Bootstrap core CSS -->
<link href="./dist/css/bootstrap.min.css" rel="stylesheet">
<link href="inscription.css" rel="stylesheet">


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
if (isset($_SESSION['hash']))
{
	header('Location: index.php');
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
                        <li class="active dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon compte<span class="caret"></span></a>
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
					postData.mdp = CryptoJS.SHA1(postData.mdp).toString();
					$.ajax(
					{
						type : "POST",
						url : "v1/api/utilisateurs.php",
						data : JSON.stringify(postData),
						success : function(data)
						{
							var jsonResult = JSON.parse(data);
							if (jsonResult.errorCode == 23505)
							{
								$("#red-box").text("Ce nom d'utilisateur est déjà utilisé!");
								$("#red-box").fadeIn();
							} else
							{
								$("#green-box").text("Inscription effectuée avec succès!");
								$("#green-box").fadeIn();
							}
						}
					});
					return false;
				});
			});
		</script>

		<form id="form-signin" class="form-signin">
			<div id="red-box" class="alert alert-danger" role="alert" hidden></div>
			<div id="green-box" class="alert alert-success" role="alert" hidden></div>
			<h2 class="form-signin-heading">Inscription</h2>
			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2">Pseudonyme&nbsp;</span> <input name="login" type="text" class="form-control" placeholder="Pseudonyme" aria-describedby="sizing-addon2" required autofocus>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2">Nom&nbsp;</span> <input name="nom" type="text" class="form-control" placeholder="Nom" aria-describedby="sizing-addon2" required autofocus>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2">Mot de passe</span> <input name="mdp" type="password" class="form-control" placeholder="Mot de passe" aria-describedby="sizing-addon2" required autofocus>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2">Confirmation</span> <input type="password" class="form-control" placeholder="Confirmation" aria-describedby="sizing-addon2" required autofocus>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2">Adresse mail&nbsp;</span> <input name="mail" type="email" class="form-control" placeholder="Adresse mail" aria-describedby="sizing-addon2" required autofocus>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2">Ville&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <input name="ville" type="text" class="form-control" placeholder="Ville" aria-describedby="sizing-addon2" required autofocus>
			</div>
			<div class="input-group">
				<span class="input-group-addon" id="sizing-addon2">Département&nbsp;</span> <select class="form-control" name="departement">
					<option value="01">Ain</option>
					<option value="02">Aisne</option>
					<option value="03">Allier</option>
					<option value="04">Alpes-de-Haute-Provence</option>
					<option value="05">Hautes-Alpes</option>
					<option value="06">Alpes-Maritimes</option>
					<option value="07">Ardèche</option>
					<option value="08">Ardennes</option>
					<option value="09">Ariège</option>
					<option value="10">Aube</option>
					<option value="11">Aude</option>
					<option value="12">Aveyron</option>
					<option value="13">Bouches-du-Rhône</option>
					<option value="14">Calvados</option>
					<option value="15">Cantal</option>
					<option value="16">Charente</option>
					<option value="17">Charente-Maritime</option>
					<option value="18">Cher</option>
					<option value="19">Corrèze</option>
					<option value="20">Corse</option>
					<option value="21">Côte-d'Or</option>
					<option value="22">Côtes-d'Armor</option>
					<option value="23">Creuse</option>
					<option value="24">Dordogne</option>
					<option value="25">Doubs</option>
					<option value="26">Drôme</option>
					<option value="27">Eure</option>
					<option value="28">Eure-et-Loire</option>
					<option value="29">Finistère</option>
					<option value="30">Gard</option>
					<option value="31">Haute-Garonne</option>
					<option value="32">Gers</option>
					<option value="33">Gironde</option>
					<option value="34">Hérault</option>
					<option value="35">Ille-et-Vilaine</option>
					<option value="36">Indre</option>
					<option value="37">Idre-et-Loire</option>
					<option value="38">Isère</option>
					<option value="39">Jura</option>
					<option value="40">Landes</option>
					<option value="41">Loir-et-Cher</option>
					<option value="42">Loire</option>
					<option value="43">Haute-Loire</option>
					<option value="44">Loire-Atlantique</option>
					<option value="45">Loiret</option>
					<option value="46">Lot</option>
					<option value="47">Lot-et-Garonne</option>
					<option value="48">Lozère</option>
					<option value="49">Maine-et-Loire</option>
					<option value="50">Manche</option>
					<option value="51">Marne</option>
					<option value="52">Haute-Marne</option>
					<option value="53">Mayenne</option>
					<option value="54">Meurthe-et-Moselle</option>
					<option value="55">Meuse</option>
					<option value="56">Morbihan</option>
					<option value="57">Moselle</option>
					<option value="58">Nièvre</option>
					<option value="59">Nord</option>
					<option value="60">Oise</option>
					<option value="61">Orne</option>
					<option value="62">Pas-de-Calais</option>
					<option value="63">Puy-de-Dôme</option>
					<option value="64">Pyrénéees-Atlantique</option>
					<option value="65">Hautes-Pyrénées</option>
					<option value="66">Pyrénéees-Orientales</option>
					<option value="67">Bas-Rhin</option>
					<option value="68">Haute-Rhin</option>
					<option value="69">Rhône</option>
					<option value="70">Haute-Saône</option>
					<option value="71">Saône-et-Loire</option>
					<option value="72">Sarthe</option>
					<option value="73">Savoie</option>
					<option value="74">Haute-Savoie</option>
					<option value="75">Paris</option>
					<option value="76">Seine-Maritime</option>
					<option value="77">Seine-et-Marne</option>
					<option value="78">Yvelines</option>
					<option value="79">Deux-Sèvres</option>
					<option value="80">Somme</option>
					<option value="81">Tarn</option>
					<option value="82">Tarn-et-Garonne</option>
					<option value="83">Var</option>
					<option value="84">Vancluse</option>
					<option value="85">Vendée</option>
					<option value="86">Vienne</option>
					<option value="87">Haute-Vienne</option>
					<option value="88">Vosges</option>
					<option value="89">Yonne</option>
					<option value="90">Territoire de Belfort</option>
					<option value="91">Essonne</option>
					<option value="92">Haute-de-Seine</option>
					<option value="93">Seine-Saint-Denis</option>
					<option value="94">Val-de-Marne</option>
					<option value="95">Val-d'Oise</option>
				</select>
			</div>
			<button class="btn btn-lg btn-primary btn-block" type="submit">S'inscrire</button>
		</form>

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