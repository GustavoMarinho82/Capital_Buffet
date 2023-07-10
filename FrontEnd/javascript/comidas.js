listarComida();

// Seletor para os inputs de número
var inputs = document.querySelectorAll('input[type="number"].item-checkbox');

// Array para armazenar as comidas selecionadas
var selecoes = [];

// Função para tratar a alteração no valor do input
function handleInput() {
  var selectedFood = this.parentNode.querySelector('.food').innerText;
  var quantity = this.value;
  
  // Verificar se a comida já foi selecionada antes
  var selectedFoodIndex = selecoes.findIndex(function(selecao) {
    return selecao.comida === selectedFood;
  });
  
  // Atualizar a quantidade ou adicionar uma nova seleção ao array
  if (selectedFoodIndex !== -1) {
    selecoes[selectedFoodIndex].quantidade = quantity;
  } else {
    selecoes.push({ comida: selectedFood, quantidade: quantity });
  }
  
  // Exibir as seleções no console (apenas para demonstração)
  console.log('Seleções:', selecoes);
}

// Adicionar o evento input para cada input de número
inputs.forEach(function(input) {
  input.addEventListener('input', handleInput);
});

function criar(){
    comida = inputcomida(comida);
    quantidade = inputcomida(quantidade);
}