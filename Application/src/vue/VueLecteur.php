<?php

namespace myjukebox\vue;

class VueLecteur
{
    private $data;
    private $htmlvars;

    public function __construct(array $d)
    {
        $this->data = $d;
    }

    private function VerifAdmi() {
        $deconnexion = $this->htmlvars['deconnexion'];
        $monCompte = $this->htmlvars['monCompte'];
        $suppression = $this->htmlvars['suppression'];
        if ($_SESSION['profile']['role_id'] === 2){
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

    public function render($h)
    {
        $this->htmlvars = $h;
        $lienjs = $this->htmlvars['basepath'].'/web/javascript/lecteur.js';
        $liencataloguejs = $this->htmlvars['basepath'].'/web/javascript/catalogue.js';
        $liencss = $this->htmlvars['basepath'].'/web/css/CSS.css';
        $home = $this->htmlvars['home'];
        $accueil = $this->htmlvars['accueil'];
        $inscription = $this->htmlvars['inscription'];
        $connexion = $this->htmlvars['connexion'];
        $html = <<<END
<!DOCTYPE html>
<html lang=fr>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href=$liencss>
	<script type="text/javascript" src=$liencataloguejs defer></script>
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

	<div class="entete">
		<div class="alignement2">
			<!--<div class="d"><a href="#">Catalogue</a></div>-->
			<div class="d"><a href="#">Playlists</a></div>
			<div class="d"><a href="#">Favoris</a></div>
		</div>
		<div class="catalogue">
			<!--<input id="musiqueencours" size="50" value='' type="hidden"/>-->
			<div class = 'container2'>
                <div class="lecteur">
                   <h2>Suggestions</h2>
                    <!--<h2>Catalogue</h2>-->
                    <h2>Catalogue</h2>
                    <div class="radio">
                        <input id="searchbar" onkeyup="chercherMusique()" type="text"
                        name="search" placeholder="Chercher musique">
                        <div class="type">
                        <label for=""></label>
                        <label for="genre">Genre</label>
                        <input type="radio" id="genre" name="filtre" value="genre">
                         <label for="artiste">Artiste</label>
                        <input type="radio" id="artiste" name="filtre" value="artiste">
                         <label for="titre">Titre</label>
                         <input type="radio" id="titre" name="filtre" value="titre">
                         <label for="album">Album</label>
                         <input type="radio" id="album" name="filtre" value="album">
                         </div>
                    </div>
                    <div id="table-wrapper">
                        <div id="table-scroll">
                        </div>
                    </div>
                </div>
                <div class="wrapper" id='wrapper' style="background-image: url("")">
                    <div class="itemCatalogue">
                        <img id="imagemusique" src="">
                        <div>
                            <div class="informations">
                                <strong><p id="titrealbum">Titre-Album</p></strong>
                                <p id="artistelecteur">Artiste</p>
                                <p id="duree">Durée: 00:00</p>
                            </div>
                        </div>                   
                        <script type="text/javascript" src=$lienjs></script>
                    </div>  
                    <div class="listMusique">Il n'y a rien ici... Etrange...</div>
                </div>               
			</div>
		</div>
	</div>
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


    public function renderConnecte($h)
    {
        $this->htmlvars = $h;
        $lienjs = $this->htmlvars['basepath'].'/web/javascript/lecteur.js';
        $liencataloguejs = $this->htmlvars['basepath'].'/web/javascript/catalogue.js';
        $lienhistoriquejs = $this->htmlvars['basepath'].'/web/javascript/historique.js';
        $liencss = $this->htmlvars['basepath'].'/web/css/CSS.css';
        $home = $this->htmlvars['home'];
        $accueil = $this->htmlvars['accueil'];
        $img = $this->htmlvars['basepath'].'/web/images/tirer.png';
        $playlist = $this->htmlvars['playlist'];
        $favori = $this->htmlvars['favori'];
        $liste = $this->VerifAdmi();
        $html = <<<END
<!DOCTYPE html>
<html lang=fr>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href=$liencss>
	<script type="text/javascript" src=$liencataloguejs defer></script>
	<script type="text/javascript" src=$lienhistoriquejs defer></script>
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

	<div class="entete">
		<div class="alignement2">
			<!--<div class="d"><a href="#">Catalogue</a></div>-->
			<div class="d"><a href=$playlist>Playlists</a></div>
			<div class="d"><a href=$favori>Favoris</a></div>
		    <div class="d" id="historique"><a href="#">Historique</a></div>

		</div>
		<div class="catalogue">
			<!--<input id="musiqueencours" size="50" value='' type="hidden"/>-->
			<div class = 'container2'>
                <div class="lecteur">
                    <h2>Suggestions</h2>
                    <!--<h2>Catalogue</h2>-->
                    <h2>Catalogue</h2>
                    <div class="radio">
                        <input id="searchbar" onkeyup="chercherMusique()" type="text"
                        name="search" placeholder="Chercher musique">
                        <div class="type">
                        <label for=""></label>
                        <label for="genre">Genre</label>
                        <input type="radio" id="genre" name="filtre" value="genre">
                         <label for="artiste">Artiste</label>
                        <input type="radio" id="artiste" name="filtre" value="artiste">
                         <label for="titre">Titre</label>
                         <input type="radio" id="titre" name="filtre" value="titre">
                         <label for="album">Album</label>
                         <input type="radio" id="album" name="filtre" value="album">
                         </div>
                    </div>
                 
                    <div id="table-wrapper">
                        <div id="table-scroll">
                        </div>
                    </div>
                </div>
                <div class="wrapper" id='wrapper' style="background-image: url("")">
                    <div class="itemCatalogue">
                        <img id="imagemusique" src="">
                        <div>
                            <div class="informations">
                                <strong><p id="titrealbum">Titre-Album</p></strong>
                                <p id="artistelecteur">Artiste</p>
                                <p id="duree">Durée: 00:00</p>
                            </div>
                        </div>                   
                        <script type="text/javascript" src=$lienjs></script>
                    </div>  
                    <div class="listMusique">Il n'y a rien ici... Etrange...</div>
                </div>               
			</div>
		</div>
	</div>
	<div id="lightbox">
            <div id='lightbox_content'>
                <h4>Historique :</h4>
                <ul id="lightbox_liste">
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                    <li>test</li>
                </ul>
                <p><em>Cliquez sur la boite pour la fermer</em></p>
            </div>
    </div>
  
  
  
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