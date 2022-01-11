<?php


include_once("inc/init.inc.php");
include_once("inc/functions.inc.php");


//Si get action existe et qu'il est égale a deconnexion alors on détruit la session
if(isset($_GET["action"])&& $_GET["action"] == "deconnexion"){
    session_destroy(); //Détruit la session

    header("location:" . URL);
}

include_once("inc/head.inc.php");
include_once("inc/header.inc.php");
?>
<main class="text-center mt-5">Je suis la page d'accueil</main>


<?php
include_once("inc/footer.inc.php");

?>