/**
 * Created by Wilder on 09/03/2017.
 */
;
window.onload = function () {                               //Execu��o fun��o no carregamento da janela
    mensagens = document.getElementById("mensagens");       //Guarda elemento com id "mensagens" em vari�vel
    mensagem = document.getElementById("mensagem");         //Busca elemento com id "mensagem" e guarda em vari�vel
    var btnEnviar = document.getElementById("btn-enviar");  //Busca elemento com id "btn-enviar" e guarda em vari�vel
    btnEnviar.onclick = function () {                       //Define fun��o para onclick
        enviar();                                           //Fun��o enviar
        return false;                                       //Retorna false
    };
    document.addEventListener("keypress", function (e) {    //Adicionando evento de precionar bot�o
        if (e.which == 13) {                                //Se precionou enter
            enviar();                                       //Executa m�todo enviar
        }
    }, false);
    setInterval(buscar, 1000);                              //Coloca fun��o buscar em loop com intervalo de 1 segundo
};

function enviar() {                                                 //Fun��o respons�vel por fazer envio de mensagem do chat
    var formData = new FormData();                                  //Cria FormData para envio de dados via m�todo POST
    if (mensagem.value.trim() !== "") {                             //Verifica se existe mensagem a ser enviada
        formData.append("mensagem", mensagem.value);                //Guarda valor da mensagem em FormData
        //Guarda o valor do elemento token em FormData
        formData.append("_token", document.getElementsByName("_token").item(0).value);
        var xhttp = criarXHTTP();                                   //Cria objeto request
        xhttp.onreadystatechange = function () {                    //Atribui fun��o para evento de mudan�a
            if (xhttp.readyState == 4 && xhttp.status == 200) {     //Se solicita��o foi respondida com sucesso
                mensagem.value = "";                                //Limpa texto de mensagem
            }
        };
        xhttp.open("POST", "salvar", true);                         //Abre a chamada passando o m�todo POST, a url e true para opera��o assincrona
        xhttp.send(formData);                                       //Executa requisi��o passando FormData com dados
    } else {                                                        //Se campo mensagem estiver vazio
        alert("\u00c9 preciso preencher a mensagem a ser enviada.");//Apresenta mensagem
    }
    mensagem.focus();                                               //Passa foco para elemento mensagem
}

function buscar() {                                                     //M�todo que busca lista de mensagens do chat
    var xhttp = criarXHTTP();                                           //Cria objeto request
    xhttp.onreadystatechange = function () {                            //Atribui fun��o para evento de mudan�a
        if (xhttp.readyState == 4 && xhttp.status == 200) {             //Se solicita��o foi respondida com sucesso
            var json = JSON.parse(xhttp.responseText);                  //Pega a resposta e converte em json
            for (var i = 0; i < json.length; i++) {                     //Percorre lista de json
                if (!document.getElementById("chat_" + json[i].id)) {   //Se n�o existir no documento elemento com id correspondente ao do objeto
                    var liMensagem = document.createElement("li");      //Cria elemento li
                    liMensagem.setAttribute("id", "chat_" + json[i].id);//Adiciona atributo id ao elemento li
                    //Cria n� texto concatenando o nome do usu�rio e a data de cria��o da mensagem do chat e adiciona ao elemento li
                    liMensagem.appendChild(document.createTextNode(json[i].name.concat(" ", formatarData(json[i].created_at))));
                    liMensagem.appendChild(document.createElement("br"));//Cria elemento br e adiciona ao elemento li
                    //Cria n� texto com mensagem e adiciona ao elemento li
                    liMensagem.appendChild(document.createTextNode(json[i].mensagem));
                    liMensagem.appendChild(document.createElement("br"));//Cria elemento br e adiciona ao elemento li
                    //Insere elemento li  antes do primeiro elemento filho
                    mensagens.insertBefore(liMensagem, mensagens.firstElementChild);
                }
            }
        }
    };
    xhttp.open("GET", "listar", true);                                  //Abre a chamada passando o m�todo GET, a url e true para opera��o assincrona
    xhttp.send();                                                       //Executa requisi��o
}

function formatarData(data) {                               //M�todo para formatar data
    var dataHora = data.split(" ");                         //Cria array a partir da string de data passado separando data e hora
    var arrayData = dataHora[0].split("-");                 //Cria array s� com data (ano, m�s e dia)
    return arrayData[2].concat("/", arrayData[1]).
        concat("/", arrayData[0]).concat(" ", dataHora[1]); //Concatena os elementos da data no formato brasileiro e retorna
}

function criarXHTTP() {                                     //M�todo para criar objeto request
    var xhttp = null;                                       //Cria vari�vel para objeto
    if (window.XMLHttpRequest) {                            //Verifica se existe objeto XMLHttpRequest
        xhttp = new XMLHttpRequest();                       //Cria novo XMLHttpRequest (Maioria dos navegadores)
    } else if (window.ActiveXObject) {                      //Se n�o, se existe ActiveXObject (IE)
        try {
            xhttp = new ActiveXObject("Msxml2.XMLHTTP");    //Tenta criar ActiveXObject(Msxml2.XMLHTTP) IE mais recentes
        } catch (e) {                                       //Se n�o conseguir
            xhttp = new ActiveXObject("Microsoft.XMLHTTP"); //Tenta criar ActiveXObject(Microsoft.XMLHTTP) IE inferior a 5
        }
    }
    return xhttp;                                           //Retorn objeto request
}