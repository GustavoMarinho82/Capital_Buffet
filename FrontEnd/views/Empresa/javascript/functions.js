
document.querySelectorAll('a').forEach(one => {

    if(one.getAttribute("data-header") == "y"){

        one.addEventListener('click', function (){

            const foodTypes = document.querySelectorAll('a');
            foodTypes.forEach( type =>{type.classList.remove("active");});
            this.classList.add("active");
            type = this.getAttribute("data-Type");

        });
    }
});


function rowCreate(content){
    var response = `
    <div class="head">
        <span class="first" >Nome:</span>
        <span>CPF:</span>
        <span>Cargo:</span>
        <span>Salario:</span>
        <div class="contatos">Contatos:</div>
    </div>`;
    var id;
    var length = content.length - 1;
    for (key = 0; key <= length; key++){
        if (typeof(content[key].nome) == "undefined" ){
        
        }else{
            id = content[key].cpf
            response += `
            <div class="row">
                <span onclick="mod('${id}')" class="first" id="_${id}-nome" >${content[key].nome}</span>
                <span onclick="mod('${id}')" id="_${id}-cpf">${content[key].cpf}</span>
                <span onclick="mod('${id}')" id="_${id}-cargo">${content[key].cargo}</span>
                <span onclick="mod('${id}')" id="_${id}-salario" data-salario="${content[key].salario}">R$ ${content[key].salario}</span>
                <div class="contatos" id="_${id}-contatos" data-email="${content[key].email}" data-telefone="${content[key].telefone}" >
                    <button class="btn btn-outline-primary"
                    type="button" data-toggle="modal" data-id="${id}" data-target="#exampleModalCenter" onclick="contatoFuncionario('${id}')">
                        <span id="${id}" class="material-symbols-outlined">
                            call
                        </span>
                    </button>
                </div>
            </div>
            `;
    }
    }
    return response;
}

function criarRegistros(content){
    var response = `
    <div class="head">
        <span class="first">Data:</span>
        <span>Valor:</span>
        <div class="last">Descrição:</div>
    </div>`;

    var id, data;
    var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
    var length = content.length - 1;
    for (key = 0; key <= length; key++){
        if (typeof(content[key].id) == "undefined" ){
        
        }else{
            id = content[key].id
            dateP = content[key].data.split("-")
            var today  = new Date(dateP[0], dateP[1] - 1, dateP[2]);
            data = new Intl.DateTimeFormat("br", options).format(today);

            response += `
            <div class="row">
                <span onclick="mod('${id}')" class="first" id="_${id}-data" data-data="${content[key].data}" >${data}</span>
                <span onclick="mod('${id}')" id="_${id}-valor" data-valor="${content[key].valor}">R$ ${content[key].valor}</span>
                <div class="last" id="_${id}-contatos">
                    <button class="btn btn-outline-primary"
                    type="button" data-toggle="modal" id="_${id}-desc" data-target="#exampleModalCenter" data-Desc="${content[key].desc}" onclick="contatoFuncionario('${id}')">
                        <span id="${id}" class="material-symbols-outlined">
                            call
                        </span>
                    </button>
                </div>
            </div>
            `;
        }
    }
    return response;
}

function articleCreate(content){
    var response = "";
    var id;
    var length = content.length - 1;
    for (key = 0; key <= length; key++){
        if (typeof(content[key].nome) == "undefined" ){
        
        }else{
            id = content[key].id
            response += `
            <article id="${id}" class="card" data-tipo="${content[key].tipo}" data-categoria="${content[key].categoria}">
                <div class="card-header">
                    <div>
                        <span></span>
                        <h3 id="_${id}-name" data-id="_${id}">${content[key].nome}</h3>
                    </div>
                        <button data-bs-toggle="offcanvas" data-bs-target="#alterar" aria-controls="alterar" class="btn btn-outline-primary toggle" onclick="alterar('${id}')">Alterar</button>
                </div>
                <hr><div class="card-body">
            <img id="_${id}-img" src="${content[key].img || "../imagens/logo.png"}"/>
                </div><hr>
                <div class="card-footer">
                    <b href="#">Em estoque: <j id="_${id}-estoque" >${content[key].estoque}</j></b>
                </div>
                <div id="_${id}price" class="price">Preço: R$ <j id="_${id}-preco">${content[key].preco}</j></div>
                <div id="_${id}-desc" style="display:none">${content[key].descricao}</div>
            </article>`;
    }
    }
    return response;
}

function notifications(message, color, error){
    var notification =
     `<div class="Message ${color}" id="js-timer">
            <div class="Message-icon">
            <i class="fa fa-bell-o"></i>
            </div>
            <div class="Message-body">
            <p class="u-italic">${message}</p>
            </div>
            <button class="Message-close js-messageClose"><i class="fa fa-times"></i></button>
        </div>`;

        if(error){
            document.querySelector(".notifications-error").innerHTML += notification;
        } else {
            document.querySelector(".notifications").innerHTML += notification;
        }
        
        setTimeout(function() {
            closeMessage($('#js-timer'));
          }, 5000);
}

function criarComida(nome, preco, estoque, tipo, categoria, desc, imagem){
    return axios.get(PATH + "PHP/Comidas/cadastrarComida.php", { 
        params:{
        nome:nome,
        preco: preco,
        estoque: estoque,
        tipo: tipo,
        categoria: categoria,
        desc: desc,
        imagem: imagem
    }});
}

async function listarComida(id, nome, categoria){
    await axios.get(PATH + "PHP/Comidas/listarComidas.php" ,{params:{
        id:id,
        querry: nome,
        tipo: categoria,
    }}
    ).then( e => {
        document.querySelector(".card-grid").innerHTML = articleCreate(e.data);
    }).catch();
}


async function delComida(id){
    return axios.get(PATH + "PHP/Comidas/deletarComida.php", { params:{
            id:id
        }
    })
}

function modComida(id, nome, preco, estoque, tipo, categoria, desc, imagem){
    var e = axios.get(PATH + "PHP/Comidas/alterarComida.php", { 
        params:{
        id: id,
        nome: nome,
        preco: preco,
        estoque: estoque,
        tipo: tipo,
        categoria: categoria,
        desc: desc,
        imagem: imagem
    }});

    return e
}

async function criarUtilitario( nome, preco, estoque, desc, imagem){
    await axios.get(PATH + "PHP/Utilitarios/cadastrarUtilitario.php", { 
        params:{
            nome: nome,
            preco: preco,
            estoque: estoque,
            desc: desc,
            imagem: imagem
        }}).then( e => {
            console.log(e.data)
        }). catch();
}

async function listarUtilitario(nome, ordem){
    await axios.get(PATH + "PHP/Utilitarios/listarUtilitarios.php" ,{params:{
        nome: nome || "",
        ordem: ordem || "",
    }}
    ).then( e => {
        console.log(e.data)
    }).catch();
}

async function modUtilitario(id, nome, preco, estoque, desc, imagem){
 await axios.get(PATH + "PHP/Utilitarios/alterarUtilitario.php", {
    params:{
        id: id,
        nome: nome,
        preco: preco,
        estoque: estoque,
        desc: desc,
        imagem: imagem
    }}).then( e =>{
        console.log(e.data)
    }).catch();
}

async function delUtilitario(id){
    await axios.get(PATH + "PHP/Utilitarios/deletarUtilitario.php", {
        params:{
            id: id
        }
    }).then( e =>{
        console.log(e.data)
    }).catch();
}

async function criarFuncionario(nome, cpf, cargo, salario, email, telefone){
    return axios.get(PATH + "PHP/Funcionarios/cadastrarFuncionario.php", {
        params:{
            nome: nome,
            cpf: cpf,
            cargo: cargo,
            salario: salario,
            email: email,
            telefone: telefone
        }
    } )
}

async function listarFuncionario(querry){
    axios.get(PATH + "PHP/Funcionarios/listarFuncionarios.php", {
        params:{
            querry: querry
        }
    } ).then( e => {
        document.querySelector(".table").innerHTML = rowCreate(e.data);
        document.querySelectorAll(".btn-outline-primary").forEach( e => {
            e.addEventListener("mouseover", function () {
                if(document.getElementById(this.getAttribute("data-id"))){
                    document.getElementById(this.getAttribute("data-id")).classList.add("white")
                }
            })
        })
        document.querySelectorAll(".btn-outline-primary").forEach( e => {
            e.addEventListener("mouseout", function () {
                if(document.getElementById(this.getAttribute("data-id"))){
                    document.getElementById(this.getAttribute("data-id")).classList.remove("white")
                }
            })
        })
    });
}


async function modFuncionario(nome, cpf, cargo, salario, email, telefone){
    return axios.get(PATH + "PHP/Funcionarios/alterarFuncionario.php", {
        params: {
            nome: nome,
            cpf: cpf,
            cargo: cargo,
            salario: salario,
            email: email,
            telefone: telefone
        }
    })
}

async function delFuncionario(cpf){
    return axios.get(PATH + "PHP/Funcionarios/deletarFuncionario.php", {
        params:{
            cpf: cpf
        }})
}

async function criarUsuario(nome, senha, cpf, cnpj, cep,  email, telefone){
    await axios.get(PATH + "PHP/Usuarios/criarConta.php", {
        params:{
            nome: nome,
            senha:senha,
            cpf:cpf,
            cnpj:cnpj,
            cep:cep,
            email:email,
            telefone:telefone
        }
    }).then(e=>{
        console.log(e.data.status)
        if(e.data.status == "falha"){
            console.log(`causa: ${e.data.causa}`)
        }
    }).catch();
}

async function listarUsuario(query){
    await axios.get(PATH + "PHP/Usuarios/listarContas.php", {
        params:{
            query:query
        }
    }).then(e=>{
        console.log(e.data)
    }).catch();
}

async function modUsuario(id, nome, senha, cep,  email, telefone){
    await axios.get(PATH + "PHP/Usuarios/criarConta.php", {
        params:{
            id:id,
            nome: nome,
            senha:senha,
            cpf:cpf,
            cnpj:cnpj,
            cep:cep,
            email:email,
            telefone:telefone
        }
    }).then(e=>{
        console.log(e.data.status)
        if(e.data.status == "falha"){
            console.log(`causa: ${e.data.causa}`)
        }
    }).catch();
}

async function delUsuario(id){
    await axios.get(PATH + "PHP/Usuarios/deletarConta.php", {
        params:{
            id: id
        }
    }).then( e => {
        console.log("status: "+e.data.status);
        if(e.data.status == "falha"){
            console.log("causa: "+ e.data.causa)
        }
    })
}

async function login(email, senha){
    await axios.get(PATH + "PHP/Usuarios/login.php", {
        params:{
            email: email,
            senha: senha
        }
    }).then(e=>{
        console.log(e.data)
    }).catch();
}

async function criarRegistro(data, valor, desc){
    return axios.get(PATH + "PHP/Registros_Financeiros/cadastrarRegistro.php", {
        params:{
            data: data,
            valor: valor,
            desc: desc
        }
    });
}

async function listarRegistro(querry){
    await axios.get(PATH + "PHP/Registros_Financeiros/listarRegistros.php", {
        params:{
            querry: querry
        }
    }).then( e => {
        document.querySelector(".table").innerHTML = criarRegistros(e.data);
    }).catch();
}

async function modRegistro(id, data, valor, desc){
    return axios.get(PATH + "PHP/Registros_Financeiros/alterarRegistro.php", {
        params:{
            id: id,
            valor: valor,
            data: data,
            desc: desc
        }
    });
}

async function delRegistro(id){
    return axios.get(PATH + "PHP/Registros_Financeiros/deletarRegistro.php", {
        params:{
            id:id
        }
    });
}

async function listarCargos(){
    await axios.get(PATH + "PHP/Pedidos/listarCargos.php", {params:{}})
        .then(e => {
            console.log(e.data);
        })
}