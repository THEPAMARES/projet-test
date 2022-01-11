<?php


include_once("../inc/init.inc.php");
include_once("../inc/functions.inc.php");


//Si l'utilisateur n'est pas admin alors on le redirige vers la page d'accueil
if (!is_admin()){
    header("location:" . URL);
    exit;
}

include_once("../inc/head.inc.php");
include_once("../inc/header.inc.php");


include_once("../inc/footer.inc.php");

?>