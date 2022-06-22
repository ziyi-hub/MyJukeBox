# S3B_S06_DAVIDENKO_LAMPERT_WANG_WOJCIAK


<h1>Pour utiliser l'application sur une machine personelle</h2>

<ol>
  <li>Lancer le dossier application avec un serveur web type apache</li>
  <li>Mettre en place la base de donnée (script_bdd.sql) sur votre serveur web favoris</li>
  <li>Créer un fichier conf.ini dans le répertoire src/conf. Le fichier se présente comme suivant:</li>
          <code>
              driver=mysql
              username=*Le nom d'utilisateur de la base*
              password=*Le mot de passe de la base*
              host=localhost
              database=myjukebox (ou un autre nom selon ce qui a été créé)
          </code>
   <li>Depuis le répertoire web/javascript lancer la commande <code>node serveur.js</code> pour lancer le serveur</li>
   <li>Vous pouvez maitenant profiter de l'application</li>
</ol>

<h1>Pour ajouter des musiques</h1>
<p>Vous pouvez également ajouter des musiques en ajoutant le mp3 dans le dossier web/musiques et l'image correspondante dans le dossier web/image. Il faudra par la suite ajouter votre musique 
dans la table musique de la base de donnéees</p>

<a href="http://thibaut1308.alwaysdata.net/">Lien du site</a>
