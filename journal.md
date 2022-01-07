# Creation des tables de la base de donnée

On commence uniquement avec la table utilisateur


# Creer les fichiers d'inclusions

Dans un dossier inc
    -> init.inc.php
    -> functions.inc.php
    -> head.inc.php
    -> header.inc.php
    -> footer.inc.php


# Dans index.php, on appel tout les fichiers d'inclusions dans l'ordre

include_once("inc/init.inc.php");
include_once("inc/functions.inc.php");
include_once("inc/head.inc.php");
include_once("inc/header.inc.php");
include_once("inc/footer.inc.php");


# On créé un dossier assets

Il contiendra
    ->css
        ->style.css
    ->js
        ->script.js
    ->images
        ->logo.png
# Créé une fonction debug


# Inscription.php

On créé la page inscription.php qui sevira à rentrer une nouvelle ligne dans la table user

Objectif : Faire le HTML puis l'enregistrement, puis l'inscription en base de donnée