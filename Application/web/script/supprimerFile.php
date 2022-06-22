<?php


require_once '../../index.php';
use myjukebox\models\ConstitutionFile;

$ordre =  $_GET['no'];

$resul = ConstitutionFile::where('ordre', '=', $ordre)->first();

$resul->delete();