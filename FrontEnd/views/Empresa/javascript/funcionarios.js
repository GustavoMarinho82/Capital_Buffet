listarFuncionario();

document.querySelector("#search").addEventListener("input", function  (){
    listarFuncionario(this.value)
});
