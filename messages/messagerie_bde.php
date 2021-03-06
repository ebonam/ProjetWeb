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

    <body>

        <div class="container">

            <!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
            <div class="masthead">
                <h3 class="text-muted">Troc Services</h3>
                <nav>
                    <ul class="nav nav-justified">
                        <li><a href="index.html">Accueil</a></li>
                        <li><a href="formuler_offre.html">Formuler une offre</a></li>
                        <li><a href="consulterOffre.html">Consulter les offres</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mon compte<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="login.html">Connexion</a></li>
                                <li><a href="inscription.html">Inscription</a></li>
                            </ul>
                        </li>
                        <li class="active"><a href="messagerie_bdr.html">Messagerie <span class="badge-read">0</span></a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>

            <h2 class="form-signin-heading">Boite d'envoi</h2>

            <div class="panel panel-default">
                <!-- Default panel contents -->
                <ul class="nav nav-tabs">
                    <li role="presentation"><a href="messagerie_bdr.php">Boite de réception</a></li>
                    <li role="presentation" class="active"><a href="messagerie_bde.php">Boite d'envoi</a></li>
                    <li role="presentation"><a href="messagerie_send.php">Nouveau message</a></li>
                </ul>

                <!-- Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Contenu</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>BONAMY</td>
                            <td>Donec id elit non mi porta gravida at eget metus elit non mi porta gravida at eget...</td>
                            <td>01/01/2015 à 00:00</td>
                        </tr>
                        <tr>
                            <td>LETERTRE</td>
                            <td>Donec id elit non mi porta gravida at eget metus elit non mi porta gravida at eget...</td>
                            <td>01/01/2015 à 00:00</td>
                        </tr>
                        <tr>
                            <td>LADENT</td>
                            <td>Donec id elit non mi porta gravida at eget metus elit non mi porta gravida at eget...</td>
                            <td>01/01/2015 à 00:00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <nav class="text-center">
                <ul class="pagination">
                    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li>
                        <a href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>


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