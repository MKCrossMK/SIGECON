<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views text-center"><i class="fa-solid fa-user-pen mr-3 color-gold"></i>Agregar Precio de Primera Puja</h1>
        </div>

        <h1 class="page-title text-secondary-d1 mt-5 mb-5">
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                Nº Poliza : {{ $auctionDetail->policy()->number_policy }}
            </small>
        </h1>

        <div class="div-view">
            
            <div>
                <form action="{{ route('auctions.details.update.price', $auctionDetail->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @if (Session::has('message'))
                        <script type="text/javascript">
                            Swal.fire(
                                'Excelente!',
                                '{{ session()->get('message') }}',

                            );
                        </script>
                    @endif

                    

                    <div class="row mb-2 align-items-center">
                        <div class="row mb-2 align-items-center">
                            <div class="col">
                                <input type="number" id="first_bid_price" name="first_bid_price" class="form-control"
                                    placeholder="Precio primera puja" aria-label="Precio de primera puja" value="{{$auctionDetail->first_bid_price}}">
                                @error('first_bid_price')
                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                
                        </div>
                    <div class="mt-5 mb-3">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('auctions.index') }}" class="btn btn_blue btn-block"
                                    type="button">Volver</a>
                            </div>
                            <div class="col">
                                <button onclick="return confirm('¿Está seguro de actualizar precio de primera puja y que éste es su precio?');"
                                 type="submit" class="btn btn_gold btn-block">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="accordion accordion-flush mb-3" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed font-bold" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                        aria-controls="flush-collapseOne">
                        <i class="fa-solid fa-address-book mr-3 color-gold"></i> Datos de la Poliza
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse"
                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        
                    <div class="row back_color_view">
                        <div class="col-sm-6">
                            <div>
                                <span class="text-sm text-grey-m2 align-middle ">A:</span>
                                <span class="text-600 text-110 align-middle text_gold">
                                    {{ $auctionDetail->policy()->clients->name . ' ' . $auctionDetail->policy()->clients->lastname }}</span>
                            </div>
                            <div class="text-grey-m2">
                                <span class="text-sm text-grey-m2 align-middle">Cedula o Pasaporte:</span>
                                <span class="my-1"><i
                                        class="text-600 text-110 fa-flip-horizontal text-secondary align-middle"></i>
                                    <b class="">{{  $auctionDetail->policy()->clients->cedula }}</b></span>
                            </div>
                            <div class="my-1">
                                <i class="fa fa-phone fa-flip-horizontal text-secondary"></i> :
                                {{  $auctionDetail->policy()->clients->phone }}
                            </div>                    
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
                                        {{  $auctionDetail->policy()->users->fullname()}}</span>
                                </div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                    Fecha Emision: <span class="text-600 text-90"> {{ $auctionDetail->policy()->date_start }}</span>
                                </div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i>
                                    Fecha Vencimiento: <span class="text-600 text-90">{{ $auctionDetail->policy()->date_end }}</span>
                                </div>

                                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span
                                        class="text-600 text-90">Status:</span> <span
                                        class="badge @if( $auctionDetail->policy()->status == 'Vencida') badge-danger @endif
                                        @if( $auctionDetail->policy()->status == 'Renovada') badge-warning @endif
                                        @if( $auctionDetail->policy()->status == 'Aprobada') badge-success @endif
                                        @if( $auctionDetail->policy()->status == 'Subastada') badge-info @endif
                                        @if( $auctionDetail->policy()->status == 'Cancelada') badge-dark @endif
                                          badge-pill px-25">{{ $auctionDetail->policy()->status }}</span></div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>

                    <div class="text-center text-150 badge-secondary mb-3">
                        <span class="text-default-d3">Detalles de Articulos - Prendas </span>
                    </div>
                    @foreach ( $auctionDetail->policy()->policyDetails as $detail)
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
                                            <a href="{{ route('policies.detail.edit', $detail->id) }}"
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
                            <div class="row my-2">
                                <div class="col-6 text-right"
                                    style="font-family: Georgia, 'Times New Roman', Times, serif">
                                    Capital en deuda:
                                </div>
                                <div class="col-6">
                                    <span class="text-120 text-secondary-d1"
                                        style="font-family: Georgia, 'Times New Roman', Times, serif">DOP
                                        {{ number_format( $auctionDetail->policy()->capital_pay, 2, '.', ',') }} </span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-6 text-right">
                                    Interes en deuda:
                                </div>
                                <div class="col-6">
                                    <span class="text-110 text-secondary-d1"
                                        style="font-family: Georgia, 'Times New Roman', Times, serif">DOP
                                        {{ number_format( $auctionDetail->policy()->interest_pay, 2, '.', ',') }}</span>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-6 text-right">
                                    Contrato en deuda:
                                </div>
                                <div class="col-6">
                                    <span class="text-110 text-secondary-d1"
                                        style="font-family: Georgia, 'Times New Roman', Times, serif">DOP
                                        {{ number_format( $auctionDetail->policy()->contract_pay, 2, '.', ',') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-sm-5 text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-6 text-right"
                                    style="font-family: Georgia, 'Times New Roman', Times, serif">
                                    Valor Prestado:
                                </div>
                                <div class="col-6">
                                    <span class="text-120 text-secondary-d1"
                                        style="font-family: Georgia, 'Times New Roman', Times, serif">DOP
                                        {{ number_format( $auctionDetail->policy()->loan_value, 2, '.', ',') }} </span>
                                </div>
                            </div>

                            <div class="row my-2">
                                <div class="col-6 text-right">
                                    Interes:
                                </div>
                                <div class="col-6">
                                    <span class="text-110 text-secondary-d1"
                                        style="font-family: Georgia, 'Times New Roman', Times, serif">DOP
                                        {{ number_format( $auctionDetail->policy()->c_interest_pay, 2, '.', ',') }}</span>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-6 text-right">
                                    Contrato:
                                </div>
                                <div class="col-6">
                                    <span class="text-110 text-secondary-d1"
                                        style="font-family: Georgia, 'Times New Roman', Times, serif">DOP
                                        {{ number_format( $auctionDetail->policy()->c_contract_pay, 2, '.', ',') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>


                    </div>
                </div>
            </div>
        </div>


</x-app-layout>
