
<x-app-layout>

    <div class="container mt-3">


        <div class="page-content container">
            <div class="page-header text-blue-d2">
                <a href="{{ route('certifications.index') }}" id="btn_back_btn" class="btn btn_blue" title="Volver"><i
                        class="fa-sharp fa-solid fa-circle-arrow-left"></i></a>


                <div class="page-tools">
                    <div class="action-buttons">

                        <button onclick="window.print()" id="btn_print" class="btn btn_blue" data-title="Imprimir">
                            <i class="mr-1 fa-solid fa-print color-gold text-120 w-2 mr-3"></i>
                            Imprimir
                        </button>

                        <div class="cabecera-header" style="">
                            {{-- <img src="{{ asset('img/mp_logo.jpg') }}" class="" alt="" srcset=""> --}}
                        </div>
                    </div>
                </div>

          
            </div>
        </div>
        <div class="page-break">

            <div class="flex align-items-center justify-between">
                <div class="cabecera-header" style=""></div>
                <div class="cabecera-header" style="">
                    <img src="{{ asset('img/mp_logo.jpg') }}" class="" alt="" srcset="">
                </div>
                <div></div>
            </div>
            <div>

                <div class="cabecera-head text-center">
                    <h3><b>CAJA DE AHORROS PARA OBREROS Y MONTE DE PIEDAD</b></h3>

                    <h4><b>CERTIFICACIÓN DE PRENDA</b></h4>

                    {{-- <h5>RNC: 401007632 </h5>
                    <strong>Surcursal {{ $policy->branch_office->name }}</strong> --}}

                    <br>
                </div>

                <p class="text-right text-red-600 font-bold">{{$garmentCertification->nCertification()}}</p>


                <P class="" style="margin-top: 20%">Por este medio cerficamps que el día  <span class="font-bold">{{$garmentCertification->date_created()}}</span>, se presentó en la sucursal 
                <span class="font-bold">{{$garmentCertification->user->branch_office->name}}</span> de la Caja de Ahorros para Obreros y Monte de Piedad, 
                el(la) Señor(a):  <span class="font-bold">{{$garmentCertification->clients->fullname()}}</span>, Cedula No.: <span class="font-bold">{{$garmentCertification->clients->cedula}}</span> para probar el siguiente artículo que se describe a continuación:</P>

               

                <div class="row mt-4">
                    <div class="col">
                            <p class="font-bold">Objeto: <span class="font-normal"> {{$garmentCertification->description}}<span></p>
                            <p class="font-bold">Quilates: <span class="font-normal">{{$garmentCertification->carat}}</span></p>
                            <p class="font-bold">Peso: <span class="font-normal">{{$garmentCertification->weight}} Grms.</span></p>
                    </div>
                    <div class="col">
                        <img class="img_article_show" src="{{ asset($garmentCertification->image) }}" alt="">

                    </div>
                    
                </div>


                <p class="mt-3 mb-3 font-bold" >Observaciones: <span></span></p>
            </div>

            <div class="flex justify-center">
            </div>

            <div>
                <p>La Caja de Ahorros para Obreros y Monte de Piedad, no se hace responsable por la variación que pueda recibir la prenda certificada, después de que misma 
                    haya salido de nuestras oficinas. 
                </p>
                <p class="text-center font-bold">**No valido como titulo de propiedad**</p>
            </div>

           

            <br>


            <div class="container" style="margin-top: 20%">
                <div class="row">
                    <div class="col-sm font-bold">
                        <center>
                            <br>
    
                            ___________________________________________
                            <br>
                            Firma del Solicitante
                        </center>
    
                    </div>
                    <div class="col-sm font-bold">
                        <center>
                            <br>
    
                            ___________________________________________
                            <br>
                            Firma de Gerente
                        </center>
                    </div>
    
                </div>
    
                <div class="row">
                    <div class="col-sm font-bold">
                        <center>
                            <br>
    
                            ___________________________________________
                            <br>
                            Firma de Perito
                        </center>
    
                    </div>
                    <div class="col-sm font-bold">
                        <center>
                            <br>
    
                            ___________________________________________
                            <br>
                            Firma de Cajero
                        </center>
                    </div>
    
                </div>

                <div class="row" style="margin-top: 5%; border-style: groove; border-radius: 10px;">


                </div>



            </div>
        </div>
    </div>
</x-app-layout>
