<?php

require_once '../../index.php';

use myjukebox\models\Utilisateur;


if (!isset($_SESSION['profile']['id'])) {
    if (isset($_SESSION['credits'])) {
        if ($_SESSION['credits'] > 0) {
            $_SESSION['credits']--;
        }
        echo $_SESSION['credits'];
    }

} else {
    $user = Utilisateur::find($_SESSION['profile']['id']);
    if($user->RoleID==2)
        echo 1;
    else {
        if ($user->Credits > 0) {
            $user->decrement('Credits');
            $user->save();
        } else {
            echo -100;
        }
    }
    echo $user->Credits;
}
