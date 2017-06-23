﻿<!DOCTYPE html>
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
                        <li><a href="consulterOffre.php">Consulter les offres</a></li>
                        <li><a href="inscription.php">Inscription</a></li>
                        <li class="active"><a href="messagerie_bdr.php">Messagerie <span class="badge-read">0</span></a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <h2 class="form-signin-heading">Nouveau message</h2>
            <div class="panel panel-default">
                <!-- Default panel contents -->
                <ul class="nav nav-tabs">
                    <li role="presentation">
                        <a href="messagerie_bdr.php">Boite de réception</a>
                    </li>
                    <li role="presentation">
                        <a href="messagerie_bde.php">Boite d&#39;envoi</a>
                    </li>
                    <li role="presentation" class="active">
                        <a href="messagerie_send.php">Nouveau message</a>
                    </li>
                </ul>
				
				
				<form method="post" class="form-signin" action="messages.php">
					<div style="margin: 5px;" class="input-group">
						<span class="input-group-addon" id="basic-addon1">Nom d&#39;utilisateur</span>
						<input type="text" name="username" class="form-control" placeholder="Nom d&#39;utilisateur" aria-describedby="basic-addon1" />
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
    </body>

</html>