<?php

require_once '../../index.php';

use myjukebox\models\Utilisateur;

if (!isset($_SESSION['profile']['id'])) {

    if(isset($_SESSION['credits'])) {
        if($_SESSION['credits']<5){
            $_SESSION['credits']++;
        }
        echo $_SESSION['credits'];
    }

} else {
    $user = Utilisateur::find($_SESSION['profile']['id']);
    if($user->Credits<10){
        $user->increment('Credits');
        $user->save();
    }
    echo $user->Credits;
}