// Nope. This is a concept design, so no menu or filter toggles work. But it looks good, doesn't it?

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
            console.log("<!food!>"+this.getAttribute("data-Type")+"<!food!>");

        });

    } else if(one.getAttribute("data-Order")){

        one.addEventListener('click', function (){

            const ordening = document.querySelectorAll('a');
            ordening.forEach( order =>{
        
                if(order.getAttribute("data-Order")){
                    order.classList.remove("active");
                }
        });
            this.setAttribute("data-Type", this.innerHTML);
            this.classList.toggle("active");
            console.log("<!order!>"+this.getAttribute("data-Type")+"<!order!>");

        });

    }

});


var action = document.querySelectorAll(".material-symbols-outlined");
action.forEach(MP => {

    if(MP.classList.contains("plus")){
        MP.addEventListener("click", function (){
            var number = document.getElementById("n"+this.id);
            var counter = parseInt(number.innerHTML);
            if( document.getElementById("c"+this.id).checked ){
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
            document.querySelectorAll("."+this.getAttribute("data-Toggle")).forEach( act => { act.classList.toggle("gray")} )
            document.getElementById("n"+this.getAttribute("data-Toggle")).innerHTML = "0";
        })
    }
});