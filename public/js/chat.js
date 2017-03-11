/**
 * Created by Wilder on 09/03/2017.
 */
;
window.onload = function () {                                   //Execução função no carregamento da janela
    mensagens = document.getElementById("mensagens");           //Guarda elemento com id "mensagens" em variável
    var btnEnviar = document.getElementById("btn-enviar");      //Busca elemento com id "btn-enviar" e guarda em variável
    btnEnviar.addEventListener("click", enviar);                //Passa função enviar para evento click do botão
    setInterval(buscar, 1000);                                  //Coloca função buscar em lupe com intervalo de 1 segundo
};

function enviar() {                                             //Função responsável por fazer envio de mensagem do chat
    var mensagem = document.getElementById("mensagem");         //Busca elemento com id "mensagem" e guarda em variável
    var formData = new FormData();                              //Cria FormData para envio de dados via método POST
    if (mensagem.value !== "") {                                //Verifica se existe mensagem a ser enviada
        formData.append("mensagem", mensagem.value);            //Guarda valor da mensagem em FormData
        //Guarda o valor do elemento token em FormDAta
        formData.append("_token", document.getElementsByName("_token").item(0).value);
        var xhttp = criarXHTTP();                               //Busca instância de objeto request
        xhttp.onreadystatechange = function () {                //Atribui função para evento de mudança
            if (xhttp.readyState == 4 && xhttp.status == 200) { //Se solicitação foi respondida com sucesso
                mensagem.value = "";                            //Limpa texto de mensagem
            }
        };
        xhttp.open("POST", "salvar", true);                     //Abre a chamada passando o método, a url e se operação é assincrona
        xhttp.send(formData);                                   //Executa requisição passando FormData com dados
    }
}

function buscar() {
    var xhttp = criarXHTTP();
    xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            var json = JSON.parse(xhttp.responseText);
            for (var i = 0; i < json.length; i++) {
                if (!document.getElementById("chat_" + json[i].id)) {
                    var liMensagem = document.createElement("li");
                    liMensagem.setAttribute("id", "chat_" + json[i].id);
                    liMensagem.appendChild(document.createTextNode(json[i].usuario.name.concat(" ", formatarData(json[i].created_at))));
                    liMensagem.appendChild(document.createElement("br"));
                    liMensagem.appendChild(document.createTextNode(json[i].mensagem));
                    liMensagem.appendChild(document.createElement("br"));
                    mensagens.insertBefore(liMensagem, mensagens.firstElementChild);
                }
            }
        }
    };
    xhttp.open("GET", "listar", true);
    xhttp.send();
}

function formatarData(data) {
    var dataHora = data.split(" ");
    var arrayData = dataHora[0].split("-");
    return arrayData[2].concat("/", arrayData[1]).concat("/", arrayData[0]).concat(" ", dataHora[1]);
}

function criarXHTTP() {
    var xhttp;
    if (window.XMLHttpRequest) {
        xhttp = new XMLHttpRequest();
    } else {
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    return xhttp;
}