<?php


/**
 * La fonction debug a pour objectif d'afficher un echo pre de la liste envoyé en argument
 * @var list
 * @return null
 */

 function debug(array $liste){
    echo "<pre>";
    print_r($liste);
    echo "</pre>";
 }

 /**
  * Objectif : Renvoyer true si le pseudo est correcte, false sinon
  * @var $pseudo
  * @return bool true si le pseudo est vérifié, false sinon
  */

  function verifPseudo($pseudo){

        // Verifie si le pseudo existe pas
        if (!isset($pseudo)){
            return false;
        }

        // Verifie si le pseudo n'est pas vide
        if (empty($pseudo)){
            return false;
        }

        // Verifier la longeur du pseudo
        // Il doit être compris 4 et 50 caracteres
        if (strlen($pseudo)<4 OR strlen($pseudo)>50){
            return false;
        }

        


        return true;
  }



  /**
  * Objectif : Renvoyer true si le nom est correcte, false sinon
  * @var $nom
  * @return bool true si le nom est vérifié, false sinon
   */

   function verifNom($nom){

    // Verifie si le nom existe pas
    if (!isset($nom)){
        return false;
    }

    // Verifie si le nom n'est pas vide
    if (empty($nom)){
        return false;
    }


    // Verifier la longeur du nom
    // Il doit être compris 2 et 255 caracteres
    if (strlen($nom)<2 OR strlen($nom)>255){
        return false;
    }

    return true;

}


 /**
  * Objectif : Renvoyer true si l'email est correcte, false sinon
  * @var $email
  * @return bool true si l'email est vérifié, false sinon
   */

  function verifEmail($email){

    // Verifie si l'email' existe pas
    if (!isset($email)){
        return false;
    }

    // Verifie si l'email n'est pas vide
    if (empty($email)){
        return false;
    }


    // Verifier la longeur du nom
    // Il doit être compris 2 et 255 caracteres
    if (strlen($email)<2 OR strlen($email)>255){
        return false;
    }

    // Verfie si le format est bien un email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return false;
    }


    return true;

}


/**
 * verifPhoto verifie que le format de la photo est ok pour nous
 * @param null
 * @return bool true si le format est ok, false sinon
 */

function verifPhoto(){ // Pas besoin d'argument, car toutes les informations neccessaires sont dans la superglobal $_FILES, et que les superglobales sont aussi accessible dans les fonctions


    if ($_FILES["photo"]["type"] == "image/png"){
        return true;
    }

    if ($_FILES["photo"]["type"] == "image/jpeg"){
        return true;
    }

    if ($_FILES["photo"]["type"] == "image/jpg"){
        return true;
    }

    return false;
}

/** La fonction is_connect renvoie true si la personne est connecté, false sinon
* @param null
* @return bool
*/

function is_connect(){
    if (isset($_SESSION["pseudo"])){
        return true;
    }

    return false;
}

/**
 * La fonction is_admin renvoie true si la personne est connectée ET est un admin, sinon false
 * @param null
 * @return bool
 */

function is_admin(){

    if(!is_connect()){
        return false;
    }
    //On va chercher dans la session le statut de l'utilisateur, si il est égale à zero alors on renvoi false sinon true.
    if ($_SESSION["statut"] == 0){
        return false;
    }

    return true;
}