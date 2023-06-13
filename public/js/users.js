const rol_select = document.getElementById('rol_id');
const cash_select = document.getElementById('cash_id');


rol_select.addEventListener('change', function(e){

    if(e.target.value == 8){
        cash_select.removeAttribute("hidden");
        return;
    }

    if(e.target.value != 8 && !cash_select.hidden ){
        cash_select.setAttribute("hidden", true);

    }

});


document.addEventListener("DOMContentLoaded", function() {
    // Obtener referencia al elemento select
    if (rol_select.value == 8) {
        cash_select.removeAttribute("hidden");

    }
});


