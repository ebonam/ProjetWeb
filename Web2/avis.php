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
        <title>Consulter les offres</title>
        <!-- Bootstrap core CSS -->
        <link href="./dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="./assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="justified-nav.css" rel="stylesheet">
        <link href="consulterOffre.css" rel="stylesheet">
        <link href="./css/bootstrap-custom.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="./assets/js/ie-emulation-modes-warning.js"></script>
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/jquery.serialize-object.min.js"></script>
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
                        <li><a href="formuler_offre.php">Formuler une offre</a></li>
                        <li class="active"><a href="consulterOffre.php">Consulter les offres</a></li>
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
            <script>
            $(document).ready(function()
            {
                $("#form-signin").submit(function()
                {
                    // Requête pour vérifier qu'il nous reste assez d'argent
                    $("#green-box").fadeOut();
                    var postData = $("#form-signin").serializeJSON();

                    // Requête pour payer l'intervenant
                    $.ajax(
                    {
                        type: "GET",
                        url: "v1/api/utilisateurs/" + $("#votant")[0].value,
                        success: function(data)
                        {
                            var jsonParsed = JSON.parse(data);
                            // TODO: Récupération des notes et faire moyenne
                            $.ajax(
                            {
                                type: "GET",
                                url: "v1/api/offres/id/" + $("#idOffre")[0].value,
                                success: function(data)
                                {
                                    var prix = JSON.parse(data)[0].point;
                                    if (jsonParsed.points - prix >= 0)
                                    {
                                        // Calculer la nouvelle moyenne

                                        jsonParsed.points = jsonParsed.points - prix;
                                        var postData2 = JSON.stringify(jsonParsed);
                                        $.ajax(
                                        {
                                            type: "GET",
                                            url: "v1/api/utilisateurs/" + $("#Cible")[0].value,
                                            success: function(data)
                                            {
                                                var infoCible = JSON.parse(data);
                                                infoCible.points = parseInt(infoCible.points, 10) + parseInt(prix, 10);
                                                var postData3 = JSON.stringify(infoCible);
                                                $.ajax(
                                                {
                                                    type: "PUT",
                                                    url: "v1/api/utilisateurs/" + $("#Cible")[0].value,
                                                    data: postData3
                                                });
                                            }
                                        });

                                        $.ajax(
                                        {
                                            type: "PUT",
                                            url: "v1/api/utilisateurs/" + jsonParsed.login,
                                            data: postData2,
                                            success: function(data)
                                            {
                                                //console.log(postData2);
                                                //console.log(data);
                                                $.ajax(
                                                {
                                                    type: "PUT",
                                                    url: "v1/api/souscriptions/",
                                                    data: postData,
                                                    success: function(data)
                                                    {
                                                        setTimeout(function(){ window.location.replace("http://localhost/BenjaminWeb/offres_souscrites.php"); }, 1000);
                                                        $("#green-box").fadeIn();
                                                        $("#form-signin").fadeOut();
                                                    }
                                                });
                                            }
                                        });

                                    }
                                    else
                                    {
                                        $("#red-box").fadeIn();
                                        $("#form-signin").fadeOut();
                                        setTimeout(function(){ window.location.replace("http://localhost/BenjaminWeb/offres_souscrites.php"); }, 1000);
                                    }
                                }
                            });
                        }
                    });
                    // Requête pour mettre à jour la note de l'utilisateur
                    //setTimeout(function(){ window.location.replace("http://localhost/BenjaminWeb/offres_souscrites.php"); }, 1000);
                    //console.log(data);
                    return false;
                });
            });

            </script>

            <?php
                if(isset($_GET['contact']))
                {
                    $auteur = $_GET['contact'];
                }
                if(isset($_GET['idForm']))
                {
                    $idForm = $_GET['idForm'];
                }
            ?>

            <div id="green-box" class="alert alert-success" hidden>
                    Vous avez bien payé l'utilisateur! Redirection sur l'historique...
            </div>
            <div id="red-box" class="alert alert-danger" hidden>
                    Vous n'avez pas assez de point... Redirection sur l'historique...
            </div>
            <form id="form-signin" class="form-signin">
                <h2 id="form-signin" class="form-signin-heading">Consulter Offre</h2>
                <?php
                echo '
                    <input id="votant" name="Votant" value="' . $_SESSION['login'] . '" hidden></input>
                    <input id="idOffre" name="idOffre" value="' . $_GET['idForm'] . '" hidden></input>
                    <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">Cible&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <input id="Cible" name="Cible" type="text" value="' . $auteur . '"class="form-control" placeholder="' . $auteur . '" aria-describedby="sizing-addon2" required autofocus readonly>
                </div>
                <br>
                <div id="red-box" class="alert alert-danger" hidden>
                    Vous devez choisir au moins un domaine!
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="sizing-addon2">Note&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <select class="form-control" name="note">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                </div>
                <br>
                <div style="margin: 5px;" class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Message&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;</span>
                    <textarea class="form-control" name="Description" rows="5" id="comment" placeholder="Contenu du message" required autofocus></textarea>
                </div>
                <br>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Payer</button>';
                ?>
            </form>
            <br> <br>
            <!-- Site footer -->
            <footer class="footer">
                <p>&copy; 2015 Company, Inc.</p>
            </footer>
        </div>
        <!-- /container -->
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
        <script src="js/jquery-1.11.3.min.js"></script>
        <script src="js/jquery.serialize-object.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="./assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>