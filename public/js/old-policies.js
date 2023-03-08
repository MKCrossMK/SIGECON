$(document).ready(function () {
    $("#save_policy").prop("disabled", true);

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

                $('#save_policy').prop('disabled', false);

            } else {
                error_notify(
                    "Cliente no encontrado",
                    "Confirme que la cedula o pasaporte sean correctos"
                );

                $("#btn_modalsaveclient").show();

                $("#client_id").val("");
                $("#client_name").val("");
            }
        })();
    } else {
        error_notify(
            "Cliente no identificado",
            "Coloque cedula o pasaporte del cliente"
        );
    }
    //we will send data and recive data fom our AjaxController
    //alert("im just clicked click me");
});

function update_total() {
    var total = 0;

    $(".loan_price").each(function (i) {
        price = $(this).val();
        if (price == 0 || price == "") {
            $(this).focus();
            Swal.fire({
                icon: "error",
                title: "Precio en 0 o Vacío",
                text: "Ha olvidado colocar valor en articulo, coloque valor correspondiente del articulo",
            });
            error_notify(
                "Precio en 0 o Vacío",
                "Ha olvidado colocar valor en articulo, coloque valor correspondiente del articulo"
            );
        }
        if (price > 0) {
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

    // trigger_value();
}

//  Disparar la actualizacion del precio de presstamo

function bind() {
    $(".loan_price").keyup(update_total);

    $(".loan_price").trigger("keyup", update_total);

    $(".loan_price").keyup(check_values);

    $(".loan_price").trigger("keyup", check_values);
}

// Add articles to tables -- agregar articulos

function clear_inputs() {
    let description = $("#a_description").val("");
    let imagen = (document.getElementById("a_image").value = "");
    let carat = $("#a_carat").val("");
    let stone_type = $("#a_stonetype").val("No especificado");
    let weight = $("#a_weight").val("");
    let valued_price = $("#a_valuedprice").val("");
    let loan_price = $("#a_loanprice").val("");
    $("#img_prev").attr("src", location.origin + "/img/item_article_img.gif");
}

// Delete items or articles  // Eliminar items
$(document.body).on("click", ".delete", function () {
    $(this).parents(".item-row").remove();
    update_total();
});

// Desactivar los input al editar el valor final de la prenda

function readonly_price(item) {
    $(item).blur(function () {
        $(item).attr("readonly", true);
    });
    check_values();
}

// Deshabilitar boton de guardar poliza si existe un input de precio vacio

$(document).ready(function () {
    let id_img = 0;

    $("#add_articles").click(function () {
        id_img += 1;
        // console.log(id_img);
        let description = $("#a_description").val();
        let imagen = document.getElementById("a_image");
        let carat = $("#a_carat").val();
        let stone_type = $("#a_stonetype").val();
        let weight = $("#a_weight").val();
        let valued_price = $("#a_valuedprice").val();
        let loan_price = $("#a_loanprice").val();

        //   let imgInp  = document.getElementById("a_image");

        if (
            description != "" &&
            carat != "" &&
            weight != "" &&
            valued_price != "" &&
            loan_price != "" &&
            loan_price > 0
        ) {
            $(".item-row:last").after(
                '<div class="item-row"><div class="div_article mb-2 ">' +
                    '<div class="row align-items-center">' +
                    '<div class="col-1">' +
                    '<button type="button" class="btn btn_delete rounded-circle delete"><i class="fa-solid fa-trash-can"></i></button>' +
                    "</div>" +
                    '<div class="col-3">' +
                    '<img class="img-fluid img_article" id="prev_img' +
                    id_img +
                    '" alt="Imagen Articulo">' +
                    '<input type="file" name="image[]" id="image' +
                    id_img +
                    '" hidden>' +
                    "</div>" +
                    '<div class="col">' +
                    '<textarea id="description" name="description[]" class="form-control w-100 mb-2" rows="1">' +
                    description +
                    "</textarea>" +
                    '<div class="row mb-2">' +
                    '<div class="col">' +
                    '<div class="input-group">' +
                    '<span class="input-group-text" id="basic-addon1">Quilate (K)</span>' +
                    '<input type="text" id="carat" name="carat[]" class="form-control" value="' +
                    carat +
                    '" readonly>' +
                    "</div>" +
                    "</div>" +
                    '<div class="col">' +
                    '<div class="input-group">' +
                    '<span class="input-group-text" id="basic-addon1">T. Piedra</span>' +
                    '<input type="text" id="stone_type" name="stone_type[]" class="form-control" value="' +
                    stone_type +
                    '" readonly>' +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    '<div class="row mb-2">' +
                    '<div class="col">' +
                    '<div class="input-group">' +
                    '<span class="input-group-text" id="basic-addon1">Peso (grs)</span>' +
                    '<input type="text" id="weight" name="weight[]" class="form-control" value="' +
                    weight +
                    '" readonly>' +
                    "</div>" +
                    "</div>" +
                    '<div class="col">' +
                    '<div class="input-group">' +
                    '<span class="input-group-text" id="basic-addon1">P. Valorado</span>' +
                    '<input type="text" id="valued_price" name="valued_price[]" class="form-control" value="' +
                    valued_price +
                    '" readonly>' +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    '<div class="input-group">' +
                    '<span class="input-group-text" id="basic-addon1">P. Préstamo</span>' +
                    '<input type="text" id="loan_price" name="loan_price[]" class="form-control loan_price" value="' +
                    loan_price +
                    '" onblur="readonly_price(this)"  readonly>' +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
            );

            let img_art = document.getElementById("prev_img" + id_img);
            let input_img = document.getElementById("image" + id_img);

            input_img.files = imagen.files;

            const [file] = input_img.files;
            if (file) {
                img_art.src = URL.createObjectURL(file);
            }

            bind();
            clear_inputs();

            // Desabilitar el boton guardar

            $("#save_policy").prop("disabled", false);

            //Recordar proporcionar el cliente
            new Notify({
                status: "success",
                title: "Exito",
                text: "Articulo agregado correctamente",
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

            if ($("#client_id").val() == "") {
                error_notify_client();
            }else{
                $('#save_policy').prop('disabled', false);

            }
        } else {
            new Notify({
                status: "error",
                title: "Datos Incompletos",
                text: "Rellene todos los campos requeridos del articulo, estos son: || Descripción del articulo  || Quilates || Peso del articulo ||",
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
    });

    // Confirmarcion de edicion de precio de prestamo

    $("#a_loanprice").on("click", function () {
        Swal.fire({
            title: "Editar precio de préstamo",
            text: "¡Confirme la edicion del precio de préstamo!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Realizar",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#a_loanprice").attr("readonly", false);
            }
        });
    });

    // Add attribute disabled to loanPrice, precio de prestamo input

    $("#a_loanprice").blur(function () {
        $("#a_loanprice").attr("readonly", true);
    });
});

$(document.body).on("click", ".loan_price", function () {
    // $(this).parents('.item-row').remove();
    $(this).on("click", function () {
        Swal.fire({
            title: "Editar precio de préstamo",
            text: "¡Confirme la edicion del precio de préstamo!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Realizar",
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).attr("readonly", false);
            }
        });
    });

    check_values();
});

let pass_gerence_to_preference_rate = false;
let pass_gerence_to_second_rate = false;

function check_values() {
    let interest_rate = $("#interest_rate").val();
    let loan_value = $("#loan_value").val();
    let interest_first = $("#interest_first").val();
    let interest_second = $("#interest_second").val();
    let interest_preference = $("#interest_preference").val();

    if (
        pass_gerence_to_preference_rate == false &&
        pass_gerence_to_second_rate == false
    ) {
        $("#interest_rate").val(interest_first);
        update_total();
    } else if (
        pass_gerence_to_preference_rate == true &&
        pass_gerence_to_second_rate == false
    ) {
        $("#interest_rate").val(interest_preference);
        update_total();
    } else if (
        pass_gerence_to_second_rate == true &&
        pass_gerence_to_preference_rate == false
    ) {
        $("#interest_rate").val(interest_second);
        update_total();
    } else if (
        pass_gerence_to_preference_rate == true &&
        pass_gerence_to_second_rate == true
    ) {
        pass_gerence_to_preference_rate = false;
        pass_gerence_to_second_rate = false;
        $("#interest_rate").val(interest_first);
        update_total();
    }

    $(".loan_price").each(function (i) {
        input = $(this).val();
        if (input == 0 || input == "" || $(this) == undefined) {
            error_notify(
                "Precio en 0 o Vacío",
                "Ha olvidado colocar valor en articulo, coloque valor correspondiente del articulo"
            );
            $("#save_policy").prop("disabled", true);
        }else{
            $("#save_policy").prop("disabled", false);

        }
    });
}

// Definir una funcion que evalue que si las variables son falsas realice el calculo de 149000 pase a 3%

$("#interest_preference").click(function () {
    if (pass_gerence_to_preference_rate == false) {
        Swal.fire({
            icon: "info",
            title: `Seleccion de Tasa de Interés de ${$(this).val()}`,
            text: "¿Seguro de que esta poliza lleva esta tasa de interés?",
            showDenyButton: true,
            confirmButtonText: "Si!",
            denyButtonText: `Cancelar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                pass_gerence_to_preference_rate = true;
                check_values();
            } else if (result.isDenied) {
                check_values();
            }
        });
    }
});

$("#interest_second").click(function () {
    if (pass_gerence_to_second_rate == false) {
        Swal.fire({
            icon: "info",
            title: `Seleccion de Tasa de Interés de ${$(this).val()}`,
            text: "¿Seguro de que esta poliza lleva esta tasa de interés?",
            showDenyButton: true,
            confirmButtonText: "Si!",
            denyButtonText: `Cancelar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                pass_gerence_to_second_rate = true;
                check_values();
            } else if (result.isDenied) {
                check_values();
            }
        });
    }
});

$("#interest_first").click(function () {
    pass_gerence_to_preference_rate = false;
    pass_gerence_to_second_rate = false;
    bind();
});

function error_notify_client() {
    for (let index = 0; index <= 2; index++) {
        new Notify({
            status: "error",
            title: "Cliente no proporcionado",
            text: "Recuerde proporccionar el cliente ya que es requerido para generar la poliza",
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
    $('#save_policy').prop('disabled', true);

    $("#cedula").focus();

    
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

// Funcion para cambiar el input cedula o pasaporte
$(document).ready(function () {
    $("#passced_chbox").click(function () {
        if ($(this).prop("checked") == true) {
            $("#cedulapass_client").unmask();
            $("#cedulapass_client").attr("placeholder", "Pasaporte");
            $("#cedulapass_client").attr("maxlength", "13");
            $("#passced_text").text("¿Cedula?");
        } else if ($(this).prop("checked") == false) {
            $("#cedulapass_client").mask("000-0000000-0");
            $("#cedulapass_client").attr("placeholder", "Cedula");
            $("#passced_text").text("¿Pasaporte?");
        }
    });
});

// Save new client on modal policies

function clear_inputs_modalNewClient() {
    let cedulapass_client = $("#cedulapass_client").val("");
    let name_client = $("#name_client").val("");
    let lastname_client = $("#lastname_client").val("");
    let address_client = $("#address_client").val("");
    let sex_client = $("#sex_client").val("");
    let civil_status_client = $("#civil_status_client").val("");
    let phone = $("#phone_client").val("");
    let cellphone = $("#cellphone_client").val("");
    let email_client = $("#email_client").val("");
    let description_client = $("#description_client").val("");
}

function storeClient() {
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
            cedula: cedula,
            name: name,
            lastname: lastname,
            address: address,
            sex: sex,
            civil_status: civil_status,
            phone: phone,
            cellphone: cellphone,
            email: email,
            description: description,
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
            success_notify("Excelente", `${data.success}`);
            $("#btn_modalsaveclient").hide();
            document.getElementById("btn_close_modal_client").click();
        } else if (data.response == false) {
            if (data.data.cedula) {
                errorRequest_notify(`${data.data.cedula[0]}`);
            }
            if (data.data.name) {
                errorRequest_notify(`${data.data.name[0]}`);
            }
            if (data.data.lastname) {
                errorRequest_notify(`${data.data.lastname[0]}`);
            }
            if (data.data.phone) {
                errorRequest_notify(`${data.data.phone[0]}`);
            }
            if (data.data.email) {
                errorRequest_notify(`${data.data.email[0]}`);
            }
        } else {
            error_notify("Error 404", "Comunicarse con dpto de tecnologia");
        }
    })();
}
