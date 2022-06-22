<?php

require_once '../../index.php';
use myjukebox\models\ConstitutionFile;

$file = ConstitutionFile::where('idFile', '=', 1);

$file = $file->join('musique', 'musique.IDMusique', '=', 'ConstitutionFile.IDMusique')
               ->orderBy('ordre')
               ->get();


echo $file;