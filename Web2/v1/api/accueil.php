<?php
include ('httpful.phar');
include 'sql.php';

$bdd = getConnection();

switch ($_SERVER['REQUEST_METHOD'])
{
        case "GET" :
        $row=get_accueil($bdd);
        echo json_encode($row);        
        break;

}
// Messages envoyes
function get_accueil($dbconn)
{
        $arrayResult=null;
        $query = "SELECT * FROM formulaire;";

        $result = pg_query($dbconn, $query);
        while ( $row = pg_fetch_assoc($result)) {
                $arrayResult[]=$row;
        }
        return  $arrayResult;
}

?>