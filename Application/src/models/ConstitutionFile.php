<?php


namespace myjukebox\models;


use Illuminate\Database\Eloquent\Model as Modele;

class ConstitutionFile extends Modele
{
    protected $table = 'constitutionfile';
    protected $primaryKey = 'ordre';
    public $timestamps = false;

    public function musiques() {
        return $this->hasMany('myjukebox\models\Musique', 'IDMusique');
    }
}