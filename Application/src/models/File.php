<?php

namespace myjukebox\models;
use \Illuminate\Database\Eloquent\Model as Modele;

class File extends Modele
{
    protected $table = 'fileattente';
    protected $primaryKey = 'IDFile';
    public $timestamps = false;

    public function musiques() {
        return "";
    }
}