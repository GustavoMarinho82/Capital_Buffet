var order = "<!order!>any<!order!>";
let type = "<!food!>all<!food!>";

const a = document.querySelectorAll('a');

a.forEach(one => {
    if(one.getAttribute("data-Type")){

        one.addEventListener('click', function (){

            const foodTypes = document.querySelectorAll('a');
            foodTypes.forEach( type =>{
        
                if(type.getAttribute("data-Type")){
                    type.classList.remove("active");
                }
        });
            this.setAttribute("data-Type", this.innerHTML);
            this.classList.toggle("active");
            type = "<!food!>"+this.getAttribute("data-Type")+"<!food!>";
            console.log(type+ order );
        });
    }
});

document.querySelectorAll("l").forEach( one => {
    one.addEventListener('click', function (){

        document.querySelectorAll('l').forEach( toggle =>{
                toggle.classList.remove("active");
        });

        this.setAttribute("data-Type", this.innerHTML);
        this.classList.toggle("active");
        order = "<!order!>"+this.getAttribute("data-Type")+"<!order!>";
        console.log(type+order);

    });
})

var action = document.querySelectorAll(".material-symbols-outlined");
action.forEach(MP => {

    if(MP.classList.contains("plus")){
        MP.addEventListener("click", function (){
            var number = document.getElementById("n"+this.id);
            var counter = parseInt(number.innerHTML);
            if( document.getElementById("c"+this.id).checked && parseInt(number.getAttribute("data-limit")) > counter){
                number.innerHTML = counter + 1;
            }
        });
    } else if(MP.classList.contains("minus")){
        MP.addEventListener("click", function (){
            var number = document.getElementById("n"+this.id);
            var counter = parseInt(number.innerHTML);
            if(counter >= 1 && document.getElementById("c"+this.id).checked ){
                number.innerHTML = counter - 1;
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
        }
        })
    }
});