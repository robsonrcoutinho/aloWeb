/**
 * Created by Wilder on 09/03/2017.
 */
;
window.onload = function () {
    var btnEnviar = document.getElementById("btn-enviar");

    mensagens = document.getElementById("mensagens");


    btnEnviar.addEventListener("click", function () {
      enviar();
        buscar();
        return false;
    });

};


function enviar() {
    var mensagem = document.getElementById("mensagem");
    var formData = new FormData();
    if (mensagem.value !== "") {
        formData.append("mensagem", mensagem.value);
        formData.append("_token", document.getElementsByName("_token").item(0).value);
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState == 4 && xhttp.status == 200) {
                mensagem.value = "";
            }
        };
        xhttp.open("POST", "salvar", true);
        xhttp.send(formData);
    }
}


/*function executarGet(url, funcao) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            funcao(this);
        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}

function executarPost(url, funcao) {
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var text = this.responseText
            //funcao(this);
            var t = "";
            for (i = 0; i > text.length; i++)
                if (!document.getElementById("chat_" + text[i].id)) {
                    //mensagens.innerHTML
                    //mensagens.appendChild()
                    t += "<li>text[i].usuario.name+' '+text[i].created_at<br />text[i].mensagem</li>"
                }
            // mensagens.innerHTML=t+mensagens.innerHTML;
            mensagens.insertAdjacentHTML('afterend', t);

        }
    };
    xhttp.open("GET", url, true);
    xhttp.send();
}*/

function buscar() {
    var xhttp;
    xhttp = new XMLHttpRequest();
    alert(xhttp);
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            alert(xhttp.responseText);
            var json = JSON.parse(xhttp.responseText);
            var retorno = "";
            for (var i=json.length-1;i>=0; i--) {
                retorno+="<li id=chat_"+json[i].id+">"+json[i].usuario.name+" "+json[i].created_at+"<br/>"+json[i].mensagem+"<br/></li>";
                /*if (!document.getElementById("chat_" + json[i].id)) {
                   var liMensagem =document.createElement("li");
                    liMensagem.setAttribute("id","chat_"+json[i].id);
                    liMensagem.set

                    //alert(json[i].mensagem);
                }*/
                //alert(json);
            }
            mensagens.innerHTML=retorno;
        }
    };
        xhttp.open("GET", "listar", true);
        xhttp.send();
}
