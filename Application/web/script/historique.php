<?php

require_once '../../index.php';
use myjukebox\models\historique as historique;

//Finalement l historique est global, comme on a qu une seule file. e

//Requete eloquent  pour rechercher le nom des dix dernieres musiques jouees
$historique = historique::join('musique','musique.IDMusique','=','historique.IDMusique')
                ->select('musique.Titre')
                ->orderBy('ordre','DESC')
                ->limit(10)
                ->get();

//correspond a la requete sql suivante :
// SELECT historique.IDMusique,titre,ordre FROM `historique` INNER JOIN musique on musique.IDMusique=historique.IDMusique ORDER BY ordre DESC LIMIT 10


echo $historique;
