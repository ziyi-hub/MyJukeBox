<?php

require_once '../../index.php';
use myjukebox\models\ConstitutionFile;
use myjukebox\models\Musique;

/**$file = ConstitutionFile::where('idFile', '=', 1)->first();

$musique = $file->musiques()->first();

echo $musique;*/

$file = ConstitutionFile::query()->where('idFile', '=', 1)->first();
$musique = Musique::query()->where("IDMusique", '=', $file->IDMusique)->first();
echo $musique;

