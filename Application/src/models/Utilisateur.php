<?php


namespace myjukebox\models;
use \Illuminate\Database\Eloquent\Model as Modele;

class Utilisateur extends Modele
{
    protected $table = 'utilisateur';
    protected $primaryKey = 'IDUtilisateur';
    public $timestamps = false;

    public function idutilisateur()
    {
        return '';
    }

}