<?php


namespace myjukebox\models;
use \Illuminate\Database\Eloquent\Model as Modele;


class historique extends Modele
{
    protected $table = 'historique';
    protected $primaryKey = 'ordre';
    public $timestamps = false;

}