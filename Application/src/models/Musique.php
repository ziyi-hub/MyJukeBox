<?php

namespace myjukebox\models;
use \Illuminate\Database\Eloquent\Model as Modele;

class Musique extends Modele
{
    protected $table = 'musique';
    protected $primaryKey = 'IDMusique';
    public $timestamps = false;

    public function file() {
        return "";
    }
}