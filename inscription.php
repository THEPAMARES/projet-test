<?php


include_once("inc/init.inc.php");
include_once("inc/functions.inc.php");

if (!empty($_POST["pseudo"])
    && !empty($_POST["email"])
    && !empty($_POST["nom"])
    && !empty($_POST["prenom"])
    && !empty($_POST["date_naissance"])
    && !empty($_POST["adresse"])
    && !empty($_POST["mdp"])
    && !empty($_FILES["photo"])){

        $pseudo = (trim($_POST["pseudo"]));
        $email = (trim($_POST["email"]));
        $nom = (trim($_POST["nom"])); 
        $prenom = (trim($_POST["prenom"]));
        $date_naissance = (trim($_POST["date_naissance"]));
        $adresse = (trim($_POST["adresse"]));
        $mdp = password_hash(trim($_POST["mdp"]),PASSWORD_DEFAULT);
        $photo = $_FILES["photo"];

        // Je prepare ma requete
        $requetePrepare = $bdd->prepare("INSERT INTO user (pseudo, email, nom, prenom, date_naissance, adresse, mdp, photo) VALUES (?,?,?,?,?,?,?,?)");

        // Puis j'execute ma requete
        $resultat = $requetePrepare->execute([$pseudo, $email, $nom, $prenom, $date_naissance, $adresse, $mdp, $photo]);

        if ($resultat){
            echo "<p> $nom a bien été ajouté</p>";
        }else{
            echo "<p> Il y a un soucis avec l'enregistrement en base de donnée !";
        }


    }

        debug($_POST);
        debug($_FILES);



include_once("inc/head.inc.php");
include_once("inc/header.inc.php");





?>

<h1 class="m-5 text-center">Demande d'inscription</h1>


    <form class="container" method="post" action="" enctype="multipart/form-data">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="pseudo" placeholder="pseudo" aria-label="pseudo" aria-describedby="basic-addon1" name="pseudo">
        </div>

        <div class="mb-3">
            <input type="email" class="form-control" id="email" placeholder="email" name="email">
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" id="nom" placeholder="nom" aria-label="nom" aria-describedby="basic-addon1" name="nom">
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" id="prenom" placeholder="prenom" name="prenom">
        </div>

        <div class="mb-3">
            <input type="date" class="form-control" id="date_naissance" placeholder="date_naissance" name="date_naissance">
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" id="adresse" placeholder="adresse" name="adresse">
        </div>

        <div class="mb-3">
            <input type="password" class="form-control" id="mdp" placeholder="mdp" name="mdp">
        </div>

        <div class="mb-3 form-floating">
            <input type="file" class="form-control" id="photo" placeholder="photo" name="photo" >
            <label for="photo">Photo de profil</label>
        </div>

            <button type="submit" class="btn btn-primary d-block mx-auto my-5">Valider</button>
    </form>


<?php

include_once("inc/footer.inc.php");

?>

