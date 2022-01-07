<?php


/*La fonction debug a pour objectif d'afficher un echo pre de la liste envoyé en argument */


function debug(array $list){
    echo "<pre>";
    print_r($list);
    echo "</pre>";

};