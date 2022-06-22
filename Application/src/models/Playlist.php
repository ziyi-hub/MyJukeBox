<?php


namespace myjukebox\models;
use \Illuminate\Database\Eloquent\Model as Modele;

class Playlist extends Modele
{
    protected $table = 'playlist';
    protected $primaryKey = 'IDPlaylist';
    public $timestamps = false;
}