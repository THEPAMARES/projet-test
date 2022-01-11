<?php 


include_once("inc/init.inc.php");
include_once("inc/functions.inc.php");

//Si l'utilisateur est connecté, on le renvoi vers la page profil
if(is_connect()){
    header("location:" . URL . "/profil.php");
    exit;
}
// debug($_POST);


if (!empty($_POST)){

    // Controles sur pseudo

    $pseudo = $_POST["pseudo"];
    if (!isset($pseudo) || !verifPseudo($pseudo)){
        $msg .= "<div class=\"alert alert-danger w-50 mx-auto my-5\" role=\"alert\">
            Le pseudo n'existe pas. 
      </div>";
    }

    $mdp = $_POST["mdp"];

    //On fait la requete pour recuperer la ligne avec le pseudo dans la bdd

    $requetePreparee = $bdd->prepare("SELECT * FROM user WHERE pseudo=?;");

    $resultat = $requetePreparee->execute([
        $pseudo
    ]);

    if ($resultat){ //si la requete s'est bien passée

        if (!$requetePreparee->rowCount()){ //Nous sommes dans le cas ou on obtient 0 resultat

            $msg = "<div class=\"alert alert-danger w-50 mx-auto my-5\" role=\"alert\">
            Le pseudo n'existe pas. 
            </div>";

        }

        if (empty($msg)){

            //On fetch $requetePreparee, pour recuperer le mot de passe haché en bdd

            $infoUser = $requetePreparee->fetch(PDO::FETCH_ASSOC);

            //Attention dans ce cas precis, $mdpHache est une liste !
            // debug($infoUser);

            if (password_verify($mdp, $infoUser["mdp"])){

                //Si le mdp correspond, alors on redirige vers la page profil 

                $_SESSION["pseudo"] = $pseudo;
                $_SESSION["email"] = $infoUser["email"];
                $_SESSION["nom"] = $infoUser["nom"];
                $_SESSION["prenom"] = $infoUser["prenom"];
                $_SESSION["date_naissance"] = $infoUser["date_naissance"];
                $_SESSION["adresse"] = $infoUser["adresse"];
                $_SESSION["mdp"] = $infoUser["mdp"];
                $_SESSION["photo"] = $infoUser["photo"];
                $_SESSION["statut"] = $infoUser["statut"];


                header("location:" . URL . "/profil.php?message=succesConnection");
                exit;
            }else{
                $msg = "<div class=\"alert alert-danger w-50 mx-auto my-5\" role=\"alert\">
                Votre mot de passe n'est pas valide. 
                </div>";
            }
        }
    }
}


include_once("inc/head.inc.php");
include_once("inc/header.inc.php");



?>
<main>
    <h1 class="text-center my-5">Connexion</h1>

    <form action="" method="post" enctype="multipart/form-data" class="container w-75 mx-auto">
        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" placeholder="" name="pseudo" required value="<?= (isset($pseudo) ? $pseudo : "");?>">
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp">
        </div>

        <div class="col-auto">
            <input type="submit" value="Envoyer" class="btn btn-primary">
        </div>
    </form>
</main>
<?php

include_once("inc/footer.inc.php");

