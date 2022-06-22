<?php


namespace myjukebox\controleur;
use myjukebox\models\Playlist;
use myjukebox\models\Utilisateur;
use myjukebox\vue\VueGestionCompte;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class ControleurGestionCompte
{
    private $c;
    private $htmlvars;

    /**
     * ControleurGestionCompte constructor.
     * @param $c
     */
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

    /**
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getInscription(Request $rq, Response $rs, array $args ):Response {
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        $vue = new VueGestionCompte([], $this->c);
        $rs->getBody()->write($vue->render(4, $this->htmlvars));
        return $rs;
    }

    /**
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getPlaylist(Request $rq, Response $rs, array $args ):Response {
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        $vue = new VueGestionCompte([], $this->c);
        $rs->getBody()->write($vue->renderConnecte(8, $this->htmlvars));
        return $rs;
    }


    public function getFavori(Request $rq, Response $rs, array $args ):Response {
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        $vue = new VueGestionCompte([], $this->c);
        $rs->getBody()->write($vue->renderConnecte(7, $this->htmlvars));
        return $rs;
    }

    /**
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getConnexion(Request $rq, Response $rs, array $args ):Response{
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        $vue = new VueGestionCompte([], $this->c);
        $rs->getBody()->write($vue->render(3, $this->htmlvars));
        return $rs;
    }

    /**
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getSuppression(Request $rq, Response $rs, array $args ):Response{
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        $eloquentResult = Utilisateur::all();
        $vue = new VueGestionCompte([$eloquentResult], $this->c);
        $rs->getBody()->write($vue->renderConnecte(5, $this->htmlvars));
        return $rs;
    }

    /**
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function getMonCompte(Request $rq, Response $rs, array $args ):Response{
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        if ($_SESSION['profile']['id'] ?? ''){
            $eloquentResult = Utilisateur::query()
                ->where('IDUtilisateur', '=', $_SESSION['profile']['id'])
                ->firstOr();
            if (!is_null($eloquentResult)) {
                $vue = new VueGestionCompte([$eloquentResult], $this->c);
                $rs->getBody()->write($vue->renderConnecte(1, $this->htmlvars));
            }
        }else{
            $vue = new VueGestionCompte([], $this->c);
            $rs->getBody()->write($vue->render(2, $this->htmlvars));
        }
        return $rs;
    }

    /**
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function validerInscription(Request $rq, Response $rs, array $args ):Response{
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        $post = $rq->getParsedBody();
        $NomUtilisateur = filter_var($post['NomUtilisateur'], FILTER_SANITIZE_STRING) ;
        $MotDePasse = filter_var($post['MotDePasse'] , FILTER_SANITIZE_STRING) ;
        $MotDePasse2 = filter_var($post['MotDePasse2'] , FILTER_SANITIZE_STRING) ;
        if (($MotDePasse === $MotDePasse2)&&(strpos($NomUtilisateur, ' ') === false)){
            $hash = password_hash($MotDePasse, PASSWORD_DEFAULT);
            $utilisateur = new Utilisateur();
            $utilisateur->NomUtilisateur = $NomUtilisateur;
            $utilisateur->MotDePasse = $hash;
            $utilisateur->RoleID = 1;
            $utilisateur->save();
            echo "<script>alert('Inscription réussie')</script>";
            $vue = new VueGestionCompte([], $this->c);
            $rs->getBody()->write($vue->render(3, $this->htmlvars));
        }elseif ($MotDePasse !== $MotDePasse2){
            echo "<script>alert('Les deux mots de passe doivent être identiques')</script>";
            $vue = new VueGestionCompte([], $this->c);
            $rs->getBody()->write($vue->render(4, $this->htmlvars));
        }else{
            $vue = new VueGestionCompte([], $this->c);
            $rs->getBody()->write($vue->render(4, $this->htmlvars));
        }
        return $rs;
    }

    /**
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function validerSuppression(Request $rq, Response $rs, array $args ):Response{
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        $post = $rq->getParsedBody();
        $IDUtilisateur = filter_var($post['id'], FILTER_SANITIZE_STRING);
        $utilisateur = Utilisateur::find($IDUtilisateur);
        if (is_null($utilisateur)){
            echo "<script>alert('Compte n\'existe pas')</script>";
        }else{
            $utilisateur->delete();
            echo "<script>alert('Suppression réussie')</script>";
        }
        $vue = new VueGestionCompte([], $this->c);
        $rs->getBody()->write($vue->renderConnecte(5, $this->htmlvars));
        return $rs;
    }


    public function creerPlaylist(Request $rq, Response $rs, array $args ):Response{
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        if ($_SESSION['profile']['id'] ?? ''){
            $eloquentResult = Utilisateur::query()
                ->select("IDUtilisateur")
                ->where('IDUtilisateur', '=', $_SESSION['profile']['id'])
                ->firstOr();
        }
        $playlist = new Playlist();
        $playlist->IDUtilisateur = $eloquentResult["IDUtilisateur"];
        $playlist->save();
        $nb = Playlist::query()->select("IDPlaylist")->count();
        $vue = new VueGestionCompte([$nb], $this->c);
        $rs->getBody()->write($vue->renderConnecte(8, $this->htmlvars));
        return $rs;
    }

    /**
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function validerConnexion(Request $rq, Response $rs, array $args ):Response{
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        $post = $rq->getParsedBody();
        $Login = filter_var($post['user'], FILTER_SANITIZE_STRING) ;
        $password = filter_var($post['password'] , FILTER_SANITIZE_STRING);

        $eloquentResult = Utilisateur::query()
            ->where('NomUtilisateur','=', $Login)
            ->firstOr();

        if (!is_null($eloquentResult) && password_verify($password, $eloquentResult->MotDePasse) === true) {
            $user = Utilisateur::find($eloquentResult->IDUtilisateur);

            if(empty($_SESSION['profile'])){
                $_SESSION['profile'] = array(
                    'id'         => $user->IDUtilisateur,
                    'username'   => $user->NomUtilisateur,
                    'role_id'    => $user->RoleID,
                    'mdp'        => $user->MotDePasse,
                );
            }
            $vue = new VueGestionCompte([$eloquentResult], $this->c);
            $rs->getBody()->write($vue->renderConnecte(1, $this->htmlvars));
        }else{
            echo "<script>alert('Attention! Le mot de passe incorrect! ')</script>";
            $vue = new VueGestionCompte([], $this->c);
            $rs->getBody()->write($vue->render(3, $this->htmlvars));
        }
        return $rs;
    }


    /**
     * @param Request $rq
     * @param Response $rs
     * @param array $args
     * @return Response
     */
    public function modifierMotDePasse(Request $rq, Response $rs, array $args ):Response{
        $this->htmlvars['basepath'] = $rq->getUri()->getBasePath();
        $post = $rq->getParsedBody();
        $AncienMdp = filter_var($post['amdp'], FILTER_SANITIZE_STRING) ;
        $MotDePasse = filter_var($post['mdp'] , FILTER_SANITIZE_STRING) ;

        if ($_SESSION['profile']['id'] ?? ''){
            $eloquentResult = Utilisateur::query()
                ->where('IDUtilisateur', '=', $_SESSION['profile']['id'])
                ->firstOr();
            if (password_verify($AncienMdp, $eloquentResult->MotDePasse) === true){
                $eloquentResult->MotDePasse = password_hash($MotDePasse, PASSWORD_DEFAULT);
                $eloquentResult->save();
                echo "<script>alert('Modification réussie')</script>";
                session_unset();
                $vue = new VueGestionCompte([], $this->c);
                $rs->getBody()->write($vue->render(3, $this->htmlvars));
            }else{
                echo "<script>alert('Attention! Ancien mot de passe incorrect! ')</script>";
                $rs->withRedirect($this->getMonCompte($rq, $rs, $args));
            }
        }
        return $rs;
    }


    public function deconnexion(Request $rq, Response $rs, array $args ):Response{
        if($_SESSION['profile']['id'] ?? '')
        {
            session_unset();
        }
        $rs->withRedirect($this->getConnexion($rq, $rs, $args));
        return $rs;
    }


}