<?php 


include_once("inc/init.inc.php");
include_once("inc/functions.inc.php");

// debug($_POST);
// debug($_FILES);
// debug($_SERVER);



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
    $mdp = password_hash($_POST["mdp"],PASSWORD_DEFAULT);


    // Controle du format de la photo
    
    if ($_FILES["photo"]){ // Je ne veux faire le controle que si la photo existe

        if (!verifPhoto()){
            $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
            Votre photo n'est pas valide. Seul les jpg, jpeg et png sont acceptés
      </div>";
        }

    }

    // Procédons a l'enregistrement de la photo, puis a l'enregistrement en bdd

    if (empty($msg)){
        // On ne procede a l'enregistrement que s'il n'y a pas de message d'erreurs

        echo "Je passe ici ";
        //UPLOADS_FILES pour telecharger les elemenst sinon avec l'URL on aura un messaged d'erreur
        $cheminTelechargement = UPLOADS_FILES . "/photo_profils/profil-" . $pseudo . "-" . time() . "-" . $_FILES["photo"]["name"];

        if (!move_uploaded_file($_FILES["photo"]["tmp_name"], $cheminTelechargement)){
            $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
            Quelque chose ne s'est pas passé correctement au niveau de l'enregistrement de votre fichier
      </div>";
        }
    }

    // Enregistrement en bdd

    if (empty($msg)){

        $requetePreparee = $bdd->prepare("INSERT INTO user 
                    (pseudo, email, nom, prenom, date_naissance, adresse, mdp, photo) 
                    VALUES (?,?,?,?,?,?,?,?)");

        $resultat = $requetePreparee->execute([
            $pseudo,
            $email,
            $nom,
            $prenom,
            $date_naissance,
            $adresse,
            $mdp,
            $cheminTelechargement
            
        ]);

        if ($resultat){
            $msg .= "<div class=\"alert alert-success\" role=\"alert\">
            Bravo $pseudo ! 
            Un nouvel utilisateur a bien été enregistré ! 
      </div>";
        }else{
            $msg .= "<div class=\"alert alert-danger\" role=\"alert\">
            Quelque chose ne s'est pas passé correctement au niveau de l'enregistrement en base de donnée
      </div>";
        }



    }





}


include_once("inc/head.inc.php");
include_once("inc/header.inc.php");







?>





<main>



    <h1 class="text-center my-5">Page d'inscription</h1>
        <!-- enctype pour recuperer les fichiers telechargés -->
    <form action="" method="post" enctype="multipart/form-data" class="container w-75 mx-auto">

        <div class="mb-3">
            <label for="pseudo" class="form-label">Pseudo</label>
            <input type="text" class="form-control" id="pseudo" placeholder="" name="pseudo" required value="<?= (isset($pseudo) ? $pseudo : "");?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="" name="email" value="<?= (isset($email) ? $email : "");?>">
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" placeholder="" name="nom" value="<?= (isset($nom) ? $nom : "");?>">
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Prenom</label>
            <input type="prenom" class="form-control" id="prenom" placeholder="" name="prenom" value="<?= (isset($prenom) ? $prenom : "");?>">
        </div>
        <div class="mb-3">
            <label for="date_naissance" class="form-label">Date de naissance</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?= (isset($date_naissance) ? $date_naissance : "");?>">
        </div>
        <div class="mb-3">
            <label for="text" class="form-label">Adresse</label>
            <input type="adresse" class="form-control" id="adresse" placeholder="" name="adresse" value="<?= (isset($adresse) ? $adresse : "");?>">
        </div>
        <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="mdp" name="mdp">
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Photo de profil</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>

        <input type="submit" value="Envoyer" class="btn btn-primary">

        

    </form>
</main>



<?php

include_once("inc/footer.inc.php");