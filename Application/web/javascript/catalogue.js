let musiques;

getMusiquesInitiales();

//fonction qui va faire une requete pour récupérer les musiques disponibles
function getMusiquesInitiales(){
    let request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState === 4) {
            let rep = this.responseText;
            let tab = rep.split("</html>");
            musiques = JSON.parse(tab[1]);
            creerCatalogue();
        }
    };
    request.open('GET','web/script/catalogue.php', false);
    request.send();
}

//fonction qui va afficher les musiques dans une div de la page web
function creerCatalogue(){
    let lec = document.getElementById("table-scroll");
    let tbl = document.createElement("table");
    lec.appendChild(tbl);
    tbl.style.width = '100%';
    tbl.setAttribute('class', 'catalogueMusiques');
    let thead = document.createElement('thead');
    let trH = document.createElement('tr');
    let th0 = document.createElement('th');
    th0.innerText="Ajouter";
    th0.className ="catalogueHead";
    trH.appendChild(th0);
    let th1 = document.createElement('th');
    th1.innerText="Musique";
    th1.className ="catalogueHead";
    trH.appendChild(th1);
    let th2 = document.createElement('th');
    th2.innerText="Artiste";
    th2.className ="catalogueHead";
    trH.appendChild(th2);
    let th3 = document.createElement('th');
    th3.innerText="Album";
    th3.className ="catalogueHead";
    trH.appendChild(th3);
    let th4 = document.createElement('th');
    th4.innerText="Genre";
    th4.className ="catalogueHead";
    trH.appendChild(th4);
    let th5 = document.createElement('th');
    th5.innerText="Durée";
    th5.className ="catalogueHead";
    let tbody = document.createElement('tbody');
    tbody.id='bodyCatalogue';
    trH.appendChild(th5);
    thead.appendChild(trH);
    tbl.appendChild(thead);
    tbl.appendChild(tbody);
    lec.appendChild(tbl);
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

function remplirCatalogue(){
    let tbody = document.getElementById('bodyCatalogue');
    let row;
    let c1,c2,c3,c4,c5,c6,elem1,elem2,elem3,elem4,elem5,elem6;
    for(let m in musiques){
        row=tbody.insertRow();
        c1=row.insertCell();
        c2=row.insertCell();
        c3=row.insertCell();
        c4=row.insertCell();
        c5=row.insertCell();
        c6=row.insertCell();
        elem1 = document.createElement("button");
        elem1.id="bouton"+m;
        elem1.classList.add("add");
        elem1.onclick = () => {
            ajouterFile(musiques[m].IDMusique);
        };
        elem2 = document.createTextNode(musiques[m].Titre);
        elem3 = document.createTextNode(musiques[m].Artiste);
        elem4 = document.createTextNode(musiques[m].NomAlbum);
        elem5 = document.createTextNode(musiques[m].Genre);
        elem6 = document.createTextNode(convertirTime(musiques[m].Duree));
        c1.appendChild(elem1);
        c2.appendChild(elem2);
        c3.appendChild(elem3);
        c4.appendChild(elem4);
        c5.appendChild(elem5);
        c6.appendChild(elem6);
    }
}

//fonction qui ajoute dans la file
function ajouterFile(musique){
    let credit;
    credit=reduireCredit();
    if(credit>0) {
        let request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (this.readyState === 4) {

            }
        };
        request.open('GET', 'ajout/' + musique);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.send();
    }else{
        let lec = document.querySelector(".lecteur");
        let elem1 = document.createElement("p");
        elem1.innerText='Vous n\'avez plus de crédits, merci de patienter avant d\'ajouter une nouvelle musique';
        let tab = document.getElementsByClassName("lecteur")[0].childNodes[10];
        lec.insertBefore(elem1,tab);
        setTimeout(()=>{elem1.remove()},2000);
    }
}

function reduireCredit(){
    let res;
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            resp=this.responseText;
            respSplit=resp.split("</html>")[1];
            if(!isNaN(respSplit)){
                res=respSplit;
            }else{
            let tab =respSplit;
            res2 = JSON.parse(tab)[0];
            res=res2.credits;
            }
        }
    };
    xhr.open('GET','web/script/reduireCredit.php', false);
    xhr.send();
    return res;
}
function ajoutAutomatiqueCredits(){
    setInterval(ajouterCredit, 30000);
}
ajoutAutomatiqueCredits()

function ajouterCredit(){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
        }
    };
    xhr.open('GET','web/script/ajouterCredit.php', false);
    xhr.send();
}


function chercherMusique(){
    let input = document.getElementById('searchbar').value

    if(input.length>=3){
        let checkGenre = document.getElementById('genre').checked
        let checkArtiste = document.getElementById('artiste').checked
        let checkAlbum = document.getElementById('album').checked
        let checkTitre = document.getElementById('titre').checked
        input=input.toLowerCase();
        if(checkGenre===true){
            getMusiquesGenre(input);
        }
        else{
            if(checkArtiste===true){
                getMusiquesArtiste(input);
            }
            else{
                if(checkAlbum===true){
                    getMusiquesAlbum(input);
                }else{
                    if(checkTitre===true){
                        getMusiquesTitre(input);
                    }
                }
            }

        }
    }
}

function getMusiquesGenre(input){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            let rep = this.responseText;
            let tab = rep.split("</html>");
            musiques = JSON.parse(tab[1]);
            viderCatalogue();
            remplirCatalogue();
        }
    };
    xhr.open('GET','web/script/rechercheGenre.php?input='+input, false);
    xhr.send();
}

function getMusiquesArtiste(input){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            let rep = this.responseText;
            let tab = rep.split("</html>");
            musiques = JSON.parse(tab[1]);
            viderCatalogue();
            remplirCatalogue();
        }
    };
    xhr.open('GET','web/script/rechercheArtiste.php?input='+input, false);
    xhr.send();
}

function getMusiquesAlbum(input){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            let rep = this.responseText;
            let tab = rep.split("</html>");
            musiques = JSON.parse(tab[1]);
            viderCatalogue();
            remplirCatalogue();
        }
    };
    xhr.open('GET','web/script/rechercheAlbum.php?input='+input, false);
    xhr.send();
}

function getMusiquesTitre(input){
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (this.readyState === 4) {
            let rep = this.responseText;
            let tab = rep.split("</html>");
            musiques = JSON.parse(tab[1]);
            viderCatalogue();
            remplirCatalogue();
        }
    };
    xhr.open('GET','web/script/rechercheTitre.php?input='+input, false);
    xhr.send();
}

function supprimerCatalogue(){
    var elem = document.getElementsByClassName("catalogueMusiques");
    elem[0].remove(); //.deleteRow(0);
}

function viderCatalogue(){
    var old_tbody =  document.getElementById('bodyCatalogue');
    var new_tbody = document.createElement('tbody');
    new_tbody.id='bodyCatalogue';
    old_tbody.parentNode.replaceChild(new_tbody, old_tbody);
}

creerSuggestion();
function creerSuggestion(){
    let lec = document.querySelector(".lecteur");
    let tbl = document.createElement("table");
    tbl.style.width = '100%';
    tbl.setAttribute('class', 'suggestions');
    let thead = document.createElement('thead');
    let trH = document.createElement('tr');
    let th0 = document.createElement('th');
    th0.innerText="Ajouter";
    trH.appendChild(th0);
    let th1 = document.createElement('th');
    th1.innerText="Musique";
    trH.appendChild(th1);
    let th2 = document.createElement('th');
    th2.innerText="Artiste";
    trH.appendChild(th2);
    let th3 = document.createElement('th');
    th3.innerText="Album";
    trH.appendChild(th3);
    let th4 = document.createElement('th');
    th4.innerText="Genre";
    trH.appendChild(th4);
    let th5 = document.createElement('th');
    th5.innerText="Durée";
    let tbody = document.createElement('tbody');
    tbody.id = 'bodySuggestion';
    trH.appendChild(th5);
    thead.appendChild(trH);
    tbl.appendChild(thead);
    tbl.appendChild(tbody);
    let h2=document.getElementsByClassName("lecteur")[0].childNodes[5];
    lec.insertBefore(tbl,h2);
}

let musiquesSuggestion;
getMusiquesSuggestion();
function remplirSuggestion(){
    let tbody = document.getElementById('bodySuggestion');
    let row;
    let c1,c2,c3,c4,c5,c6,elem1,elem2,elem3,elem4,elem5,elem6,aime,play;
    let array = localStorage.getItem('infos');
    let array2 = localStorage.getItem('infos2');
    //console.log(array);
    let infos = JSON.parse(array)??[];
    let infos2 = JSON.parse(array2)??[];

    for(let m in musiquesSuggestion){
        row=tbody.insertRow();
        c1=row.insertCell();
        c2=row.insertCell();
        c3=row.insertCell();
        c4=row.insertCell();
        c5=row.insertCell();
        c6=row.insertCell();
        elem1 = document.createElement("button");
        elem1.id="bouton"+m;
        elem1.classList.add("add");

        aime = document.createElement("button");
        aime.id="aime"+m;
        aime.classList.add("aime");
        aime.onclick = () => {
            //console.log(array);
            //console.log(musiquesSuggestion[m].Titre);
            infos.push({
                IDMusique:musiquesSuggestion[m].IDMusique,
                Titre:musiquesSuggestion[m].Titre,
                Artiste:musiquesSuggestion[m].Artiste,
                NomAlbum:musiquesSuggestion[m].NomAlbum,
                Genre:musiquesSuggestion[m].Genre,
                Duree:musiquesSuggestion[m].Duree,
                lienimg:musiquesSuggestion[m].lienimg,
            })
            localStorage.setItem('infos', JSON.stringify(infos));
        }

        play = document.createElement("button");
        play.id="play"+m;
        play.classList.add("play");
        play.onclick = () => {
            //console.log(array2);
            //console.log(musiquesSuggestion[m].Titre);
            infos2.push({
                IDMusique:musiquesSuggestion[m].IDMusique,
                Titre:musiquesSuggestion[m].Titre,
                Artiste:musiquesSuggestion[m].Artiste,
                NomAlbum:musiquesSuggestion[m].NomAlbum,
                Genre:musiquesSuggestion[m].Genre,
                Duree:musiquesSuggestion[m].Duree,
                lienimg:musiquesSuggestion[m].lienimg,
            })
            localStorage.setItem('infos2', JSON.stringify(infos2));
        }

        elem1.onclick = () => {
            ajouterFile(musiquesSuggestion[m].IDMusique);
        };
        elem2 = document.createTextNode(musiquesSuggestion[m].Titre);
        elem3 = document.createTextNode(musiquesSuggestion[m].Artiste);
        elem4 = document.createTextNode(musiquesSuggestion[m].NomAlbum);
        elem5 = document.createTextNode(musiquesSuggestion[m].Genre);
        elem6 = document.createTextNode(convertirTime(musiquesSuggestion[m].Duree));
        c1.appendChild(elem1);
        c2.appendChild(elem2);
        c3.appendChild(elem3);
        c4.appendChild(elem4);
        c5.appendChild(elem5);
        c6.appendChild(elem6);
        c1.appendChild(aime);
        c1.appendChild(play);
    }
}


function getMusiquesSuggestion(){
    let request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (this.readyState === 4) {
            let rep = this.responseText;
            let tab = rep.split("</html>");
            musiquesSuggestion = JSON.parse(tab[1]);
            remplirSuggestion();
        }
    };
    request.open('GET','web/script/suggestion.php', false);
    request.send();
}