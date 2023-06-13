<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views text-center"><i class="fa-solid fa-certificate mr-3 color-gold"></i>Nueva Certificación
            </h1>
        </div>

        <div class="div-view-policies">
            <div>
                <form action="{{ route('certifications.store') }}" id="certification_form" method="POST" enctype="multipart/form-data" >
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
                            <button type="button" id="btn_modalsaveclient" class="btn btn_search_client w-100"
                                data-bs-toggle="modal" data-bs-target="#staticBackdrop">Registrar nuevo cliente</button>

                        </div>
                    </div>


                    <div class="accordion mb-3" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fa-solid fa-gem mr-3 color-gold"></i> Prenda a certificar
                                    <i class="fa-solid fa-gem  color-gold ml-3"></i>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">

                                    <div id="articles_div">
                                        <div class="mb-2">
                                            <div class="row">
                                                @error('a_description')
                                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                 @enderror
                                                <div class="col">
                                                    <div class="form-floating txarea_desc">
                                                        <textarea id="a_description"  name="a_description" 
                                                        class="form-control txarea_desc">{{old("a_description")}}</textarea>
                                                        <label for="a_description">Descripcion de la prenda:</label>
                                                    </div>
                                             
                                                </div>
                                                <div class="col">
                                                    <div class="row align-items-center">
                                                        <label for="image">Imagen del articulo:</label>
                                                        {{-- <input type="file" id="a_image2" accept=".jpg,.jpeg,.png" class="form-control-file"> --}}
                                                        <img id="img_prev" class="img_article_add"
                                                            src="{{ asset('img/item_article_img.gif') }}"
                                                            alt="Articles Image" />
                                                        <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png"
                                                            class="form-control-file">
                                                    </div>
                                                @error('a_image')
                                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                 @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="form-group col">
                                                <label for="a_carat">Quilate (K):</label>
                                                <select type="text" id="a_carat" name="a_carat" class="form-control">
                                                    <option value="" selected disabled>Quilate (K)</option>
                                                    @foreach ($gold_rates as $gold)
                                                        <option @if (old('a_carat') ==  $gold->carat ) selected @endif value="{{ $gold->carat }}">{{ $gold->carat }}
                                                    @endforeach
                                                </select>
                                                @error('a_carat')
                                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                 @enderror
                                            </div>
                                            <div class="form-group col">
                                                <label for="a_stone_type">Tipo de piedra:</label>
                                                <select id="a_stone_type" name="a_stone_type" class="form-control">
                                                    <option value="No especificado" selected>Tipos de piedra</option>
                                                    <option @if(old('a_stonetype') == "Ninguno") selected @endif value="Ninguno">Ninguno</option>
                                                    <option @if (old('a_stonetype') == "Diamante") selected @endif value="Diamante">Diamante</option>
                                                    <option @if (old('a_stonetype') == "Zafiro") selected @endif value="Zafiro">Zafiro</option>
                                                    <option @if (old('a_stonetype') == "Esmeralda") selected @endif value="Esmeralda">Esmeralda</option>
                                                    <option @if (old('a_stonetype') == "Granate") selected @endif value="Granate">Granate</option>
                                                </select>
                                                @error('a_stone_type')
                                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group col">
                                                <label for="a_weight">Peso (Gramos-grs):</label>
                                                <input type="text" id="a_weight" name="a_weight" value="{{old('a_weight')}}" class="form-control" data-mask="###0.00">
                                                @error('a_weight')
                                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        @error('observations')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                     @enderror
                                        <div class="form-floating txarea_desc">
                                            <textarea id="observations"  name="observations" 
                                            class="form-control txarea_desc">{{old("observations")}}</textarea>
                                            <label for="observations">Observaciones:</label>
                                        </div>
                                 

                                        <div class="div_btn_add mt-3">
                                            <button type="button" id="submitCertification" class="btn btn_add w-100">Crear
                                                Certificación</button>
                                        </div>

                                        <hr class="mb-3">
                                        <hr class="mb-3">

                                        <div class="item-row"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel" style="font-weight: bold"><i
                                class="fa-solid fa-user-plus mr-3 color-gold"></i>Crear Cliente</h5>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                        <button type="button" id="btn_close_modal_client" class="btn btn_blue"
                            data-bs-dismiss="modal" onclick="clear_inputs_modalNewClient()">Cancelar</button>

                    </div>
                    <div class="modal-body">

                        <div class="div-view">
                            <div>
                                <form method="POST">

                                    <div class="row mb-2 align-items-center form-group">
                                        <div class="col-8 ">
                                            <input type="text" id="cedulapass_client" class="form-control"
                                                placeholder="Cedula" aria-label="Cedula" data-mask="000-0000000-0">
                                        </div>
                                        <div class="col-4 ">
                                            <input type="checkbox" class="form-control" id="passced_chbox">
                                            <label id="passced_text" for="foreign">¿Pasaporte?</label>
                                        </div>
                                    </div>
                                    <div class="row mb-2 align-items-center">
                                        <div class="col">
                                            <input type="text" id="name_client" class="form-control"
                                                placeholder="Nombre" aria-label="Nombre">
                                        </div>
                                        <div class="col">
                                            <input type="text" id="lastname_client" class="form-control"
                                                placeholder="Apellidos" aria-label="Apellidos">
                                        </div>
                                    </div>
                                    <div class="row mb-2 align-items-center">
                                        <div class="col-12">
                                            <div class="form-floating">
                                                <textarea id="address_client" class="form-control" placeholder="Escribe la direccion" id="floatingTextarea"></textarea>
                                                <label for="floatingTextarea">Direccion</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-2">

                                        <div class="col">
                                            <select id="sex_client" class="form-select" aria-label="Sexo">
                                                <option value="" selected disabled>Selecciona Sexo</option>
                                                <option value="F">Femenino</option>
                                                <option value="M">Masculino</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select id="civil_status_client" class="form-select" aria-label="Sexo">
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
                                            <input type="tel" id="cellphone_client" class="form-control"
                                                placeholder="Telefono 2" data-mask="000-000-0000">
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
                                                <textarea id="description_client" class="form-control" placeholder="Descripcion" id="floatingTextareaD"></textarea>
                                                <label for="floatingTextareaD">Descripcion</label>
                                            </div>
                                        </div>

                                        <div class="mt-5 mb-3">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" id="btn_saveClient"
                                                        class="btn btn_gold btn-block"
                                                        onclick="storeClient()">Guardar</button>
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

        <script src="{{ asset('js/certification.js') }}"></script>

</x-app-layout>
