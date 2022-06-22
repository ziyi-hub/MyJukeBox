<?php

require_once '../../index.php';
use myjukebox\models\Musique;

$musiques = Musique::where('NomAlbum', 'LIKE','%'.$_GET['input'].'%')->get();

echo $musiques;