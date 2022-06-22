var visible = false;
var historique;

getHistorique();

//Rend la lightbox visible
function show(){
    document.querySelector('#lightbox').style.display="block"
    visible=true
}

//cache la lightbox
function hide(){
    document.querySelector('#lightbox').style.display="none"
    visible=false
}

//Ferme ou ouvre la lightbox si on appuie sur le lien historique et affiche l historique si on ouvre la lightbox
document.querySelector("#historique").addEventListener("click",()=>{
    if(visible){
        hide()
    }else {
        show()
        afficherHistorique()
    }
})

//Ferme  la lightbox si on appuie dessus
document.querySelector("#lightbox").addEventListener("click",()=>{
    if(visible){
        hide()
    }
})


//Requete pour recuperer l historique
function getHistorique() {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function (){
        if(this.readyState===4){
            let rep = this.responseText;
            let tab = rep.split("</html>");
            historique = JSON.parse(tab[1]);
        }
    };
    request.open('GET','web/script/historique.php',false);
    request.send();
}

//Fonction qui affiche dans la lightbox le nom des musiques contenues dans l historique
function afficherHistorique(){
    //appel a la fonction pour recuperer le nom des 10 dernieres musiques jouees
    getHistorique()
    //selection de la liste
    let lightbox_ul = document.querySelector('#lightbox_liste');
    //on supprime tout les elements present dans la liste
    while(lightbox_ul.lastChild){
        lightbox_ul.removeChild(lightbox_ul.lastChild)
    }

    if (historique.length>0){
        //pour chaque element on ajoute le titre de l element dans la liste
        historique.forEach(element=>{
            let li = document.createElement('li')
            li.appendChild(document.createTextNode(`-${element.Titre}`))
            lightbox_ul.appendChild(li)
        })

    }
}

