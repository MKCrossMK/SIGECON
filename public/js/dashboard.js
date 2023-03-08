function cancelNewClient() {
    document.getElementById('cedula').value = "";
    document.getElementById('name').value = "";
    document.getElementById('lastname').value = "";
    document.getElementById('address').value = "";
    document.getElementById('sex').value = "";
    document.getElementById('civil_status').value = "";
    document.getElementById('phone').value = "";
    document.getElementById('cellphone').value = "";
    document.getElementById('email').value = "";
}

function cancelNewUser() {
    document.getElementById('name').value = "";
    document.getElementById('lastname').value = "";
    document.getElementById('user').value = "";
    document.getElementById('email').value = "";
    document.getElementById('rol_id').value = "";
    document.getElementById('branch_office_id').value = "";
    document.getElementById('password').value = "";
}

setTimeout(function() {
    // Closing the alert
    $('.alert').hide();

}, 4000);



// Mask inputs clients


// $(document).ready(function() {
//     $('#cedula').mask('000-0000000-0');
//     $('#phone').mask('000-000-0000');
//     $('#cellphone').mask('000-000-0000');

// });

//clients 
$(document).ready(function(){
    $('#foreign_chbox').click(function(){
        if($(this).prop("checked") == true){
            $("#cedula").unmask();
            $('#cedula').attr("placeholder", "Pasaporte");
            $('#cedula').attr("maxlength", "13");
            $("#foreign_text").text("¿Cedula?");
        }
        else if($(this).prop("checked") == false){
            $("#cedula").mask("000-0000000-0");
            $('#cedula').attr("placeholder", "Cedula");
            $("#foreign_text").text("¿Pasaporte?");
        }
    });
});

$(document).ready(function(){
    $('#chkbox_showpass').click(function(){
        let current_password = document.getElementById('current_password');
        let new_password = document.getElementById('new_password');
        let confirm_password = document.getElementById('confirm_password');

        if($(this).prop("checked") == true){
            current_password.type = 'text';
            new_password.type = 'text';
            confirm_password.type = 'text';
        
        }
        else if($(this).prop("checked") == false){
            current_password.type = 'password';
            new_password.type = 'password';
            confirm_password.type = 'password';
        }
    });
});