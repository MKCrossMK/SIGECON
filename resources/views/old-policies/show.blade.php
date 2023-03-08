<x-app-layout>


    <div class="page-content container">
        <div class="page-header text-blue-d2">
            <a href="{{ route('old.policies.index') }}" class="btn btn_blue" title="Volver"><i
                    class="fa-sharp fa-solid fa-circle-arrow-left"></i></a>

            <h1 class="page-title text-secondary-d1">
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    Nº Poliza : {{ $oldPolicy->number_policy }}
                </small>
            </h1>

            <div class="page-tools">
                <div class="action-buttons">

                    <a class="btn btn_blue" data-title="Imprimir">
                        <i class="mr-1 fa-solid fa-print color-gold text-120 w-2 mr-3"></i>
                        Imprimir
                    </a>
                </div>
            </div>
        </div>

        <div class="container px-0">
            <div class="row mt-4">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-center text-150 badge-dark">
                                <i class="fa-sharp fa-solid fa-gem"></i>
                                <span class="text-default-d3">Monte de Piedad</span>
                                <i class="fa-sharp fa-solid fa-gem"></i>
                            </div>
                        </div>
                    </div>
                    <!-- .row -->


                    <div class="row back_color_view">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle ">A:</span>
                                <span class="text-600 text-110 align-middle text_gold">
                                    {{ $oldPolicy->clients->name . ' ' . $oldPolicy->clients->lastname }}</span>
                            </div>
                            <div class="text-grey-m2">
                                <span class="text-sm text-grey-m2 align-middle">Cedula o Pasaporte:</span>
                                <span class="my-1"><i
                                        class="text-600 text-110 fa-flip-horizontal text-secondary align-middle"></i>
                                    <b class="">{{ $oldPolicy->clients->cedula }}</b></span>
                            </div>
                            <div class="my-1">
                                <i class="fa fa-phone fa-flip-horizontal text-secondary"></i> :
                                {{ $oldPolicy->clients->phone }}
                            </div>


                            @if ($oldPolicy->referrer_id != null)
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary text_bold w-75"
                                    style="color: black !important" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Referente
                                </button>
                            @endif
                        </div>
                        <!-- /.col -->

                        <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                            <hr class="d-sm-none" />
                            <div class="text-grey-m2">
                                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                    Poliza
                                </div>
                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                    Usuario Gestor: <span class="text-600 text-90">
                                        {{ $oldPolicy->users->name . ' ' . $oldPolicy->users->lastname }}</span>
                                </div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                    Fecha Emision: <span class="text-600 text-90">
                                        {{ date('d-m-Y', strtotime($oldPolicy->date_start)) }}</span>
                                </div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                    Fecha Vencimiento: <span
                                        class="text-600 text-90">{{ date('d-m-Y', strtotime($oldPolicy->date_end)) }}</span>
                                </div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                        class="text-600 text-90">Status:</span> <span
                                        class="badge @if($oldPolicy->status == 'Vencida') badge-danger @endif
                                        @if($oldPolicy->status == 'Renovada') badge-warning @endif
                                        @if($oldPolicy->status == 'Aprobada') badge-success @endif
                                        @if($oldPolicy->status == 'Subastada') badge-info @endif
                                        @if($oldPolicy->status == 'Cancelada') badge-dark @endif
                                        badge-pill px-25">{{ $oldPolicy->status }}</span>
                                    @if (Auth::user()->rol_id == 2)
                                        <button class="btn btn_blue" title="Editar Poliza"><i
                                                class="fa-sharp fa-solid fa-pen-to-square" data-bs-toggle="modal"
                                                data-bs-target="#update_status_form"></i></button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="text-center text-150 badge-secondary mb-3">
                        <span class="text-default-d3">Detalles de Articulos - Prendas </span>
                    </div>
                    @foreach ($oldPolicyDetails as $detail)
                        <div class="item-row">
                            <div class="div_article mb-2 ">
                                <div class="row align-items-center">
                                    <div class="col-3">
                                        @if ($detail->image == null)
                                            <img class="img-fluid img_article_show"
                                                src="{{ asset('img/img-noavble.jpg') }}" alt="Imagen Articulo">
                                        @else
                                            <img class="img-fluid img_article_show" src="{{ asset($detail->image) }}"
                                                alt="Imagen Articulo">
                                        @endif

                                    </div>
                                    <div class="col">
                                        <p>{{ $detail->description }}</p>
                                        <div class="row mb-2">
                                            <div class="col">
                                                <div class="input-group">
                                                    <span class="input-group-text input_border"
                                                        id="basic-addon1">Quilate (K):</span>
                                                    <input type="text"
                                                        id="carat"class="form-control input_border"
                                                        value="{{ $detail->carat }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="input-group">
                                                    <span class="input-group-text input_border" id="basic-addon1">T.
                                                        Piedra:</span>
                                                    <input type="text" id="stone_type"
                                                        class="form-control input_border"
                                                        value="{{ $detail->stone_type }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col">
                                                <div class="input-group">
                                                    <span class="input-group-text input_border" id="basic-addon1">Peso
                                                        :</span>
                                                    <input type="text" id="weight"
                                                        class="form-control input_border"
                                                        value="{{ $detail->weight }} Gramos" readonly>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="input-group">
                                                    <span class="input-group-text input_border" id="basic-addon1">P.
                                                        Valorado:</span>
                                                    <input type="text" id="valued_price"
                                                        class="form-control input_border"
                                                        value="DOP {{ number_format($detail->valued_price, 2, '.', ',') }}""
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-text input_border" id="basic-addon1">P.
                                                Préstamo:</span>
                                            <input type="text" id="loan_price"
                                                class="form-control input_border bold text-center"
                                                value="DOP {{ number_format($detail->loan_price, 2, '.', ',') }}"
                                                readonly>
                                        </div>
                                    </div>
                                    @if (Auth::user()->rol_id == 2)
                                        <div class="col-1">
                                            <a href="{{ route('old.policies.detail.edit', $detail->id) }}"
                                                class="btn btn_blue" title="Editar Articulo"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                        </div>
                                    @endif
                                   
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <hr class="mt-3 mb-3">


                    <div class="row">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">

                        </div>

                        <div class="col-12 col-sm-5 text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-7 text-right"
                                    style="font-family: Georgia, 'Times New Roman', Times, serif">
                                    Valor Prestado:
                                </div>
                                <div class="col-5">
                                    <span class="text-120 text-secondary-d1"
                                        style="font-family: Georgia, 'Times New Roman', Times, serif">DOP
                                        {{ number_format($oldPolicy->loan_value, 2, '.', ',') }} </span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Interes:
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1"
                                        style="font-family: Georgia, 'Times New Roman', Times, serif">DOP
                                        {{ number_format($oldPolicy->interest_pay, 2, '.', ',') }}</span>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-7 text-right">
                                    Contrato:
                                </div>
                                <div class="col-5">
                                    <span class="text-110 text-secondary-d1"
                                        style="font-family: Georgia, 'Times New Roman', Times, serif">DOP
                                        {{ number_format($oldPolicy->contract_pay, 2, '.', ',') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    @if (Auth::user()->rol_id == 2)
                        <!-- Modal -->
                        <div class="modal fade" id="update_status_form" tabindex="-1"
                            aria-labelledby="eupdate_status_formLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text_bold" id="update_status_formLabel">Editar Estado
                                            de Poliza
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form enctype="multipart/form-data"
                                            action="{{ route('old.policies.update', $oldPolicy->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <div class="col col_label_input_align">
                                                <label for="status" class="date_title">Estado de Poliza:</label>
                                                <select id="status" name="status" class="form-control">
                                                    <option value="" selected disabled>Seleccione el estado de la
                                                        poliza</option>
                                                    @foreach ($policiesStatus as $status)
                                                        <option @if ($oldPolicy->status == $status) selected @endif
                                                            value="{{ $status }}">{{ $status }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <input type="text" id="status" name="status" class="form-control"
                                                placeholder="Nº Poliza" aria-label="Fecha Inicio" value="{{old('number_policy')}}"> --}}
                                                @error('status')
                                                    <div id="alert" class="alert alert-danger text-center"
                                                        role="alert">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                            <div class="mt-5 mb-3">
                                                <div class="row">
                                                    <div class="col">
                                                        <button type="submit"
                                                            class="btn btn_gold btn-block">Actualizar Estado</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn_blue"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif




                    @if ($oldPolicy->referrer_id != null)
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text_bold" id="exampleModalLabel">Datos del Referente
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="div-view-referrer">
                                            <div class="text-center text-150 badge-light mb-3">
                                                <span class="text-default-d3 text_bold">Referente</span>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label for="">Cedula:</label>
                                                    <p class="text_bold">{{ $oldPolicy->referrer->cedula }}</p>
                                                </div>
                                                <div class="col">
                                                    <label for="">Nombre:</label>
                                                    <p class="text_bold">{{ $oldPolicy->referrer->name }}</p>
                                                </div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col">
                                                    <label>Telefono:</label>
                                                    <p class="text_bold">{{ $oldPolicy->referrer->phone }}</p>
                                                </div>
                                                <div class="col">
                                                    <label for="">Direccion:</label>
                                                    <p class="text_bold">{{ $oldPolicy->referrer->address }}</p>
                                                </div>
                                            </div>
                                            @if ($oldPolicy->referrer->note != null)
                                                <div class="row">
                                                    <div class="col">
                                                        <label>Nota:</label>
                                                        <p class="text-center text_bold">
                                                            {{ $oldPolicy->referrer->note }}</p>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn_blue"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    <div class="div-view-referrer mt-5">
                        <div class="text-center text-150 badge-dark mb-3">
                            <span class="text-default-d3 text_bold">Datos extra de la Poliza</span>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label for="" class="w-100 text-center">Tasa de Interés:</label>
                                <p class="text_bold text-center">{{ $oldPolicy->interest_rate }} %</p>
                            </div>
                            <div class="col">
                                <label for="" class="w-100 text-center">Tasa de Contrato:</label>
                                <p class="text_bold text-center">{{ $oldPolicy->contract_rate }} %</p>
                            </div>
                        </div>

                    </div>

                    {{-- Renovations of this policy --}}




                    @if ($oldPolicy->status_credit_pay == 1)

                        <div class="m-0 auto mt-5">
                            <button type="button"
                                class="btn bg-sky-100 hover:bg-cyan-600 hover:text-white text_bold w-100"
                                style="color: black !important" data-bs-toggle="modal" data-bs-target="#creditpay">
                                -- Detalle de Abonos --
                            </button>
                        </div>
                        <!-- Modal -->

                        <div class="modal fade" id="creditpay" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text_bold" id="exampleModalLabel">Abonos a poliza</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="mt-3 table-responsive">
                                            <table class="table table-striped " id="policies_table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Fecha de abono</th>
                                                        <th scope="col">Monto recibido</th>
                                                        <th scope="col">Ver</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($oldPolicy->creditPay as $pay)
                                                        <tr>
                                                            <td>{{ $pay->date_paid }}</td>
                                                            <td>{{ $pay->amount }}</td>

                                                            <td class="flex gap-2">
                                                                <a href="{{ route('old.policies.print.payment', $pay->id) }}"
                                                                    class="btn btn_blue"
                                                                    title="Ver abono de poliza"><i
                                                                        class="fa-sharp fa-solid fa-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn_blue"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($oldPolicy->status_renovation == 1)
                        <div class="m-0 auto mt-3">
                            <button type="button"
                                class="btn bg-yellow-100 hover:bg-yellow-600 hover:text-white text_bold w-100"
                                style="color: black !important" data-bs-toggle="modal"
                                data-bs-target="#renovationsModal">
                                -- Detalle de Renovaciones --
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="renovationsModal" tabindex="-1"
                            aria-labelledby="exampleModalLabelrenovationsModal" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text_bold" id="exampleModalLabelrenovationsModal">
                                            Renovaciones de la
                                            poliza</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mt-3 table-responsive">
                                            <table class="table table-striped " id="policy_renov_table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Fecha de Renovación</th>
                                                        <th scope="col">Monto recibido</th>
                                                        <th scope="col">Ver</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($oldPolicy->renovations as $renovation)
                                                        <tr>
                                                            <td>{{ $renovation->date_paid }}</td>
                                                            <td>{{ $renovation->amount }}</td>

                                                            <td class="flex gap-2">
                                                                <a href="{{ route('policies.print.renovation', $renovation->id) }}"
                                                                    class="btn btn_blue"
                                                                    title="Ver renovaciones de la poliza"><i
                                                                        class="fa-sharp fa-solid fa-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn_blue"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif


                    @if ($oldPolicy->status_cancelation == 1)
                        <div class="m-0 auto mt-3">
                            <button type="button"
                                class="btn bg-sky-100 hover:bg-cyan-600 hover:text-white text_bold w-100"
                                style="color: black !important" data-bs-toggle="modal"
                                data-bs-target="#cancelationsModal">
                                -- Detalle de Cancelación --
                            </button>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="cancelationsModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text_bold" id="exampleModalLabel">Cancelaciones</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <table class="table table-striped " id="policy_cancel_table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Fecha de Renovación</th>
                                                    <th scope="col">Monto recibido</th>
                                                    <th scope="col">Ver</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($oldPolicy->cancelations as $cancelation)
                                                    <tr>
                                                        <td>{{ $cancelation->date_paid }}</td>
                                                        <td>{{ $cancelation->amount }}</td>

                                                        <td class="flex gap-2">
                                                            <a href="{{ route('policies.print.cancelation', $cancelation->id) }}"
                                                                class="btn btn_blue"
                                                                title="Ver cancelación de la poliza"><i
                                                                    class="fa-sharp fa-solid fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>



                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn_blue"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif





                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#policies_table, #policy_renov_table').DataTable({
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "Mostrando _START_ to _END_ of _TOTAL_ entradas",
                    "searchPlaceholder": "Buscar Poliza",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },

                },
                order: [
                    [2, 'desc']
                ]

            });
        });
    </script>

    @if (Session::has('success'))
        <script type="text/javascript">
            Swal.fire(
                'Excelente!',
                '{{ session()->get('success') }}',

            );
        </script>
    @endif


</x-app-layout>
