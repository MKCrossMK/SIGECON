<x-app-layout>

    <div id="border_container" class="page-content container">
        <div class="page-header text-blue-d2">
            <a id="btn_back_btn" href="{{ route('report.index') }}" class="btn btn_blue" title="Volver"><i
                    class="fa-sharp fa-solid fa-circle-arrow-left"></i></a>

            {{-- <h1 id="num_policy"  class="page-title text-secondary-d1">
                <small class="page-info">
                    <i class="fa fa-angle-double-right text-80"></i>
                    Nº Poliza : {{ $policy->number_policy }}
                </small>
            </h1> --}}

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

                <h5>RNC: 401007632 </h5>
                <strong class="uppercase">Surcursal {{ $branch_Office->name }}</strong>

                <br>
            </div>

        </div>

        <div>
            <h2 class="text-center font-bold uppercase">Reporte {{$start_date}} - </h2>
            <h3 class="text-right  font-bold">Fecha: <span class="ml-3">{{ date('d-m-Y / h:i A') }}</span></h3>

        </div>

        @if (count($policies) > 0 || count($p_payment) > 0 || count($p_renovation) > 0 || count($p_cancelation) > 0)


            @if (count($policies) > 0)
                <div class="mt-4">

                    <p class="font-bold text-120  mb-3">Polizas Certificadas</p>

                    <table class="table-fixed" id="table">
                        <thead class="">
                            <tr>
                                <th class="text-center" scope="col">No. Poliza</th>
                                <th class="text-center" scope="col">Fecha</th>
                                <th class="text-center" scope="col">Cliente</th>
                                <th class="text-center" scope="col">Capital Base</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($policies as $policie)
                                <tr>
                                    <td class="text-center">{{ $policie->number_policy }}</td>
                                    <td class="text-center">{{ $policie->date_start }} / {{ $policie->date_end }}</td>
                                    <td class="text-center">{{ $policie->clients->fullname() }}</td>

                                    <td class="text-center">{{ number_format($policie->loan_value, 2) }}</td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <p class="text-right font-bold"> Total: <span class="font-normal">{{number_format($t_policies, 2)}}</span></p>
                </div>
            @endif

            @if (count($p_payment) > 0)
                <div class="mt-4">

                    <p class="font-bold text-120  mb-3">Polizas Abonadas</p>

                    <table class="table-fixed" id="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No. Poliza</th>
                                <th class="text-center" scope="col">Fecha</th>
                                <th class="text-center" scope="col">Cliente</th>
                                <th class="text-center" scope="col">Abono</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($p_payment as $payment)
                                <tr>
                                    <td class="text-center">{{ $payment->policy->number_policy }}</td>
                                    <td class="text-center">{{ $payment->policy->date_start }} /
                                        {{ $payment->policy->date_end }}</td>
                                    <td class="text-center">{{ $payment->policy->clients->fullname() }}</td>
                                    <td class="text-center">{{ number_format($payment->amount, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <p class="text-right font-bold"> Total: <span class="font-normal">{{number_format($t_payment, 2)}}</span></p>

                </div>
            @endif

            @if (count($p_renovation) > 0)
                <div class="mt-4">

                    <p class="font-bold text-120  mb-3">Polizas renovadas</p>

                    <table class="table-fixed" id="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No. Poliza</th>
                                <th class="text-center" scope="col">Fecha</th>
                                <th class="text-center" scope="col">Cliente</th>
                                <th class="text-center" scope="col">Capital Base</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($p_renovation as $renovation)
                                <td class="text-center">{{ $renovation->policy->number_policy }}</td>
                                <td class="text-center">{{ $renovation->policy->date_start }} /
                                    {{ $renovation->policy->date_end }}</td>
                                <td class="text-center">{{ $renovation->policy->clients->fullname() }}</td>
                                <td class="text-center">{{ number_format($renovation->amount, 2) }}</td>
                            @endforeach
                        </tbody>
                    </table>
                    <p class="text-right font-bold"> Total: <span class="font-normal">{{number_format($t_renovation, 2)}}</span></p>

                </div>
            @endif


            @if (count($p_cancelation) > 0)
                <div class="mt-4">

                    <p class="font-bold text-120 mb-3">Polizas canceladas</p>

                    <table class="table-fixed" id="table">
                        <thead>
                            <tr>
                                <th class="text-center" scope="col">No. Poliza</th>
                                <th class="text-center" scope="col">Fecha</th>
                                <th class="text-center" scope="col">Cliente</th>
                                <th class="text-center" scope="col">Monto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($p_cancelation as $cancelation)
                                <td class="text-center">{{ $cancelation->policy->number_policy }}</td>
                                <td class="text-center">{{ $cancelation->policy->date_start }} /
                                    {{ $cancelation->policy->date_end }}</td>
                                <td class="text-center">{{ $cancelation->policy->clients->fullname() }}</td>
                                <td class="text-center">{{ number_format($cancelation->amount, 2) }}</td>
                            @endforeach

                        </tbody>
                    </table>
                    <p class="text-right font-bold"> Total: <span class="font-normal">{{number_format($t_cancelation, 2)}}</span></p>

                </div>
            @endif
        @else

        <h1 class="text-center font-bold">No hay datos que mostrar</h1>


        @endif
    </div>


    <script>
        const windowPrint = () => {
            window.print();
        }
    </script>


</x-app-layout>
