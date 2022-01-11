<?php


include_once("inc/init.inc.php");
include_once("inc/functions.inc.php");

//Si la personne n'est pas connéctée on la redirige vers connection.php
if (!is_connect()){
    header("location:" . URL . "/connexion.php");
    exit;
}

include_once("inc/head.inc.php");
include_once("inc/header.inc.php");
?>
<main class="text-center mt-5">Je suis la page de profil</main>


<?php
include_once("inc/footer.inc.php");

?>