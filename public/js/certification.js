$(document).ready(function () {
    $("#btn_modalsaveclient").hide();

    $("#a_image").change(function () {
        let img = document.getElementById("a_image");
        let img_prev = document.getElementById("img_prev");

        const [file] = img.files;
        if (file) {
            img_prev.src = URL.createObjectURL(file);
        }
    });
});


$("#search_client").click(function () {
    let token = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    let cedula_client = $("#cedula").val().trim();

    if (cedula_client != "") {
        (async () => {
            const rawResponse = await fetch(
                window.location.origin + "/api/policies/getclient",
                {
                    method: "POST",
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ cedula: cedula_client }),
                }
            );
            const data = await rawResponse.json();

            if (data[0] != undefined) {
                $("#client_id").val(data[0].id);
                $("#client_name").val(data[0].name + " " + data[0].lastname);
                $("#btn_modalsaveclient").hide();
                $('#send_pay').prop('disabled', false);


            } else {
                error_notify('Cliente no encontrado', 'Confirme que la cedula o pasaporte sean correctos');

                $("#btn_modalsaveclient").show();


                $("#client_id").val("");
                $("#client_name").val("");
            }
        })();
    } else {
        error_notify('Cliente no identificado', 'Coloque cedula o pasaporte del cliente');
    }
    //we will send data and recive data fom our AjaxController
    //alert("im just clicked click me");
});


function storeClient(){
    let cedula = $("#cedulapass_client").val();
    let name = $("#name_client").val();
    let lastname = $("#lastname_client").val();
    let address = $("#address_client").val();
    let sex = $("#sex_client").val();
    let civil_status = $("#civil_status_client").val();
    let phone = $("#phone_client").val();
    let cellphone = $("#cellphone_client").val();
    let email = $("#email_client").val();
    let description = $("#description_client").val();


    (async () => {

        let formData = {
            cedula :      cedula,
            name:         name,
            lastname :    lastname,
            address :     address,
            sex:          sex,
            civil_status: civil_status,
            phone:        phone,
            cellphone:    cellphone,
            email:        email,
            description:  description
        };

        const rawResponse = await fetch(
            window.location.origin + "/api/policies/save/client",
            {
                method: "POST",
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(formData),
            }
        );
        const data = await rawResponse.json();


        if (data.response) {
            success_notify('Excelente', `${data.success}`);
            $("#btn_modalsaveclient").hide();
            document.getElementById('btn_close_modal_client').click();
            
        }
        else if(data.response == false) {
          
            if(data.data.cedula){
                errorRequest_notify(`${data.data.cedula[0]}`);
            }
            if(data.data.name){
                errorRequest_notify(`${data.data.name[0]}`);
            }
            if(data.data.lastname){
                errorRequest_notify(`${data.data.lastname[0]}`);
            }
            if(data.data.phone){
                errorRequest_notify(`${data.data.phone[0]}`);
            }
            if(data.data.email){
                errorRequest_notify(`${data.data.email[0]}`);
            }

        }else {
            error_notify('Error 404', 'Comunicarse con dpto de tecnologia')
            
        }

    })();

};



function error_notify(title, message) {
    new Notify({
        status: "error",
        title: title,
        text: message,
        effect: "slide",
        speed: 300,
        showIcon: true,
        showCloseButton: false,
        autoclose: true,
        autotimeout: 5000,
        gap: 20,
        distance: 20,
        type: 1,
        position: "right top",
    });
}

function error_notify(title, message) {
    new Notify({
        status: "error",
        title: title,
        text: message,
        effect: "slide",
        speed: 300,
        showIcon: true,
        showCloseButton: false,
        autoclose: true,
        autotimeout: 5000,
        gap: 20,
        distance: 20,
        type: 1,
        position: "right top",
    });
}


function success_notify(title, message) {
    new Notify({
        status: "success",
        title: title,
        text: message,
        effect: "slide",
        speed: 300,
        showIcon: true,
        showCloseButton: false,
        autoclose: true,
        autotimeout: 5000,
        gap: 20,
        distance: 20,
        type: 1,
        position: "right top",
    });
}

function errorRequest_notify(message) {
    new Notify({
        status: "warning",
        title: "Campos Vacios o Errores de Validacion",
        text: message,
        effect: "slide",
        speed: 300,
        showIcon: true,
        showCloseButton: false,
        autoclose: true,
        autotimeout: 5000,
        gap: 20,
        distance: 20,
        type: 1,
        position: "right top",
    });
}