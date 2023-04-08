var order = "0";
let type = "";
var communication = {};
communication.price = 0

document.querySelectorAll('a').forEach(one => {
    if(one.getAttribute("data-Type")){

        one.addEventListener('click', function (){

            const foodTypes = document.querySelectorAll('a');
            foodTypes.forEach( type =>{type.classList.remove("active");});
            this.classList.add("active");
            type = this.getAttribute("data-Type");
            if(type == "0"){
                type = "";
            }
            listFood();
            //console.log(type+ order );
        });
    }
});

document.querySelectorAll("l").forEach( one => {
    one.addEventListener('click', function (){

        document.querySelectorAll('l').forEach( toggle =>{
                toggle.classList.remove("active");
        });

        this.classList.toggle("active");
        order = this.getAttribute("data-order");
        //console.log(type+order);
        listFood();

    });
})
function set(){
    var action = document.querySelectorAll(".material-symbols-outlined");
    action.forEach(MP => {

        if(MP.classList.contains("plus")){
            MP.addEventListener("click", function (){
                var number = document.getElementById("n"+this.id);
                var counter = parseInt(number.innerHTML);
                var name = document.getElementById(this.id+"-name").innerHTML
                var price = parseFloat(document.getElementById(this.id+"price").getAttribute("data-price"))
                if( document.getElementById("c"+this.id).checked && parseInt(number.getAttribute("data-limit")) > counter){
                    number.innerHTML = counter + 1;
                    communication[name] = counter + 1;
                    communication.price += price
                    console.log(JSON.stringify(communication))
                    console.log(JSON.parse(JSON.stringify(communication)))
                }
            });
        } else if(MP.classList.contains("minus")){
            MP.addEventListener("click", function (){
                var number = document.getElementById("n"+this.id);
                var counter = parseInt(number.innerHTML);
                var price = parseFloat(document.getElementById(this.id+"price").getAttribute("data-price"))
                var name = document.getElementById(this.id+"-name").innerHTML
                if(counter >= 1 && document.getElementById("c"+this.id).checked ){
                    number.innerHTML = counter - 1;
                    communication[name] = counter - 1;
                    communication.price -= price
                    console.log(JSON.stringify(communication))
                    console.log(JSON.parse(JSON.stringify(communication)))
                }
            });
        }

    });


    var toggle = document.querySelectorAll("input");
    toggle.forEach( toggler => {
        if(toggler.getAttribute("data-Toggle")){
            toggler.addEventListener("click", function (){
                if(this.checked){
                document.querySelectorAll("."+this.getAttribute("data-Toggle")).forEach( act => { act.classList.remove("gray")} )
            } else {
                document.querySelectorAll("."+this.getAttribute("data-Toggle")).forEach( act => { act.classList.add("gray")} )
                document.getElementById("n"+this.getAttribute("data-Toggle")).innerHTML = "0";
                var name = document.getElementById(this.getAttribute("data-Toggle")+"-name").innerHTML
                communication[name] = 0;
                console.log(JSON.stringify(communication))
                console.log(JSON.parse(JSON.stringify(communication)))
            }
            })
        }
    });
}
function createFood(name, price, stock, type, category, desc){
    axios.get("../..//PHP/Comidas/cadastrarComida.php", { 
        params:{
        name:name,
        price:price,
        stock:stock,
        type:type,
        category:category,
        desc:desc
    }}).then( e => {
        console.log(e)
    }).catch();
}

function listFood(name, category){
    axios.get("../..//PHP/Comidas/listarComidas.php" ,{params:{
        nome: name || "",
        ordem: order,
        tipo: category || "",
        categoria: type
    }}
    ).then( e => {
        document.querySelector(".card-grid").innerHTML = articleCreate(e.data);
        set();
    }).catch();
}
listFood();
function delFood(id){
    axios.get("../..//PHP/Comidas/deletarComida.php", { params:{
            id:id
        }
    }).then(e => {
        console.log(e)
    }).catch()
}

function modFood(id, name, price, stock, type, category, desc){
    axios.get("../..//PHP/Comidas/alterarComida.php", { 
        params:{
        id:id,
        name:name,
        price:price,
        stock:stock,
        type:type,
        category:category,
        desc:desc
    }}).then( e => {
        console.log(e)
    }).catch();
}


function articleCreate(content){
    var response = "";
    Object.keys(content).forEach(function(key, index){
        if (typeof(content[index].nome) == "undefined" || content[index].estoque == "0" ){
        
        }else{
        response += `
        <article class="card" data-Type="${content[index].categoria}">
			<div class="card-header">
				<div>
					<span></span>
					<h3 id="_${content[index].id}-name">${content[index].nome}</h3>
				</div>
				<label class="toggle">
					<input type="checkbox" id="c_${content[index].id}" data-Toggle="_${content[index].id}">
					<span></span>
				</label>
			</div>
			<div class="card-body">
        <img src="${content[index].img || "../imagens/logo.png"}"/>
			</div>
			<div class="card-footer">
				<a href="#">Quantity:</a><hr>
				<span id="_${content[index].id}" class="material-symbols-outlined minus _${content[index].id} gray">do_not_disturb_on</span>
				<number data-limit="${content[index].estoque}" id="n_${content[index].id}">0</number>
				<span id="_${content[index].id}" class="material-symbols-outlined plus _${content[index].id} gray">add_circle</span>
			</div>
			<div id ="_${content[index].id}price" data-price="${content[index].preco}" class="price">Price: R$ ${content[index].preco}</div>
	    </article>`;
    }
    });
    return response;
}
