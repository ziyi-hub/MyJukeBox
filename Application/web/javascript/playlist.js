
var infos = []
let load = function () {
    let tmp = JSON.parse(localStorage.getItem('infos2'));
    if (tmp){
        infos = tmp;
    }
}

load()
//console.log(infos)

function completerCatalogue(){
    let duree = 0
    for(let m in infos) {
        //console.log(infos[m].Titre);
        duree += infos[m].Duree
        let cat = document.querySelector('.col-lg-8').getElementsByTagName("p").item(0);
        let divprincipale = document.createElement("div");
        divprincipale.setAttribute("class", "musique");
        divprincipale.setAttribute("style", "width: 100%");
        let imglogo = document.createElement("img");
        imglogo.setAttribute("src", infos[m].lienimg);
        imglogo.setAttribute("width", '50px');
        imglogo.setAttribute("height", '50px');
        let divinfo = document.createElement("div");
        divinfo.setAttribute("class", "info");
        divinfo.appendChild(document.createTextNode(infos[m].Titre + " - " + infos[m].Artiste + " - " + convertirTime(infos[m].Duree)));

        let btnSupp = document.createElement("button")
        btnSupp.id="bouton"+m;
        btnSupp.classList.add("bout");

        btnSupp.onclick = (ev) => {
            var node = ev.target.parentNode
            console.log(document.querySelector('.col-lg-8').getElementsByTagName("p").item(0))
            document.querySelector('.col-lg-8').getElementsByTagName("p").item(0).removeChild(node)
            let tmp = JSON.parse(localStorage.getItem('infos2'));
            tmp.splice(ev.target.id.split("n")[1], 1)
            console.log(tmp)
            localStorage.removeItem('infos2');
            localStorage.setItem('infos2', JSON.stringify(tmp));
            console.log(JSON.parse(localStorage.getItem('infos2')))
        }

        divprincipale.appendChild(imglogo);
        divprincipale.appendChild(divinfo);
        divprincipale.appendChild(btnSupp);
        cat.appendChild(divprincipale);
    }
    document.querySelector("#msg").innerHTML = "Durée totale : "
    document.querySelector("#msg").innerHTML += convertirTime(duree)
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

completerCatalogue()


document.querySelector('.mb-5').addEventListener('click', ()=>{
    document.querySelector('.mb-5').innerHTML = `
    <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#portfolioModal1" style="width: 200px !important;">
        <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100" style="width: 200px !important;">
            <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
        </div>
        <img class="img-fluid" src=../Application/web/images/playlist.png alt="playlist.png" />
    </div>
`
        //console.log(document.querySelector('.col-lg-8').getElementsByTagName("p").item(0).textContent)
})


