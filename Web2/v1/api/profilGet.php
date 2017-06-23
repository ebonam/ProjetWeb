<?php
include ('httpful.phar');
include('sql.php');
$bdd = getConnection();
$uriArray = explode("/", $_SERVER['REQUEST_URI']);

switch ($_SERVER['REQUEST_METHOD'])
{
        case "GET" :
                get_formulaire($bdd);
                break;

}
// Messages envoyes
function get_formulaire($dbconn)
{
        $login = $_GET['login'];

        $query = "SELECT * FROM formulaire WHERE createur ILIKE $1 ORDER BY id DESC;";
                                       
        $result = pg_query_params($dbconn, $query,array(
                $login
        ));                       
        $arrayResult = pg_fetch_array($result, null, PGSQL_ASSOC);
        $array = array(
                "createur" => $arrayResult['createur'],
                "titre" => $arrayResult['titre'],
                "type" => $arrayResult['type'],
                "departement" => $arrayResult['departement'],
                "point" => $arrayResult['point'],
        );
        echo json_encode($array);
 }
    




?>