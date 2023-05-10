function displayMenu() {

    const nav = $("#linkMenu").css("display");  
    if (nav != "none") {
        $("#linkMenu").css("display","none");
    } else {
        $("#linkMenu").css("display","block");
    }
}

window.addEventListener("resize",()=>{
    if (window.innerWidth >= 670) {
        $("#linkMenu").removeAttr("style");
    }
})

function addPizza(id,price){
    const cartDisplay = document.querySelector('#cart');
    let div = document.createElement('div');
    const name=$(`#name${id}`).text();
    div.innerHTML = `<b>${name} - $${price}</b>`; 
    cartDisplay.appendChild(div); //Add new div to display pizza

    const qpizzas=document.querySelectorAll('#cart div');
    if(qpizzas.length==1){
        $("#button_form").html("<br><input type='submit' value='Pay Pizza'>");
    }
    $("#button_form").append(`<input type='hidden' id='id_${qpizzas.length}' name='id_${qpizzas.length}' value='${id}'>`);
    $("#button_form").append(`<input type='hidden' id='name_${qpizzas.length}' name='name_${qpizzas.length}' value='${name}'>`);
    $("#button_form").append(`<input type='hidden' id='price_${qpizzas.length}' name='price_${qpizzas.length}' value='${price}'>`);
    $("#quantity_pizzas_form").html(`<input type='hidden' id='quantityPizzas' name='quantityPizzas' value='${qpizzas.length}'>`);
} 

$(document).ready(() => {
    $("#customerExists").css("display","none");

    $("#clickNewCustomer").click(evt => {
        $("#customerExists").css("display","none");
        $("#customerNew").css("display","grid");
        evt.preventDefault();
    });
    $("#clickExistsCustomer").click(evt => {
        $("#customerExists").css("display","grid");
        $("#customerNew").css("display","none");
        evt.preventDefault();
    });
});


