<?php

namespace myjukebox\controleur;
use myjukebox\models\ConstitutionFile;
use myjukebox\models\Musique;
use myjukebox\vue\VueLecteur;
use myjukebox\vue\VuePrincipale;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControleurFile
{
    private $c;

    public function __construct($c)
    {
        $this->c = $c;
        $this->htmlvars = [
            'home' => $this->c->router->pathFor('home', []),
            'inscription' => $this->c->router->pathFor('inscription', []),
            'connexion' => $this->c->router->pathFor('connexion', []),
            'accueil' => $this->c->router->pathFor('accueil', []),
            'monCompte' => $this->c->router->pathFor('monCompte', []),
            'deconnexion' => $this->c->router->pathFor('deconnexion', []),
            'suppression' => $this->c->router->pathFor('suppression', []),
            'playlist' => $this->c->router->pathFor('playlist', []),
            'favori' => $this->c->router->pathFor('favori', []),
        ];
    }

    function getMusiques(Request $rq, Response $rs, array $args ):Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath(),
            'home' => $this->c->router->pathFor('home', []),
            'accueil' => $this->c->router->pathFor('accueil', []),
            'inscription' => $this->c->router->pathFor('inscription', []),
            'connexion' => $this->c->router->pathFor('connexion', []),
            'monCompte' => $this->c->router->pathFor('monCompte', []),
            'deconnexion' => $this->c->router->pathFor('deconnexion', []),
            'suppression' => $this->c->router->pathFor('suppression', []),
            'playlist' => $this->c->router->pathFor('playlist', []),
            'favori' => $this->c->router->pathFor('favori', []),
        ];

        if ($_SESSION['profile']['id'] ?? ''){
            $vue = new VueLecteur([]);
            $rs->getBody()->write($vue->renderConnecte($htmlvars));
        }else{
            $vue = new VueLecteur([]);
            $rs->getBody()->write($vue->render($htmlvars));
        }
        return $rs;
    }

    function getAccueil(Request $rq, Response $rs, array $args ): Response {
        $htmlvars = [
            'basepath' => $rq->getUri()->getBasePath(),
            'home' => $this->c->router->pathFor('home', []),
            'accueil' => $this->c->router->pathFor('accueil', []),
            'inscription' => $this->c->router->pathFor('inscription', []),
            'connexion' => $this->c->router->pathFor('connexion', []),
            'monCompte' => $this->c->router->pathFor('monCompte', []),
            'deconnexion' => $this->c->router->pathFor('deconnexion', []),
        ];
        $vue = new VuePrincipale([]);
        $rs->getBody()->write($vue->render($htmlvars));
        return $rs;
    }

    function ajouterFile(Request $req, Response $response, $args) {
        $musique = $args['id'];
        $constitution = new ConstitutionFile();
        $constitution->IDFile = 1;
        $constitution->IDMusique = $musique;
        $constitution->save();

    }

    public function getPlaylist(Request $rq, Response $rs, array $args ):Response {
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        $vue = new VueLecteur([]);
        $rs->getBody()->write($vue->renderConnecte(8, $this->htmlvars));
        return $rs;
    }

}