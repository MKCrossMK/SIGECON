
let checkbox_price_form =  document.getElementById('add_price');

checkbox_price_form.addEventListener('click', function({target:{checked}}){
    let label_add_price = document.getElementById('label_add_price');
    let form_add_price = document.getElementById('form_add_price');
    const inputs = form_add_price.querySelectorAll('input');
    


    let elements = form_add_price.elements;

    if (checked) {
        label_add_price.innerText = 'Cancelar';
        form_add_price.style.display = "block"

    }else{
        label_add_price.innerText = 'Fijar Precio';
        form_add_price.style.display = "none"

        inputs.forEach(input => {
            input.value = '';
          });

    }

});