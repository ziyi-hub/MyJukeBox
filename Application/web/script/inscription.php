<?php

require_once '../../index.php';
use myjukebox\models\Utilisateur;

$NomUtilisateur = $_GET['NomUtilisateur'];

$response = Utilisateur::query()->where('NomUtilisateur', '=', $NomUtilisateur)->count();


if (preg_match('/ /', $NomUtilisateur)){
    echo '<span style="color: red; ">N\'utilisez pas d\'espace</span>';
}else{

    if(($response === 0)){
        echo '<span style="color: mediumspringgreen; ">Nom d\'utilisateur disponible</span>';
    }else{
        echo '<span style="color: red; ">Ce nom d\'utilisateur existe déjà</span>';
    }
}