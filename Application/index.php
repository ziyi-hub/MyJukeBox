<?php

require_once 'vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

session_start();

if (!isset($_SESSION['credits'])) {
    $_SESSION['credits'] = 5;
}

$config = require_once 'src/conf/settings.php';

$c = new \Slim\Container($config);

$db = new DB();
$db->addConnection(parse_ini_file($config['settings']['dbfile']));
$db->setAsGlobal();
$db->bootEloquent();

$app = new \Slim\App($c);

$app->get('/accueil',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurFile($this);
        $response = $controleurfile->getMusiques($req, $response, $args);
        return $response;
    }
)->setName('home');

$app->get('/',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurFile($this);
        $response = $controleurfile->getAccueil($req, $response, $args);
        return $response;
    }
)->setName('accueil');

$app->get('/ajout/{id}',
    function(Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurFile($this);
        $controleurfile->ajouterFile($req, $response, $args);
        return $response;
    }
)->setName('ajoutMusiqueFile');

$app->get('/inscription',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->getInscription($req, $response, $args);
        return $response;
    }
)->setName('inscription');

$app->post('/validerInscription',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->validerInscription($req, $response, $args);
        return $response;
    }
)->setName('validerInscription');

$app->get('/connexion',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->getConnexion($req, $response, $args);
        return $response;
    }
)->setName('connexion');

$app->post('/validerConnexion',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->validerConnexion($req, $response, $args);
        return $response;
    }
)->setName('validerConnexion');

$app->get('/monCompte',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->getMonCompte($req, $response, $args);
        return $response;
    }
)->setName('monCompte');

$app->post('/modifMotDePasse',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->modifierMotDePasse($req, $response, $args);
        return $response;
    }
)->setName('modifMotDePasse');

$app->get('/deconnexion',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->deconnexion($req, $response, $args);
        return $response;
    }
)->setName('deconnexion');

$app->get('/suppression',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->getSuppression($req, $response, $args);
        return $response;
    }
)->setName('suppression');

$app->post('/validerSuppression',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->validerSuppression($req, $response, $args);
        return $response;
    }
)->setName('validerSuppression');

$app->get('/playlist',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->creerPlaylist($req, $response, $args);
        return $response;
    }
)->setName('playlist');

$app->get('/favori',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->getFavori($req, $response, $args);
        return $response;
    }
)->setName('favori');

$app->post('/creerPlaylist',
    function (Request $req, Response $response, $args): Response {
        $controleurfile = new \myjukebox\controleur\ControleurGestionCompte($this);
        $response = $controleurfile->creerPlaylist($req, $response, $args);
        return $response;
    }
)->setName('creerPlaylist');

$app->run();