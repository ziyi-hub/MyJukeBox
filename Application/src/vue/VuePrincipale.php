<?php


namespace myjukebox\vue;


class VuePrincipale
{
    private $data;
    private $htmlvars;

    public function __construct(array $d)
    {
        $this->data = $d;
    }

    public function render($h)
    {
        $this->htmlvars = $h;
        //$content = $this->getAccueil();
        $liencss = $this->htmlvars['basepath'] . '/web/css/CSS.css';
        //$background = $this->htmlvars['basepath'] . '/web/images/index.png';
        $etoile = $this->htmlvars['basepath'] . '/web/images/etoile.png';
        $home = $this->htmlvars['home'];
        $accueil = $this->htmlvars['accueil'];
        $inscription = $this->htmlvars['inscription'];
        $connexion = $this->htmlvars['connexion'];
        //var_dump($musique);
        $html = <<<END
<!DOCTYPE html>
<html lang=fr>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href=$liencss>
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
			
			<div class="entete3">
				<h1><div class = "Welcome">
				    <div class="container3 d-flex align-items-center flex-column">
                <!-- Masthead Avatar Image-->
                        <!--<img class="masthead-avatar mb-5" src="#" alt="index.png" />-->
                <!-- Masthead Heading-->
                        <h1 class="masthead-heading text-uppercase mb-0">Welcome to myJukeBox</h1>
                <!-- Icon Divider-->
                        <div class="divider-custom divider-light">
                            <div class="divider-custom-line"></div>
                            <div class="divider-custom-icon"><img src=$etoile alt="etoile.png"></div>
                            <div class="divider-custom-line"></div>
                        </div>
                <!-- Masthead Subheading-->
                        <p class="masthead-subheading font-weight-light mb-0">Offrez-vous le Premium! <br>Profiter de l'essai gratuit</p>
                    </div>
                </div></h1>
			</div>
		</header>

			
		
		<footer>
			<div class="bas">
				<div class="contact">Nous contacter</div>
				<span>©2020 myJukeBox | et autres régimes</span>
			</div>

		</footer>
		<script type="text/javascript" src=""></script>
	</body>
</html>
END;
        return $html;
    }

}