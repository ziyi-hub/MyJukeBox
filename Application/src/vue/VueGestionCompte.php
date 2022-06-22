<?php


namespace myjukebox\vue;


class VueGestionCompte
{
    private $data;
    private $selecteur;
    private $htmlvars;
    private $container;
    const COMPTE_VIEW = 1;
    const ERREUR_VIEW = 2;
    const CONNEXION_VIEW = 3;
    const INSCRIPTION_VIEW = 4;
    const SUPPRESSION_VIEW = 5;
    const FAVORI_VIEW = 7;
    const CREERPLAYLIST_VIEW = 8;

    public function __construct(array $d, $c)
    {
        $this->data = $d;
        $this->container = $c;
    }

    private function AfficherIden() {
        $l = $this->data[0];
        if ($l->RoleID === 2){
            $html = <<<END
<div class="infoProfil">PROFIL #N°$l->IDUtilisateur<div class="infoProfil_item">$l->NomUtilisateur</div>Administrateur</div>
END;
        }else{
            $html = <<<END
<div class="infoProfil">PROFIL #N°$l->IDUtilisateur<div class="infoProfil_item">$l->NomUtilisateur</div>Utilisateur-inscrit</div>
END;
        }
        return $html;
    }

    private function VerifAdmi() {
        $role = $_SESSION["profile"]["role_id"];
        $deconnexion = $this->htmlvars['deconnexion'];
        $monCompte = $this->htmlvars['monCompte'];
        $suppression = $this->htmlvars['suppression'];
        if ($role === 2){
            $html = <<<END
<li><div id="triangle"></div></li>
<li><a href=$monCompte>Mon Compte</a></li>
<li><a href=$suppression>Gérer compte</a></li>
<li><a href=$deconnexion>Déconnexion</a></li>
END;
        }else{
            $html = <<<END
<li><div id="triangle"></div></li>
<li><a href=$monCompte>Mon Compte</a></li>
<li><a href=$deconnexion>Déconnexion</a></li>
END;
        }
        return $html;
    }

    public function htmlErreur()
    {
        return <<<END
    			<div class="entete4">
                <div class="alignement2">
                    <div class="d"><a href="#">Playlists</a></div>
                    <div class="d"><a href="#">Favoris</a></div>
                </div>	
				<div class="catalogue">
				<h1>Connectez-vous d'abord !</h1>
                    <div class="c2"></div>
                </div>	
            </div> 
END;
    }

    public function getPlaylist(){
        $imgPlay = $this->htmlvars['basepath'].'/web/images/playlist.png';
        $nb = $this->data[0];
        $html = <<<END
<section class="page-section portfolio" id="portfolio">
<div class="container">
        <div class="row justify-content-center">
END;

        for ($i = 0; $i < $nb; $i++){
            $html .= <<<END
<div class="col-md-6 col-lg-4 mb-5">
    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1" style="width: 200px !important;">
        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100" style="width: 200px !important;">
            <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
        </div>
        <img class="img-fluid" src=$imgPlay alt="lemon.jpg" />
    </div>
</div>
END;
        }
        $html .= <<<END
        </div>
    </div>
    </section>
END;
        return $html;
    }

    public function htmlcreerPlay()
    {
        $affichagePlay = $this->getPlaylist();
        $playlist = $this->htmlvars['playlist'];
        $favori = $this->htmlvars['favori'];
        $action = $this->container->router->pathFor('creerPlaylist');
        $cssPlay = $this->htmlvars['basepath'].'/web/css/styles.css';
        $jspath = $this->htmlvars['basepath'].'/web/javascript/playlist.js';
        $home = $this->htmlvars['home'];
        //$imgPlay = $this->htmlvars['basepath'].'/web/images/playlist.png';
        return <<< END
<div class="entete4">
    <div class="alignement2">
        <div class="d"><a href=$playlist>Playlists</a></div>
        <div class="d"><a href=$favori>Favoris</a></div>
    </div>	
	<div class="catalogue">
	    <form method="POST" action=$action id="formvalider">
            <button class="but" type="submit" style="width: fit-content">Créer une playlist</button>
        </form>
        <div class="c2">
        $affichagePlay
        
        <!-- Portfolio Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-labelledby="portfolioModal1Label" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                    <div class="modal-body text-center">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <!-- Portfolio Modal - Title-->
                                    <h1 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="portfolioModal1Label">Playlist</h1>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <div id="msg">Durée totale : 00:00</div>
                                    <!--<img class="img-fluid rounded mb-5" src="#" alt="" />-->
                                    
                                    <p class="mb-5"></p>
                                    <div class="text-center mt-4">
                                        <a class="btn btn-xl btn-outline-light" href=$home>
                                            Écouter maintenant!
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Portfolio Modal 2-->                     
        </div>
    </div>	
</div>
        <script type="text/javascript" src=$jspath defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <link rel="stylesheet" href=$cssPlay>
END;
    }

    public function htmlFavori()
    {
        $playlist = $this->htmlvars['playlist'];
        $favori = $this->htmlvars['favori'];
        $jspath = $this->htmlvars['basepath'].'/web/javascript/favori.js';
        return <<< END
			<div class="entete4">
                <div class="alignement2">
                    <div class="d"><a href=$playlist>Playlists</a></div>
                    <div class="d"><a href=$favori>Favoris</a></div>
                </div>	
				<div class="catalogue">
				<!--<h1>ici est Favoris</h1>-->
                    <div class="c2">
                        <div id="lecteur2"></div>
                    </div>
                </div>	
            </div>
        <script type="text/javascript" src="$jspath" defer></script>
END;
    }


    public function htmlCompte(){
        $affichageMusique = $this->AfficherIden();
        $playlist = $this->htmlvars['playlist'];
        $favori = $this->htmlvars['favori'];
        $action = $this->container->router->pathFor('modifMotDePasse');
        $jspath = $this->htmlvars['basepath'].'/web/javascript/CompteMotDePasse.js';
        return <<< END
			<div class="entete2">
                <div class="alignement2">
                    <div class="d"><a href=$playlist>Playlists</a></div>
                    <div class="d"><a href=$favori>Favoris</a></div>
                </div>	
				<div class="catalogue2">
				    <div id="profil">
                        <div class="c1" id="c1">
                             <div id="prompt3">
                                <span id="imgSpan">Click upload image<br /></span>
                                <input type="file" id="file" class="filepath" onchange="uploadPhoto(this)" accept="image/jpg,image/jpeg,image/png,image/PNG">
                             </div>
                             <img src="#" id="img3"  alt=""/> 
                                        
                        </div>
                        $affichageMusique
                    </div>
                    <div class="c2">
                        
                        <h2>Changer le mot de passe</h2>
                        <form method="post" action=$action id="formvalider">
                            <div class="div-bor">
                                <input type="password" name="amdp" id="amdp" placeholder="Ancien mot de passe" required><br>
                                <i class="icon-user4" id="icon-user4"></i>
                            </div>
                            <div class="div-bor">
                                <input type="password" name="mdp" id="mdp" placeholder="Nouveau mot de passe" required><br>
                                <i class="icon-user5" id="icon-user5"></i>
                            </div>
                            <button type="submit" class="but" id="submit">Modifier</button>
                        </form>                      
                    </div>
                </div>	
            </div>
        <script type="text/javascript" src=$jspath defer></script>
END;

    }

    public function htmlSuppression(){
        $playlist = $this->htmlvars['playlist'];
        $favori = $this->htmlvars['favori'];
        $action = $this->container->router->pathFor('validerSuppression');
        return <<< END
			<div class="entete2">
                <div class="alignement2">
                    <div class="d"><a href=$playlist>Playlists</a></div>
                    <div class="d"><a href=$favori>Favoris</a></div>
                </div>	
				<div class="catalogue2">
                    <form method="POST" action=$action id="formvalider">
                        <h2>Suppression compte</h2>
                        <input type="text" required="required" placeholder="IDUtilisateur" name="id" id="id">
                        <button class="but" type="submit">Valider</button>
                    </form>
                    <div class="c2">
                    </div>
                </div>	
            </div>
        <script type="text/javascript" src="" defer></script>
END;
    }

    public function htmlConnexion(){
        $inscription = $this->htmlvars['inscription'];
        $action = $this->container->router->pathFor('validerConnexion');
        $jspath = $this->htmlvars['basepath'].'/web/javascript/ConnexionMotDePasse.js';
        return <<<END
			<div class="entete4">
			<div class="contenu">
			    <div id="login">
			        <h1>Connexion</h1>
			        <form method="POST" action=$action id="formvalider">
                        <input type="text" required="required" placeholder="Identifiant" name="user" id="user">
                        <div class="div-bor">
                            <input type="password" required="required" placeholder="Mot de passe" name="password" id="password">
                            <i class="icon-user3" id="icon-user3"></i>
                        </div>
                        <button class="but" type="submit">Connexion</button>
                    </form>
                    <h3>Pas de compte? Inscrivez-vous <a id = 'ici' href=$inscription>ici</a> !</h3>
                </div>
            </div>    		
            </div> 
        <script type="text/javascript" src=$jspath defer></script>
END;

    }

    public function htmlInscription(){
        $connexion = $this->htmlvars['connexion'];
        $action = $this->container->router->pathFor('validerInscription');
        $jspath = $this->htmlvars['basepath'].'/web/javascript/InscriptionMotDePasse.js';
        return <<< END
        <div class="entete4">
                        <div id="inscrit">
                        <h1>Inscription</h1>
                            <form method="post" action="$action" id="formvalider">
                                <input type="text" name="NomUtilisateur" id="NomUtilisateur" placeholder="Nom d'utilisateur" required>  
                                <div class="div-bor">
                                    <input type="password" name="MotDePasse" id="MotDePasse" placeholder="Mot de passe" required>
                                    <i class="icon-user" id="icon-user"></i>
                                </div>
                                <div class="div-bor">
                                    <input type="password" name="MotDePasse2" id="MotDePasse2" placeholder="Confirmer le mot de passe" required>
                                    <i class="icon-user2" id="icon-user2"></i>
                                </div>
                                <button type="submit" class="but" id="submit">Inscription</button>
                                <div id="showmsg" style="display: none"></div>
                            </form>
                            <h3>Un compte? Connectez-vous <a id = 'ici' href=$connexion>ici</a> !</h3>
                        </div>		
                    </div>
        <script type="text/javascript" src=$jspath defer></script>
        END;
    }

    public function render($s, $h) {
        $this->selecteur = $s;
        $this->htmlvars = $h;
        $home = $this->htmlvars['home'];
        $accueil = $this->htmlvars['accueil'];
        $inscription = $this->htmlvars['inscription'];
        $connexion = $this->htmlvars['connexion'];
        $csspath = $this->htmlvars['basepath'].'/web/css/CSS.css';
        switch ($this->selecteur) {

            case self::COMPTE_VIEW: {
                $content = $this->htmlCompte();
                break;
            }

            case self::ERREUR_VIEW: {
                $content = $this->htmlErreur();
                break;
            }

            case self::CONNEXION_VIEW: {
                $content = $this->htmlConnexion();
                break;
            }

            case self::INSCRIPTION_VIEW: {
                $content = $this->htmlInscription();
                break;
            }

        }

        $html = <<<END
        <!DOCTYPE html>
        <html lang=fr>
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href=$csspath>
                
                <title>myJukeBox</title>
            </head>
            <body>
                <header>
                    <div class="alignement">
                        <div class="logo"></div>
                        <div class="container">
                            <div class="d"><a href=$accueil>Accueil</a></div>
                            <div class="d"><a href=$home>myJukeBox</a></div>
                            <hr>
                            <div class="d"><a href=$connexion>Connexion</a></div>
                            <div class="d"><a href=$inscription>Inscription</a></div>
                        </div>
                    </div>
                    $content
                </header>
                <footer>
                    <div class="bas">
                        <div class="contact">Nous contacter</div>
                        <span>©2020 myJukeBox | et autres régimes</span>
                    </div>
                </footer>
            </body>
        </html>
        END;
        return $html;
    }

    public function renderConnecte($s, $h) {
        $this->selecteur = $s;
        $this->htmlvars = $h;
        $home = $this->htmlvars['home'];
        $accueil = $this->htmlvars['accueil'];
        $csspath = $this->htmlvars['basepath'].'/web/css/CSS.css';
        $img = $this->htmlvars['basepath'].'/web/images/tirer.png';
        $liste = $this->VerifAdmi();
        switch ($this->selecteur) {

            case self::COMPTE_VIEW: {
                $content = $this->htmlCompte();
                break;
            }

            case self::ERREUR_VIEW: {
                $content = $this->htmlErreur();
                break;
            }

            case self::CONNEXION_VIEW: {
                $content = $this->htmlConnexion();
                break;
            }

            case self::INSCRIPTION_VIEW: {
                $content = $this->htmlInscription();
                break;
            }

            case self::SUPPRESSION_VIEW: {
                $content = $this->htmlSuppression();
                break;
            }

            case self::FAVORI_VIEW: {
                $content = $this->htmlFavori();
                break;
            }

            case self::CREERPLAYLIST_VIEW: {
                $content = $this->htmlcreerPlay();
                break;
            }

        }

        $html = <<<END
        <!DOCTYPE html>
        <html lang=fr>
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href=$csspath>
                <title>myJukeBox</title>
            </head>
            <body>
                <header>
                    <div class="alignement">
                        <div class="logo"></div>
                        <div class="container">
                            <div class="d"><a href=$accueil>Accueil</a></div>
                            <div class="d"><a href=$home>myJukeBox</a></div>
                            <hr>
                            <div class="d">
                                <li class="drop-down">
                                    <a href="#">Profil <img src=$img alt="tirer.png"></a> 
                                    <ul class="drop-down-content">
                                        $liste
                                    </ul>
                                </li>
                            </div>
                        </div>
                    </div>
                    $content
                </header>
                <footer>
                    <div class="bas">
                        <div class="contact">Nous contacter</div>
                        <span>©2020 myJukeBox | et autres régimes</span>
                    </div>
                </footer>
            </body>
        </html>
        END;
        return $html;
    }



}