<?php 

// Connexion à la BDD

$dsn = 'mysql:dbname=projet_librairie;host=localhost;charset=UTF8';
$user = 'root';
$password = '';

try {
    $bdd = new PDO($dsn, $user, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Échec lors de la connexion : ' . $e->getMessage();
    exit();
}


// Demarrer la session

session_start();

// Initialiser la variable $msg

$msg = "";


// On définit l'URL du site web


define("URL", "http://localhost/php-1122/15-Projet");


//On definie le chemin du fichier qui sera telechargé
define("UPLOADS_FILES", $_SERVER["DOCUMENT_ROOT"] . "/PHP-1122/15-projet/uploads");
