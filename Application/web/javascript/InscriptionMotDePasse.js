document.querySelector('#NomUtilisateur').addEventListener('mouseout', ajax);
oeil();

function oeil(){
    var icon=document.getElementById("icon-user");
    var pass=document.getElementById("MotDePasse")
    var affichage = true;
    icon.onclick=function(){
        if (affichage === true){
            pass.type="text"
        }else{
            pass.type='password'
        }
        affichage = !affichage
    }

    var icon2=document.getElementById("icon-user2");
    var pass2=document.getElementById("MotDePasse2")
    var affichage2 = true;
    icon2.onclick=function(){
        if (affichage2 === true){
            pass2.type="text"
        }else{
            pass2.type='password'
        }
        affichage2 = !affichage2
    }
}

function ajax(){
    var str = document.getElementById("NomUtilisateur").value;
    if (str.length === 0){
        document.getElementById("showmsg").innerHTML = "Veuillez renseigner tous les champs".fontcolor('red');
    }else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200){
                console.log(this.responseText.split('</html>')[1]);
                document.getElementById('showmsg').style.display = "block";
                document.getElementById('showmsg').style.textAlign = 'center';
                document.getElementById('showmsg').innerHTML = this.responseText.split('</html>')[1];
            }
        }
        xmlhttp.open('GET',"web/script/inscription.php?NomUtilisateur=" + str, true);
        xmlhttp.send();
    }
}