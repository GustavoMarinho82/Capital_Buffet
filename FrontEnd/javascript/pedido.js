function showPopup(text) {
  var popupOverlay = document.getElementById('popupOverlay');
  var popupText = document.getElementById('popupText');

  popupOverlay.style.display = 'flex';
}


function hidePopup() {
  var popupOverlay = document.getElementById('popupOverlay');
  popupOverlay.style.display = 'none';
}

//funções CRUD
listarPedidos()
listarPedidos2()

function criar(){
  var tipo = document.getElementById("tipo").innerHTML;
  var orcamento = document.getElementById("orca").innerHTML
  var data = document.getElementById("data").innerHTML
  var numconvidado = document.getElementById("numconvidado").innerHTML
  var endereco = document.getElementById("endereco").innerHTML
  var observacao = document.getElementById("obs").innerHTML

  var e = criarPedido( tipo, orcamento, data, data, numconvidado, endereco, observacao, 0, 0, 0, 0);

  e.then( o => {
    if ( o.data == "Pedido cadastrado com sucesso!"){
        listarPedido();
        notifications(o.data)
    } else {
        notifications(o.data, "Message--orange", "yes")
        console.log(o.data)
    }
})
}

function del(){}
function alterar(){}



idPedido = 1;
function redirecionar(){
  window.location.href = "../views/comidas_cliente.html?idPedido=" + idPedido;
}



