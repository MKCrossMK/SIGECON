
    function change_interest () {
        let interest_rate = $("#interest_rate").val();
        let loan_value = $("#loan_value").val();
        let interest_first = $('#interest_first').val();
        let interest_second = $('#interest_second').val();
        let interest_preference = $('#interest_preference').val();

        if(interest_rate != interest_preference){
            if(loan_value > 150000){
                $("#interest_rate").val(interest_second);   
                update_t();   
            }
        }
    }

    function change_interest_other () {
        let interest_rate = $("#interest_rate").val();
        let loan_value = $("#loan_value").val();
        let interest_first = $('#interest_first').val();
        let interest_second = $('#interest_second').val();
        let interest_preference = $('#interest_preference').val();

        if(interest_rate != interest_preference){
            if(loan_value > 150000){
                $("#interest_rate").val(interest_second);   
                update_t();   
            }else{
                put_first_interest();

            }
        }
    }
  
    function update_total(){

        var total = 0 ; 
      
        $(".loan_price").each(function(i){
          price =  $(this).val();
          if (price == 0 || price == "") {
            $(this).focus();
            error_alert("Valor en 0", "Ha olvidado colocar valor en articulo, coloque valor correspondiente del articulo")

          }
            if(price > 0){
              total += Number(price);
            }
        });

        $("#loan_value").val(Number(total).toFixed(2));
        $("#capital_pay").val(Number(total).toFixed(2));

        let capital = $("#capital_pay").val();
        let interest_rate = $("#interest_rate").val();
        let contract_rate = $("#contract_rate").val();

        let interest = capital * (interest_rate / 100);
        let contract = capital * (contract_rate / 100);

        $("#interest_pay").val(Number(interest).toFixed(2));
        $("#contract_pay").val(Number(contract).toFixed(2));


    }

    function update_t(){

        var total = 0 ; 
      
        $(".loan_price").each(function(i){
            price =  $(this).val();
            if (price == 0 || price == "") {
              $(this).focus();
              error_alert("Valor en 0", "Ha olvidado colocar valor en articulo, coloque valor correspondiente del articulo")
  
            }
              if(price > 0){
                total += Number(price);
              }
          });

        $("#loan_value").val(Number(total).toFixed(2));
        $("#capital_pay").val(Number(total).toFixed(2));

        let capital = $("#capital_pay").val();
        let interest_rate = $("#interest_rate").val();
        let contract_rate = $("#contract_rate").val();

        let interest = capital * (interest_rate / 100);
        let contract = capital * (contract_rate / 100);

        $("#interest_pay").val(Number(interest).toFixed(2));
        $("#contract_pay").val(Number(contract).toFixed(2));


    }

    function put_first_interest () {
        let interest_first = $('#interest_first').val();
        $("#interest_rate").val(interest_first);
        change_interest();
        update_total();
    }
    

   


    $(document).ready(function () {

        let pass_gerence = false;
        let pass_gerence2 = false;


        $("#interest_preference").click(function () {
            if(pass_gerence == false){
                Swal.fire({
                    title: "Tasa Preferencial",
                    text: "Para colocar tasa preferencial, el gerente de este sucursal debe autorizarlo mediante su contraseña de usuario",
                    input: "password",
                    inputAttributes: {
                        autocapitalize: "off",
                        autocorrect: 'off'     
                        },
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonText: "Autorizar",
                    showLoaderOnConfirm: true,
                    preConfirm: (password) => {
    
                
                        if(password == '12345'){
                            console.log(password);
                            update_total();
                            pass_gerence = true;

    
                        }else{
                            put_first_interest();

                            // Hacer que cambie el interest
                        
                        }
                        
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        put_first_interest();

                    } 
                  });
            }else {
                update_total();
            }
            
        });

        $("#interest_second").click(function () {
            if(pass_gerence == false){
                Swal.fire({
                    title: "Tasa Preferencial",
                    text: "Para colocar tasa preferencial, el gerente de este sucursal debe autorizarlo mediante su contraseña de usuario",
                    input: "password",
                    inputAttributes: {
                        autocapitalize: "off",
                        autocorrect: 'off'     
                        },
                    allowOutsideClick: false,
                    showCancelButton: true,
                    confirmButtonText: "Autorizar",
                    showLoaderOnConfirm: true,
                    preConfirm: (password) => {
    
                
                        if(password == '12345'){
                            console.log(password);
                            update_total();
                            pass_gerence = true;

    
                        }else{
                            put_first_interest();

                            // Hacer que cambie el interest
                        
                        }
                        
                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.cancel) {
                        put_first_interest();

                    } 
                  });
            }else {
                update_total();
            }
        });

        $("#interest_first").click(function () {
            update_total();
        });
    });


    function readonly_price (item)  {
        $(item).attr("readonly", true); 
        change_interest_other();
    }

    //Fetch for request on api

     // var url = 'https://example.com/profile';
     var data = {code: code};

     // fetch(window.location.origin + "/api/policies/checkpassword", {
     // method: 'POST', // or 'PUT'
     // body: JSON.stringify(data), // data can be `string` or {object}!
     // headers:{
     //     'Content-Type': 'application/json'
     // }
     // }).then(res => res.json())
     // .catch(error => console.error('Error:', error))
     // .then(response => console.log(response));
