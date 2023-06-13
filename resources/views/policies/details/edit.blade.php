<x-app-layout>


    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <h1 class="page-title text-secondary-d1">
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    Nº Poliza : {{ $policyDetail->policy->number_policy }}
                </small>
            </h1>
        </div>

        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <!-- .row -->


                    <div class="text-center text-150 badge-secondary mb-3">
                        <span class="text-default-d3">Editar de Articulo - Prenda </span>
                    </div>

                    <form action="{{ route('policies.detail.update', $policyDetail->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="item-row">
                            <div class="div_article mb-2 ">
                                <div class="row align-items-center">
                                    <div class="col-4">
                                        <img id="article_img" class="img-fluid img_article_edit mb-3" src="{{ asset($policyDetail->image) }}"
                                            alt="Imagen Articulo">

                                            <input class="form-control-file" type="file" name="image" id="input_edit_image" accept=".jpg,.jpeg,.png" hidden>
                                            <button type="button" class="btn btn-outline-dark w-100 mb-2" onclick="uploadFile()">Cargar Nueva Imagen</button>
                                            <button type="button" id="btn_cancel_img" class="btn btn-outline-danger w-100" onclick="CancelUploadFile()" hidden>Cancelar</button>

                                    </div>
                                    <div class="col">
                                        <textarea class="form-control w-100 mb-2" id="description" name="description" rows="5">{{ $policyDetail->description }}</textarea>
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group">
                                                    <span class="input-group-text input_border"
                                                        id="basic-addon1">Quilate (K):</span>
                                                    <input type="text"
                                                        id="carat"class="form-control input_border"
                                                        value="{{ $policyDetail->carat }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col">
                                                <select id="stone_type" name="stone_type" class="form-control">
                                                    <option @if ($policyDetail->stone_type  == "No especificado" ) selected @endif
                                                         value="No especificado" selected aria-readonly="">Tipos de piedra - No especificado</option>
                                                    <option @if ($policyDetail->stone_type  == "Diamante" ) selected @endif  value="Diamante">Diamante</option>
                                                    <option @if ($policyDetail->stone_type  == "Zafiro" ) selected @endif   value="Zafiro">Zafiro</option>
                                                    <option @if ($policyDetail->stone_type  == "Esmeralda" ) selected @endif   value="Esmeralda">Esmeralda</option>
                                                    <option @if ($policyDetail->stone_type  == "Granate" ) selected @endif   value="Granate">Granate</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col">
                                                <div class="input-group">
                                                    <span class="input-group-text input_border" id="basic-addon1">Peso
                                                        :</span>
                                                    <input type="text" id="weight"
                                                        class="form-control input_border"
                                                        value="{{ $policyDetail->weight }} Gramos" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="input-group">
                                                    <span class="input-group-text input_border" id="basic-addon1">P.
                                                        Valorado:</span>
                                                    <input type="text" id="valued_price"
                                                        class="form-control input_border"
                                                        value="DOP {{ number_format($policyDetail->valued_price) }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text input_border" id="basic-addon1">P.
                                                Préstamo:</span>
                                            <input type="text" id="loan_price"
                                                class="form-control input_border bold text-center"
                                                value="DOP {{ number_format($policyDetail->loan_price, 2, ',', ' ') }}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 mb-3">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('policies.show', $policyDetail->policy->id) }}" class="btn btn_blue btn-block"
                                        type="button">Volver</a>
                                </div>
                                <div class="col">
                                    <button id="save_policy" type="submit"
                                        onclick="return confirm('¿Seguro quiere actualizar este articulo?')""
                                        class="btn btn_gold btn-block">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>

    @if (Session::has('message'))
    <script type="text/javascript">
        new Notify({
            status: "success",
            title: "Excelente!",
            text: '{{ session()->get('message') }}',
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
    </script>
@endif



    <script>
        let image = document.getElementById("input_edit_image");
        let photo = document.getElementById("article_img");
        let btn_cancel = document.getElementById("btn_cancel_img");

        function uploadFile() {
            document.getElementById("input_edit_image").click();
        }

        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                photo.src = URL.createObjectURL(file)
            }
            btn_cancel.removeAttribute('hidden');
        }

        function CancelUploadFile(){
            photo.src = `{{ asset($policyDetail->image) }}` ;
            btn_cancel.setAttribute('hidden', 'true');

        }

        


    </script>


</x-app-layout>
