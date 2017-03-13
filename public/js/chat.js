/**
 * Created by Wilder on 09/03/2017.
 */
;
window.onload = function () {                               //Execução função no carregamento da janela
    mensagens = document.getElementById("mensagens");       //Guarda elemento com id "mensagens" em variável
    mensagem = document.getElementById("mensagem");         //Busca elemento com id "mensagem" e guarda em variável
    var btnEnviar = document.getElementById("btn-enviar");  //Busca elemento com id "btn-enviar" e guarda em variável
    btnEnviar.onclick = function () {                       //Define função para onclick
        enviar();                                           //Função enviar
        return false;                                       //Retorna false
    };
    document.addEventListener("keypress", function (e) {    //Adicionando evento de precionar botão
        if (e.which == 13) {                                //Se precionou enter
            enviar();                                       //Executa método enviar
        }
    }, false);
    setInterval(buscar, 1000);                              //Coloca função buscar em loop com intervalo de 1 segundo
};

function enviar() {                                                 //Função responsável por fazer envio de mensagem do chat
    var formData = new FormData();                                  //Cria FormData para envio de dados via método POST
    if (mensagem.value.trim() !== "") {                             //Verifica se existe mensagem a ser enviada
        formData.append("mensagem", mensagem.value);                //Guarda valor da mensagem em FormData
        //Guarda o valor do elemento token em FormData
        formData.append("_token", document.getElementsByName("_token").item(0).value);
        var xhttp = criarXHTTP();                                   //Cria objeto request
        xhttp.onreadystatechange = function () {                    //Atribui função para evento de mudança
            if (xhttp.readyState == 4 && xhttp.status == 200) {     //Se solicitação foi respondida com sucesso
                mensagem.value = "";                                //Limpa texto de mensagem
            }
        };
        xhttp.open("POST", "salvar", true);                         //Abre a chamada passando o método POST, a url e true para operação assincrona
        xhttp.send(formData);                                       //Executa requisição passando FormData com dados
    } else {                                                        //Se campo mensagem estiver vazio
        alert("\u00c9 preciso preencher a mensagem a ser enviada.");//Apresenta mensagem
    }
    mensagem.focus();                                               //Passa foco para elemento mensagem
}

function buscar() {                                                     //Método que busca lista de mensagens do chat
    var xhttp = criarXHTTP();                                           //Cria objeto request
    xhttp.onreadystatechange = function () {                            //Atribui função para evento de mudança
        if (xhttp.readyState == 4 && xhttp.status == 200) {             //Se solicitação foi respondida com sucesso
            var json = JSON.parse(xhttp.responseText);                  //Pega a resposta e converte em json
            for (var i = 0; i < json.length; i++) {                     //Percorre lista de json
                if (!document.getElementById("chat_" + json[i].id)) {   //Se não existir no documento elemento com id correspondente ao do objeto
                    var liMensagem = document.createElement("li");      //Cria elemento li
                    liMensagem.setAttribute("id", "chat_" + json[i].id);//Adiciona atributo id ao elemento li
                    //Cria nó texto concatenando o nome do usuário e a data de criação da mensagem do chat e adiciona ao elemento li
                    liMensagem.appendChild(document.createTextNode(json[i].name.concat(" ", formatarData(json[i].created_at))));
                    liMensagem.appendChild(document.createElement("br"));//Cria elemento br e adiciona ao elemento li
                    //Cria nó texto com mensagem e adiciona ao elemento li
                    liMensagem.appendChild(document.createTextNode(json[i].mensagem));
                    liMensagem.appendChild(document.createElement("br"));//Cria elemento br e adiciona ao elemento li
                    //Insere elemento li  antes do primeiro elemento filho
                    mensagens.insertBefore(liMensagem, mensagens.firstElementChild);
                }
            }
        }
    };
    xhttp.open("GET", "listar", true);                                  //Abre a chamada passando o método GET, a url e true para operação assincrona
    xhttp.send();                                                       //Executa requisição
}

function formatarData(data) {                               //Método para formatar data
    var dataHora = data.split(" ");                         //Cria array a partir da string de data passado separando data e hora
    var arrayData = dataHora[0].split("-");                 //Cria array só com data (ano, mês e dia)
    return arrayData[2].concat("/", arrayData[1]).
        concat("/", arrayData[0]).concat(" ", dataHora[1]); //Concatena os elementos da data no formato brasileiro e retorna
}

function criarXHTTP() {                                     //Método para criar objeto request
    var xhttp = null;                                       //Cria variável para objeto
    if (window.XMLHttpRequest) {                            //Verifica se existe objeto XMLHttpRequest
        xhttp = new XMLHttpRequest();                       //Cria novo XMLHttpRequest (Maioria dos navegadores)
    } else if (window.ActiveXObject) {                      //Se não, se existe ActiveXObject (IE)
        try {
            xhttp = new ActiveXObject("Msxml2.XMLHTTP");    //Tenta criar ActiveXObject(Msxml2.XMLHTTP) IE mais recentes
        } catch (e) {                                       //Se não conseguir
            xhttp = new ActiveXObject("Microsoft.XMLHTTP"); //Tenta criar ActiveXObject(Microsoft.XMLHTTP) IE inferior a 5
        }
    }
    return xhttp;                                           //Retorn objeto request
}