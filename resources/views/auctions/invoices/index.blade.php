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

                    {{-- <h5>RNC: 401007632 </h5>
                    <strong>Surcursal {{ $policy->branch_office->name }}</strong> --}}

                    <br>
                </div>

                <div class="row back_color_view">
                    <div class="col-sm-6">
                        <div>
                            <span class="text-sm text-grey-m2 align-middle ">Participante:</span>
                            <span class="text-600 text-110 align-middle text_gold">
                                {{ $participant->auctionParticipant->name }}</span>
                        </div>
                        <div class="text-grey-m2">
                            <span class="text-sm text-grey-m2 align-middle">Cedula o Pasaporte:</span>
                            <span class="my-1"><i
                                    class="text-600 text-110 fa-flip-horizontal text-secondary align-middle"></i>
                                <b class="">{{$participant->auctionParticipant->cedula }}</b></span>
                        </div>
                        <div class="my-1">
                             Paleta:
                            {{ $participant->number_paddle}}
                        </div>

                    </div>
                    <!-- /.col -->

                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end ">
                        <hr class="d-sm-none" />
                        <div class="text-grey-m2">

                            <div class="my-2"><i class="text-blue-m2 text-xs mr-1"></i>
                                Fecha: <span class="text-600 text-90">{{ $participant->auction->date_to_celebrate }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>

                <table cellspacing="0" cellpadding="0">
                    <thead>
                      <tr>
                        <th class="no">#</th>
                        <th class="desc text-center">Descripcion</th>
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
                          <td class="unit">{{$detail->auctioned_price}}</td>
                      </tr> 
                      @endforeach
                    </tbody>
                
                  </table>

                {{-- <div class=" pull-right" style="">
                    <center> <img class="img" src="" style="margin-top: 2%;" />
                    </center>

                    <center>
                        <h4 class="mb-2">Póliza no. {{ $policy->number_policy }} &nbsp &nbsp
                            &nbsp</h4>
                    </center>

                    <h6 style="padding-left:5%;">Fecha de Emisión: {{ date('d-m-Y', strtotime($policy->date_start)) }}
                    </h6>

                    <h6 style="padding-left:5%;">Fecha Venc: {{ date('d-m-Y', strtotime($policy->date_end)) }} </h6>
                </div> --}}
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




            <br>


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



            </div>
        </div>
    </div>
</x-app-layout>
