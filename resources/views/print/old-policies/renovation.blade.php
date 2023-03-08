<x-app-layout>


    <div id="border_container" class="page-content container">
        <div class="page-header text-blue-d2">
            <a id="btn_back_btn" href="{{ route('old.policies.index') }}" class="btn btn_blue" title="Volver"><i
                    class="fa-sharp fa-solid fa-circle-arrow-left"></i></a>

            <h1 id="num_policy"  class="page-title text-secondary-d1">
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    Nº Poliza : {{ $oldPolicy->number_policy }}
                </small>
            </h1>

            <div class="page-tools">
                <div class="action-buttons">

                    <button id="btn_print" onclick="windowPrint()" class="btn btn_blue" data-title="Imprimir">
                        <i class="mr-1 fa-solid fa-print color-gold text-120 w-2 mr-3"></i>
                        Imprimir
                    </button>
                </div>
            </div>
        </div>
        <div>
            <div class="cabecera-header" style="position: absolute;">
                <img src="{{ asset('img/mp_logo.jpg') }}" class="" alt="" srcset="">
            </div>


            <div class="cabecera-head text-center">
                <h4><b>CAJA DE AHORROS PARA OBREROS Y MONTE DE PIEDAD</b></h4>

                <h5><b>PÓLIZA DE EMPEÑO AL PORTADOR</b></h5>

                <h5>RNC: 401007632 </h5>
                <strong class="uppercase">Surcursal {{ $oldPolicy->branch_office->name }}</strong>

                <br>
            </div>
            
        </div>

        <div>
            <h2 class="text-center font-bold uppercase">Renovación a Poliza</h2>
            <h3 class="text-right  font-bold">Fecha: <span class="ml-3">{{date('d-m-Y', strtotime($oldPolicyRenovation->date_paid))}}</span></h3>        
            <h3 class="text-right">{{$oldPolicyRenovation->policy->branch_office->province}}</span></h3>        

        </div>

        <div class="mt-5">
            <h2 class="font-bold uppercase">Nombre: <span class="font-normal uppercase">{{$oldPolicy->clients->name . " " . $oldPolicy->clients->lastname}}</span></h2>
            <h3 class="font-bold uppercase">Cedula: <span class="font-normal">{{$oldPolicy->clients->cedula}}</h3>
        </div>

        <div class="mt-5">
            <h2 class="font-bold">Poliza No: <span class="ml-3">&nbsp; {{$oldPolicy->number_policy}}</span></h2>
        </div>


        <div class="mt-5 mb-5">
            <h2 class="font-bold">Fecha de Otorgamiento: <span class="font-normal ml-3">&nbsp; {{$oldPolicy->date_start}}</span></h2>
            <h3 class="font-bold ">Fecha de Vencimiento: <span class="font-normal ml-3">&nbsp;&nbsp; &nbsp;&nbsp;{{$oldPolicy->date_end}}</span></h3>
        </div>

      

        <div class="row mt-2">
            <div class="col">
                <center>
                    <br>

                    ___________________________________________
                    <br>
                    Recibido por
                </center>
                
            </div>
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">Monto recibido:</th>
                            <td class="text-center" scope="col">DOP {{number_format($oldPolicyRenovation->amount, 2)}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center">Balance capital:</td>
                            <td class="text-center">DOP {{ number_format($oldPolicyRenovation->policy->capital_pay, 2)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- <div class="mt-5">
            <p class="text-center text-sm">{{$policyPayment->policy->branch_office->address}}, {{$policyPayment->policy->branch_office->province}}</p>
        </div> --}}


    </div>


    <script>
        const windowPrint = () => {
            window.print();
        }
    </script>


</x-app-layout>
