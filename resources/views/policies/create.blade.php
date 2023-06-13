<x-app-layout>



    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views text-center"><i class="fa-solid fa-file-circle-plus mr-2 color-gold"></i></i>Nueva
                Poliza</h1>
        </div>

        <div class="div-view-policies">
            <div>
                <form enctype="multipart/form-data" action="{{ route('policies.store') }}" id="policy_form" method="POST">
                    @csrf

                    @if (Session::has('message'))
                        <script type="text/javascript">
                            Swal.fire(
                                'Excelente!',
                                '{{ session()->get('message') }}',

                            );
                        </script>
                    @endif

                    @if (Session::has('error'))
                    <script type="text/javascript">
                        Swal.fire(
                            'Error!',
                            '{{ session()->get('error') }}',

                        );
                    </script>
                @endif
                    <div class="row mb-2 align-items-center">
                        <div class="col col_label_input_align">
                            <label for="date_start" class="date_title">Fecha Emision</label>
                            <input type="date" id="date_start" name="date_start" class="form-control"
                                placeholder="Fecha Inicio" aria-label="Fecha Inicio" value="{{ $date_start }}" readonly>
                            @error('date_start')
                                <div id="alert" class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col col_label_input_align">
                            <label for="date_end" class="date_title">Fecha Vencimiento</label>

                            <input type="date" id="date_end" name="date_end" class="form-control"
                                placeholder="Fecha Fin" aria-label="Fecha Fin"
                                value="{{ $date_end}}" readonly>
                            @error('date_end')
                                <div id="alert" class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
                        <div class="col-8 col_label_input_align">
                            <input type="hidden" id="client_id" name="client_id" class="form-control"
                                value="{{ old('client_id') }}">
                            <input type="text" id="cedula" name="cedula" class="form-control"
                                placeholder="Cedula del cliente" value="{{ old('cedula') }}" data-mask="000-0000000-0">
                            <input type="text" id="client_name" name="client_name" class="client_name_input"
                                placeholder="Seleccione Cliente..." disabled value="{{ old('client_name') }}">

                            {{-- Alert de cliente --}}
                            @error('client_id')
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Cliente no proporcionado',
                                        text: '{{ $message }}',
                                        footer: 'Recuerde siempre seleccionar el cliente'
                                    })
                                </script>
                            @enderror
                        </div>
                        <div class="col-4 col_label_input_align">
                            <div class="">
                                <input type="checkbox" class="form-control" id="foreign_chbox">
                                <label id="foreign_text" for="foreign_chbox">¿Pasaporte?</label>
                            </div>
                            <button type="button" class="btn btn_search_client w-100 mb-3" id="search_client">Buscar
                                cliente</button>

                                 <!-- Button trigger modal --- Boton para abrir modal -->
                            <button type="button" id="btn_modalsaveclient" class="btn btn_search_client w-100" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">Registrar nuevo cliente</button>

                        </div>
                    </div>


                    <div class="accordion mb-3" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa-solid fa-gem mr-3 color-gold"></i> Articulos
                                    <i class="fa-solid fa-gem  color-gold ml-3"></i>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <div id="articles_div">
                                        <div class="mb-2">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-floating txarea_desc">
                                                        <textarea id="a_description" class="form-control txarea_desc"></textarea>
                                                        <label for="a_description">Descripcion de la prenda:</label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row align-items-center">
                                                        <label for="a_weight">Imagen del articulo:</label>
                                                        {{-- <input type="file" id="a_image2" accept=".jpg,.jpeg,.png" class="form-control-file"> --}}
                                                        <img id="img_prev" class="img_article_add"
                                                            src="{{ asset('img/item_article_img.gif') }}"
                                                            alt="Articles Image" />
                                                        <input type="file" id="a_image" accept=".jpg,.jpeg,.png"
                                                            class="form-control-file">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col">
                                                <label for="a_carat">Quilate (K):</label>
                                                <select type="text" id="a_carat" class="form-control">
                                                    <option value="" selected disabled>Quilate (K)</option>
                                                    @foreach ($gold_rates as $gold)
                                                        <option value="{{ $gold->carat }}">{{ $gold->carat }} |
                                                            RD${{ $gold->price }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col">
                                                <label for="a_stonetype">Tipo de piedra:</label>
                                                <select id="a_stonetype" class="form-control">
                                                    <option value="No especificado" selected aria-readonly="">Tipos de
                                                        piedra</option>
                                                    <option value="Diamante">Diamante</option>
                                                    <option value="Zafiro">Zafiro</option>
                                                    <option value="Esmeralda">Esmeralda</option>
                                                    <option value="Granate">Granate</option>
                                                </select>
                                            </div>
                                            <div class="form-group col">
                                                <label for="a_weight">Peso (Gramos-grs):</label>
                                                <input type="text" id="a_weight" class="form-control"
                                                    data-mask="###0.00">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col">
                                                <label for="a_valuedprice">Precio Valorado:</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">DOP</span>
                                                    <input type="text" id="a_valuedprice" name="a_valuedprice"
                                                        class="form-control" placeholder="0.00" disabled>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="a_loanprice">Precio Prestamo:</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text" id="basic-addon1">DOP</span>
                                                    <input type="text" id="a_loanprice" name="a_loanprice"
                                                        class="form-control" placeholder="0.00" readonly>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="div_btn_add">
                                            <button type="button" class="btn btn_add w-100"
                                                id="add_articles">Agregar Articulo</button>
                                        </div>


                                        <hr class="mb-3">
                                        <hr class="mb-3">


                                        <div class="item-row"></div>




                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion accordion-flush mb-3" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <i class="fa-solid fa-address-book mr-3 color-gold"></i> Referente (Opcional)
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <div class="reference_div">
                                        <div class="row mb-2">
                                            <div class="col">
                                                <label for="ref_cedula">Cedula:</label>
                                                <input type="text" id="ref_cedula" name="ref_cedula"
                                                    class="form-control" value="{{old('ref_cedula')}}" data-mask="000-0000000-0">
                                            </div>
                                            <div class="col">
                                                <label for="ref_name">Nombre:</label>
                                                <input type="text" id="ref_name" name="ref_name"
                                                    class="form-control" value="{{old('ref_name')}}" >
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label for="ref_phone">Telefono:</label>
                                                <input type="text" id="ref_phone" name="ref_phone"
                                                    class="form-control" value="{{old('ref_phone')}}" data-mask="000-000-0000">
                                            </div>
                                            <div class="col mt-4 mb-2">
                                                <div class="form-floating">
                                                    <textarea id="ref_address" name="ref_address" class="form-control" placeholder="Direccion">{{old('ref_address')}}</textarea>
                                                    <label for="ref_address">Direccion:</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-floating">
                                                <textarea id="ref_note" name="ref_note" class="form-control" placeholder="Nota">{{old('ref_note')}}</textarea>
                                                <label for="ref_note">Nota:</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="money_div">

                        <div class="money_title mb-3">Monetario</div>

                        <div class="row mb-2">
                            <div class="col">
                                <label for="">Valor a prestar:</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">DOP</span>
                                    <input type="text" id="loan_value" name="loan_value" class="form-control"
                                        value="0.00" onchange="assigned_value(this)" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <label for="">Vigencia en meses:</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="validity_months" name="validity_months"
                                        class="form-control" value="4" readonly>
                                    <span class="input-group-text" id="basic-addon1">Meses</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Tasa de Interes % / Tasa Actual: </label>
                                <div class="input-group mb-3">
                                    <select name="interest_rate" id="interest_rate" class="form-control">
                                        @foreach ($interest_rates as $interest)
                                            <option
                                                @if ($interest->description == 'first') id="interest_first" selected @endif
                                                @if ($interest->description == 'second') id="interest_second" readonly @endif
                                                @if ($interest->description == 'preference') id="interest_preference" readonly @endif
                                                value="{{ $interest->porcent }}">{{ $interest->porcent }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                </div>

                            </div>
                            <div class="col">
                                <label for="">Tasa de Contrato % / Tasa Actual:</label>
                                <div class="input-group mb-3">
                                    <input type="text" id="contract_rate" name="contract_rate"
                                        class="form-control" value="2" readonly>
                                    <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                            </div>
                        </div>

                        <div class="money_title mt-3 mb-3">Total a deber:</div>

                        <div class="row mb-2">
                            <div class="col total_label">Capital:</div>
                            <div class="col-7">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">DOP</span>
                                    <input type="text" id="capital_pay" name="capital_pay" class="form-control"
                                        value="0.00" readonly>
                                </div>
                                @error('capital_pay')
                                <div id="alert" class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            </div>
                        </div>

                        <hr class=" mt-2 mb-2">

                        <div class="row mb-2">
                            <div class="col total_label">Interes:</div>
                            <div class="col-7">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">DOP</span>
                                    <input type="text" id="interest_pay" name="interest_pay" class="form-control"
                                        value="0.00" readonly>
                                </div>
                            </div>
                        </div>

                        <hr class=" mt-2 mb-2">

                        <div class="row">
                            <div class="col total_label">Contrato:</div>
                            <div class="col-7">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">DOP</span>
                                    <input type="text" id="contract_pay" name="contract_pay" class="form-control"
                                        value="0.00" readonly>
                                </div>
                            </div>
                        </div>

                        <hr class=" mt-2 mb-2">



                        <div>
                            <div class="form-floating">
                                <textarea id="note_policy" name="note_policy" class="form-control" placeholder="Nota"></textarea>
                                <label for="a_descripcion">Nota para la poliza:</label>
                            </div>
                        </div>


                    </div>



                    <div class="mt-5 mb-3">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('policies.index') }}" class="btn btn_blue btn-block"
                                    type="button">Cancelar</a>
                            </div>
                            <div class="col">
                                <button id="send_pay" type="button"
                                    class="btn btn_gold btn-block">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script src="{{ asset('js/policies.js') }}"></script>


        <script>
            $(document).ready(function() {

                $('#a_weight').mask("###0.00", {
                    reverse: true
                });
                $('#a_loanprice').mask("###0.00", {
                    reverse: true
                });
                $('#capital_pay').mask("###0.00", {
                    reverse: true
                });
                $('#contract_pay').mask("###0.00", {
                    reverse: true
                });
                $('#interest_pay').mask("###0.00", {
                    reverse: true
                });


                const gold = {!! json_encode($gold_rates) !!}

                $('#a_carat, #a_weight').on('change keyup', function() {
                    gold.forEach(element => {
                        if ($('#a_carat').val() == element.carat) {
                            let peso = $('#a_weight').val();
                            let carat_price = element.price;

                            let valued_price = peso * carat_price;

                            $('#a_valuedprice').val(valued_price.toFixed(2));
                            $('#a_loanprice').val(valued_price.toFixed(2));
                        }

                    });

                });

            });
        </script>

        {{-- Modal para guardar nuevo ciente en caso de que no exista --}}

    
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel" style="font-weight: bold"><i
                                class="fa-solid fa-user-plus mr-3 color-gold"></i>Crear Cliente</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        <button type="button" id="btn_close_modal_client" class="btn btn_blue" data-bs-dismiss="modal" onclick="clear_inputs_modalNewClient()">Cancelar</button>

                    </div>
                    <div class="modal-body">

                        <div class="div-view">
                            <div>
                                <form method="POST">

                                    <div class="row mb-2 align-items-center form-group">
                                        <div class="col-8 ">
                                            <input type="text" id="cedulapass_client" 
                                                class="form-control" placeholder="Cedula" aria-label="Cedula"
                                                data-mask="000-0000000-0">
                                        </div>
                                        <div class="col-4 ">
                                            <input type="checkbox" class="form-control" id="passced_chbox">
                                            <label id="passced_text" for="foreign">¿Pasaporte?</label>
                                        </div>
                                    </div>
                                    <div class="row mb-2 align-items-center">
                                        <div class="col">
                                            <input type="text" id="name_client" 
                                                class="form-control" placeholder="Nombre" aria-label="Nombre">
                                        </div>
                                        <div class="col">
                                            <input type="text" id="lastname_client" 
                                                class="form-control" placeholder="Apellidos" aria-label="Apellidos">
                                        </div>
                                    </div>
                                    <div class="row mb-2 align-items-center">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea id="address_client" class="form-control" placeholder="Escribe la direccion"
                                                    id="floatingTextarea"></textarea>
                                                <label for="floatingTextarea">Direccion</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">

                                        <div class="col">
                                            <select id="sex_client" class="form-select"
                                                aria-label="Sexo">
                                                <option value="" selected disabled>Selecciona Sexo</option>
                                                <option value="F">Femenino</option>
                                                <option value="M">Masculino</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select id="civil_status_client" class="form-select"
                                                aria-label="Sexo">
                                                <option value="" selected disabled>Selecciona Estado Civil
                                                </option>
                                                <option value="Soltero">Soltero
                                                </option>
                                                <option value="Casado">Casado</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-2">
                                        <div class="col">
                                            <input type="tel" id="phone_client" class="form-control"
                                                placeholder="Telefono 1" data-mask="000-000-0000">
                                        </div>
                                        <div class="col">
                                            <input type="tel" id="cellphone_client"
                                                class="form-control" placeholder="Telefono 2"
                                                data-mask="000-000-0000" >
                                        </div>
                                    </div>

                                    <div class="row mb-2 align-items-center">
                                        <div class="col">
                                            <input type="email" id="email_client" class="form-control"
                                                placeholder="Correo Electronico">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea id="description_client" class="form-control" placeholder="Descripcion"
                                                    id="floatingTextareaD"></textarea>
                                                <label for="floatingTextareaD">Descripcion</label>
                                            </div>
                                        </div>

                                        <div class="mt-5 mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" id="btn_saveClient" class="btn btn_gold btn-block" onclick="storeClient()">Guardar</button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>



</x-app-layout>
