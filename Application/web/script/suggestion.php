<?php

require_once '../../index.php';
use myjukebox\models\Musique;

$musiques = Musique::limit(5)->get();
echo $musiques;