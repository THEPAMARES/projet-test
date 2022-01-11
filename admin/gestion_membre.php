<?php


include_once("../inc/init.inc.php");
include_once("../inc/functions.inc.php");

// Pour nommer un administrateur 
//Si l'utilisateur n'est pas admin alors on le redirige vers la page d'accueil
if (!is_admin()){
    header("location:" . URL);
    exit;
}

// Pour nommer un administrateur
// Si on a bien un get action, et qu'il est egal a ajout_admin, et si il y a un id
if (isset($_GET["action"]) 
    && $_GET["action"] == "ajout_admin"
    && isset($_GET["id"])){

        $requetePreparee = $bdd->prepare("UPDATE user SET statut=1 WHERE id_user=?");

        $resultat = $requetePreparee->execute([
            $_GET["id"]
        ]);

        if ($resultat){
            $msg .= "<div class=\"alert alert-success\" role=\"alert\">
            Un nouvel administrateur a bien été nommé
      </div>";
        }

}

// Je veux verifier que get action existe, et qu'il est bien égal a "add_admin" (et je verifie aussi qu'il y a l'id)

// Si c'est bien le cas, dans le if (je fais ma requete qui change le statut)

// Pour enlever quelqu'un des admins
// J'aaplique le code pour enlever un administrateur si et seulement get action existe, get action est egale a supprimer_admin et get id existe
if (isset($_GET["action"])
    && $_GET["action"] == "supprimer_admin"
    && isset($_GET["id"])){

        $requetePreparee = $bdd->prepare("UPDATE user SET statut=0 WHERE id_user=?");

        $resultat = $requetePreparee->execute([
            $_GET["id"]
        ]);

        if ($resultat){
            $msg .= "<div class=\"alert alert-success\" role=\"alert\">
            L'ancien administrateur est maintenant un utilisateur
      </div>";
        }


    }

// Pour supprimer un membre

if (isset($_GET["action"])
    && $_GET["action"] == "supprimer_membre"
    && isset($_GET["id"])){

        $requetePreparee = $bdd->prepare("DELETE FROM user WHERE id_user=?");

        $resultat = $requetePreparee->execute([
            $_GET["id"]
        ]);

        if ($resultat){
            $msg .= "<div class=\"alert alert-success\" role=\"alert\">
            Le membre a bien été supprimé
      </div>";
        }


    }


$resultatRequete = $bdd->query("SELECT * FROM user");

$tousLesAbonnés = $resultatRequete->fetchAll(PDO::FETCH_ASSOC);

include_once("../inc/head.inc.php");
include_once("../inc/header.inc.php");
?>
<main>
    <h1 class="text-center my-5">Liste des abonnés</h1>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">id</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Email</th>
                <th scope="col">Nom</th>
                <th scope="col">Prenom</th>
                <th scope="col">Date de naissance</th>
                <th scope="col">Adresse</th>
                <th scope="col">Photo</th>
                <th scope="col">Statut</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php

                foreach($tousLesAbonnés as $user){

                    // Le chemin de la photo dans la bdd commence par c://
                    // Hors, on veut commencer par l'url (localhost/projet...)

                    // Alors ce qu'on fait, c'est qu'on découpe le chemin de la photo en prenant comme séparateur notre constante UPLOADS_FILES
                    // Cette fonction va nous renvoyer l'url de la photo SANS LA PARTIE QUI VIENT DE UPLOADS_FILES
                    $cheminPhoto = explode(UPLOADS_FILES,$user["photo"]);
                    // debug($cheminPhoto);
                    

                    ?>
                        <tr>
                            <th scope="row"><?=$user["id_user"]?></th>
                            <td><?=$user["pseudo"]?></td>
                            <td><?=$user["email"]?></td>
                            <td><?=$user["nom"]?></td>
                            <td><?=$user["prenom"]?></td>
                            <td><?=$user["date_naissance"]?></td>
                            <td><?=$user["adresse"]?></td>
                            <td><img src="<?=URL . "/uploads" . $cheminPhoto[1]?>" width=80></td>
                            <td><?=$user["statut"] == 1 ? "Admin" : "";?></td>
                            <td>
                            <?php
                                if ($user["statut"] == 0){
                                    ?>
                                    <a href="?action=ajout_admin&id=<?=$user["id_user"];?>" class="btn btn-primary">Nommer admin</a>
                                    <?php
                                }elseif($user["statut"] == 1){
                                    ?>
                                        <a href="?action=supprimer_admin&id=<?=$user["id_user"];?>" class="btn btn-warning">Supprimer admin</a>

                                        <?php
                                }
                                ?>
                                <a href="?action=supprimer_membre&id=<?=$user["id_user"];?>" class="btn btn-danger">Supprimer membre</a>
                                <a href="<?= URL ?>/admin/modifier_membre.php?action=modifier_membre&id=<?=$user["id_user"]?>" class="btn btn-info">Modifier membre</a>
                                
                            </td>
                        </tr>
                    <?php
                }
           ?>
        </tbody>
    </table>
</main>
<?php
include_once("../inc/footer.inc.php");

?>