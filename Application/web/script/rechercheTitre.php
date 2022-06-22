<?php

require_once '../../index.php';
use myjukebox\models\Musique;

$musiques = Musique::where('Titre', 'LIKE','%'.$_GET['input'].'%')->get();

echo $musiques;