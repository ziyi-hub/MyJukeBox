<?php

require_once '../../index.php';
use myjukebox\models\Musique;

$musiques = Musique::all();
echo $musiques;