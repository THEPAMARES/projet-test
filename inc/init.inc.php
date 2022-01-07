<?php

//Connexion de la bdd

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

$msg="";


// Definir l'url du site web





define("URL","http://localhost/PHP-1122/15-projet");

?>