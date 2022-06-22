
window.onload = () => {

    let musique;
    let fileencours;
    let duree = document.getElementById("duree");
    let currentTime = 0;
    let audio = new Audio("http://localhost:3000/stream");
    let imagemusique = document.getElementById("imagemusique");
    let titrealbum = document.getElementById("titrealbum");
    let artiste = document.getElementById("artistelecteur");
    let wrapper = document.getElementById("wrapper");
    let role;
    admiVerif();

    audio.oncanplaythrough = () => {
        audio.play();
    }

    audio.addEventListener('timeupdate', getInfos);
    //setInterval(chrono, 1000);
    setInterval(getFile, 5000);

    function chrono() {
        currentTime++;
    }

    function supprimer(e) {
        let cible = e.target.id;
        cible = cible.split('-');
        if (cible[0] == "ordre") {
            supprimerFile(cible[1]);
        }
    }

    function afficherInfos() {
        if (currentTime > musique.Duree) {
            currentTime = 0;
        }
        duree.innerHTML = "Durée : "+convertirTime(musique.Duree);
        imagemusique.src = musique.lienimg;
        titrealbum.innerHTML = musique.Titre + "-" + musique.NomAlbum;
        artiste.innerHTML = musique.Artiste;
        wrapper.style.backgroundImage = 'url(' + musique.lienimg + ')';
        wrapper.style.backgroundSize = 'cover';
        wrapper.style.backgroundPosition = 'center';
    }

    function afficherFile() {
        let fileaffichage = document.getElementsByClassName('listMusique')[0];
        let numero;
        let button
        fileaffichage.innerHTML = "";
        for (let i = 1; i < fileencours.length; i++) {
            if (i == 1) {
                numero = "Prochain Morceaux";
            } else {
                numero = i;
            }
            if (role == 2) {
                let ordre = fileencours[i].ordre;
                button = document.createElement("button");
                button.setAttribute("class", "bout");
                button.setAttribute("id", "ordre-" + ordre);
            }
            fileaffichage.innerHTML += numero + " - " + fileencours[i].Titre + " - " + fileencours[i].Artiste + " ";
            if (button != undefined) {
                fileaffichage.appendChild(button);
            }
            fileaffichage.innerHTML += "<br>";
        }
        fileaffichage.onclick = (e) => {
            supprimer(e);
        }
    }

    function getInfos() {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (this.readyState === 4) {
                var rep = this.responseText;
                var tab = rep.split("</html>") //recupere la chaine après la page de retour.
                musique = JSON.parse(tab[1]);
                afficherInfos();
            }
        };
        request.open('GET', 'web/script/insertion.php', false);
        request.send();
    }

    function getFile() {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (this.readyState === 4) {
                var rep = this.responseText;
                var tab = rep.split("</html>") //recupere la chaine après la page de retour.
                fileencours = JSON.parse(tab[1]);
                afficherFile();
            }
        };
        request.open('GET', 'web/script/affichagefile.php', false);
        request.send();
    }

    function admiVerif() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                if (xmlhttp.responseText == '2') {
                    role = 2;
                }
            }
        }
        xmlhttp.open("GET", "web/script/admiVerif.php", true);
        xmlhttp.send();
    }

    function supprimerFile(o) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if(this.readyState == 4) {
                console.log("Suppression ordre "+o+" réussi.");
            }
        }
        request.open("GET", "web/script/supprimerFile.php?no="+o, true);
        request.send();
    }

    function convertirTime(time){
        let totalTime = time;
        let minute2 = totalTime / 60;
        let minutes2 = parseInt(minute2);
        if (minutes2 < 10) {
            minutes2 = "0" + minutes2;
        }
        let second2 = totalTime % 60;
        let seconds2 = Math.round(second2);
        if (seconds2 < 10) {
            seconds2 = "0" + seconds2;
        }
        return minutes2+":"+seconds2;
    }


}