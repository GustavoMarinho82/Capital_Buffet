listarFuncionario();

document.querySelector("#search").addEventListener("input", function  (){
    listarFuncionario(this.value)
});

document.querySelector("#action").addEventListener("click", function (){

});

document.querySelector(".header-navigation-actions").addEventListener("mouseover", function(){
    var i = document.querySelector(".ph-lightning-bold")
    if(i){
        i.classList.remove("ph-lightning-bold")
        i.classList.add("ph-lightning-fill")
    }
})

document.querySelector(".header-navigation-actions").addEventListener("mouseout", function(){
    var i = document.querySelector(".ph-lightning-fill")
    if(i){
        i.classList.remove("ph-lightning-fill")
        i.classList.add("ph-lightning-bold")
    }
})

function contatoFuncionario(id){
    document.querySelector(".row1").innerHTML = `
        <span>${document.getElementById(`_${id}-contatos`).getAttribute("data-telefone")}</span>
        <span>${document.getElementById(`_${id}-contatos`).getAttribute("data-email")}</span>
        
    `;
}