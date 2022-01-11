<?php







include_once("../inc/init.inc.php");
include_once("../inc/functions.inc.php");

// Si l'utilisateur n'est pas admin, alors on la redirige vers la page d'accueil
if (!is_admin()){
    header("location:" . URL);
    exit;
}

if (!isset($_GET["id"])){
    header("location:" . URL);
    exit;
}

$id=$_GET["id"];


if (!empty($_POST)){

    // Controles sur pseudo

    $pseudo = $_POST["pseudo"];
    if (!isset($pseudo) || !verifPseudo($pseudo)){
        $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
            Votre pseudo n'est pas valide. Vérifiez qu'il soit bien compris entre 4 et 50 caractères 
      </div>";
    }

    // Controle sur le nom

    $nom = $_POST["nom"];
    if (!isset($nom) || !verifNom($nom)){
        $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
            Votre nom n'est pas valide. Vérifiez qu'il soit bien compris entre 2 et 255 caractères 
      </div>";
    }

    // Controle sur l'email

    $email = $_POST["email"];
    if (!isset($email) || !verifEmail($email)){
        $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
            Votre Email n'est pas valide. Vérifiez qu'il soit bien compris entre 2 et 255 caractères 
      </div>";
    }


    // Pour les autres, je ne fais pas de controle pour le moment, j'enregistre juste les variables

    $prenom = $_POST["prenom"];
    $date_naissance = $_POST["date_naissance"];
    $adresse = $_POST["adresse"];


    if (empty($msg)){

        $requeteUpdate = $bdd->prepare("UPDATE user SET pseudo=?,email=?,nom=?,prenom=?,date_naissance=?,adresse=? WHERE id_user=?");

        $resultat2 = $requeteUpdate->execute([
            $pseudo,
            $email,
            $nom,
            $prenom,
            $date_naissance,
            $adresse,
            $id
        ]);

        if ($resultat2){
            $msg .= "<div class=\"alert alert-success\" role=\"alert\">
            Les modifications ont bien été prise en compte
      </div>";
        }


    }
}



$requetePreparee = $bdd->prepare("SELECT * FROM user WHERE id_user=?");

$resultat = $requetePreparee->execute([
    $id
]);

if (!$resultat){
    $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
            Il y a eu un problème avec la requete
      </div>";
}




$infoUser = $requetePreparee->fetch(PDO::FETCH_ASSOC);




include_once("../inc/head.inc.php");
include_once("../inc/header.inc.php");

?>
<main>



    <h1 class="text-center my-5">Modifier le membre <?=$id?></h1>

    <form action="" method="post" enctype="multipart/form-data" class="container w-75 mx-auto">

        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" placeholder="john123" name="pseudo" required value="<?= $infoUser["pseudo"]?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="test@gmail.fr" name="email" value="<?= $infoUser["email"]?>">
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" placeholder="john123" name="nom" value="<?= $infoUser["nom"]?>">
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Prenom</label>
            <input type="prenom" class="form-control" id="prenom" placeholder="john123" name="prenom" value="<?= $infoUser["prenom"]?>">
        </div>
        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?= $infoUser["date_naissance"]?>">
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Adresse</label>
            <input type="adresse" class="form-control" id="adresse" placeholder="1 rue de Lille, 75 007 Paris" name="adresse" value="<?= $infoUser["adresse"]?>">
        </div>
        

        <input type="submit" value="Envoyer" class="btn btn-primary">

        

    </form>
</main>


<?php

include_once("../inc/footer.inc.php");