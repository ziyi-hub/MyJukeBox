
let infos = []
let load = function () {
    let tmp = JSON.parse(localStorage.getItem('infos'));
    if (tmp){
        infos = tmp;
    }
}


load()
//console.log(infos)


function completerCatalogue(){
    for(let m in infos) {
        //console.log(infos[m].Titre);
        let cat = document.querySelector("#lecteur2");
        let divprincipale = document.createElement("div");
        divprincipale.setAttribute("class", "musique");
        divprincipale.setAttribute("style", "width: 100%");
        let imglogo = document.createElement("img");
        imglogo.setAttribute("src", infos[m].lienimg);
        imglogo.setAttribute("width", '50px');
        imglogo.setAttribute("height", '50px');
        let divinfo = document.createElement("div");
        divinfo.setAttribute("class", "info");
        divinfo.appendChild(document.createTextNode(infos[m].Titre + " - " + infos[m].Artiste));

        let btnSupp = document.createElement("button")
        btnSupp.id="bouton"+m;
        btnSupp.classList.add("bout");

        btnSupp.onclick = (ev) => {
            var node = ev.target.parentNode
            document.querySelector("#lecteur2").removeChild(node)
            console.log(ev.target.id.split("n")[1])
            let tmp = JSON.parse(localStorage.getItem('infos'));
            tmp.splice(ev.target.id.split("n")[1], 1)
            console.log(tmp)
            localStorage.removeItem('infos');
            localStorage.setItem('infos', JSON.stringify(tmp));
            console.log(JSON.parse(localStorage.getItem('infos')))
        }

        divprincipale.appendChild(imglogo);
        divprincipale.appendChild(divinfo);
        divprincipale.appendChild(btnSupp);
        cat.appendChild(divprincipale);
    }
}

completerCatalogue()