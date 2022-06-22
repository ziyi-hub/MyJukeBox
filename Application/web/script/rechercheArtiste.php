<?php

require_once '../../index.php';
use myjukebox\models\Musique;

$musiques = Musique::where('Artiste', 'LIKE','%'.$_GET['input'].'%')->get();

echo $musiques;