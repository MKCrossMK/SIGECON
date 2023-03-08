<x-app-layout>

    <div class="container mt-3">


        <div class="page-content container">
            <div class="page-header text-blue-d2">
                <a href="{{ route('auctions.index') }}" id="btn_back_btn" class="btn btn_blue" title="Volver"><i
                        class="fa-sharp fa-solid fa-circle-arrow-left"></i></a>


                <div class="page-tools">
                    <div class="action-buttons">

                        <button onclick="window.print()" id="btn_print" class="btn btn_blue" data-title="Imprimir">
                            <i class="mr-1 fa-solid fa-print color-gold text-120 w-2 mr-3"></i>
                            Imprimir
                        </button>

                        <div class="cabecera-header" style="">
                            <img src="{{ asset('img/mp_logo.jpg') }}" class="" alt="" srcset="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-break">
            <div>

                <div class="cabecera-head text-center">
                    <h4><b>CAJA DE AHORROS PARA OBREROS Y MONTE DE PIEDAD</b></h4>

                    <h5><b>VENTA EN PÚBLICA SUBASTA</b></h5>
                    <h4><b>REMATE</b></h4>


                    {{-- <h5>RNC: 401007632 </h5>
                    <strong>Surcursal {{ $policy->branch_office->name }}</strong> --}}

                    <br>
                </div>


                <div class="row back_color_view">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle ">Celebración:</span>
                            <span class="text-600 text-110 align-middle text_gold">
                                {{ $auction->branchOffice->name }}</span>
                        </div>
                        <div class="text-grey-m2">
                            <span class="text-sm text-grey-m2 align-middle">Cantidad de participantes:</span>
                            <span class="my-1"><i
                                    class="text-600 text-110 fa-flip-horizontal text-secondary align-middle"></i>
                                <b class="">{{count($auction->participants) }}</b></span>
                        </div>
                        

                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end ">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">

                            <div class="my-2"><i class="text-blue-m2 text-xs mr-1"></i>
                                Fecha: <span class="text-600 text-90">{{ $auction->date_to_celebrate }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <p class="text-center mt-2 mb-2"><b>Prendas Subastadas</b><p>

                <table cellspacing="0" cellpadding="0">
                    <thead>
                      <tr>
                        <th class="no">#</th>
                        <th class="desc text-center">Descripcion</th>
                        <th>Comprador</th>
                        <th class="unit">Precio</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $count = 0;
                        ?>                      
                      @foreach($details as $detail)
                      <tr>
                          <td class="no">{{$count = $count + 1}}</td>
                          <td class="desc">Poliza: {{$detail->policy()->number_policy}} 
                             <small>
                                @foreach ($detail->policy()->policyDetails as $item)
                                    <ul style="list-style: circle">
                                        <li>{{$item->description}}, <b>Quilates: {{$item->carat}}</b> , <b>Peso: {{$item->weight}} grm</b></li>
                                    </ul>
                                @endforeach
                             </small>
                         </td>
                         <td>{{$detail->buyer->auctionParticipant->name}}</td>
                          <td class="unit">{{number_format($detail->auctioned_price, 2, '.', ',')}} DOP</td>
                      </tr> 
                      @endforeach
                    </tbody>
                
                  </table>

            </div>

            <div>



                <br>
                <ul>
                    {{-- @foreach ($policyDetails as $item)
                        <li> {{ $item->description . ' ; Peso: ' . $item->weight . ' ; Gramo:  ' . $item->carat }}</li>
                    @endforeach --}}

                </ul>
                <br>
            </div>

            <hr class="mt-3 mb-3">


                    <div class="row">
                        <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                             
                        </div>

                        <div class="col-12 col-sm-5 text-90 order-first order-sm-last">
                            <div class="row my-2">
                                <div class="col-6 text-right"
                                    style="font-family: Georgia, 'Times New Roman', Times, serif">
                                    Total:
                                </div>
                                <div class="col-6">
                                    <span class="text-120 text-secondary-d1"
                                        style="font-family: Georgia, 'Times New Roman', Times, serif">
                                        {{ number_format($total, 2, '.', ',') }} DOP </span>
                                </div>
                            </div>
                        </div>
                    </div>


            <br>


            <div class="col-sm">
                <center>
                    <br>

                    ___________________________________________
                    <br>
                   Firma Reprst. de Monte de Piedad
                </center>

            </div>

{{-- 
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <center>
                            <br>

                            ___________________________________________
                            <br>
                            Firma del Cliente
                        </center>

                    </div>
                    <div class="col-sm">
                        <center>
                            <br>

                            ___________________________________________
                            <br>
                            Representante de Monte de Piedad
                        </center>
                    </div>

                </div>
                <div class="row" style="margin-top: 5%; border-style: groove; border-radius: 10px;">


                </div>
            </div> --}}



        </div>
    </div>
</x-app-layout>
