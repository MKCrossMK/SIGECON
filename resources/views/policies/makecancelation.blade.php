<x-app-layout>



    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views text-center"><i class="fa-solid fa-ban mr-2 color-gold"></i></i>Cancelar
                Poliza</h1>
        </div>
        

        <div class="div-view-policies">
            <div>

            
                <form enctype="multipart/form-data" action="{{ route('policies.cancelation.store', $policy->id) }}" method="POST">
                    @csrf

                    <div>
                        <div class="mb-3">
                            <h1 class="page-title text-secondary-d1">
                                <small class="page-info">
                                    <i class="fa fa-angle-double-right text-80"></i>
                                    Nº Poliza : {{ $policy->number_policy }}
                                </small>
                            </h1>
                        </div>


                        <div class="row">
                            <div class="col-sm-6 table-responsive-md mb-5">
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Capital</th>
                                            <th>Monto Interes a pagar</th>
                                            <th>Monto Contrato a pagar</th>
                                            <th>Total a pagar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>{{ $policy->capital_pay }}</th>
                                            <td>{{ $policy->interest_pay }}</td>
                                            <td>{{ $policy->contract_pay }}</td>
                                            <td>{{ $policy->capital_pay + $policy->interest_pay + $policy->contract_pay }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6 table-responsive-md">
                                {{-- <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Base de Interes Mensual</th>
                                            <th>Base de Contrato</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>{{ $policy->base_interest_pay }}</th>
                                            <td>{{ $policy->base_contract_pay }}</td>
                                        </tr>
                                    </tbody>
                                </table> --}}
                                <table class="table table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center">Tasa de Interés</th>
                                            <th class="text-center">Tasa de Contrato</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th class="text-center">{{ $policy->interest_rate }} %</th>
                                            <th class="text-center">{{ $policy->contract_rate}} %</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                      
                    </div>

                    <div class="row mb-2 align-items-center">
                        {{-- <div class="col col_label_input_align">
                            <label for="date_start" class="date_title">Pagar intereses:</label>
                            <input type="number" id="amount_pay" name="amount_pay" class="form-control"
                                placeholder="Monto" aria-label="Monto a abonar" value="{{ old('amount_pay') }}" step="any">
                            @error('amount_pay')
                                <div id="alert" class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                        <div class="col col_label_input_align">
                            <button type="button" class="btn btn_danger font-bold" onclick="skipInterestRateMonth({{$policy->id}})">
                        <i class="fa-solid fa-chart-line mr-3"></i>Omitir Aumento de Tasa del Mes</button>
                        </div>
                    </div>




                    <div class="mt-5 mb-3">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('policies.index') }}" class="btn btn_blue btn-block"
                                    type="button">Cancelar</a>
                            </div>
                            <div class="col">
                                <button id="send_pay" type="submit"
                                    onclick="return confirm('Cancelar poliza, ¿Desea continuar?')""
                                    class="btn btn_gold btn-block">Realizar Cancelación</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        @if (Session::has('success'))
            <script type="text/javascript">
                Swal.fire(
                    'Excelente!',
                    '{{ session()->get('success') }}',

                );
            </script>
        @endif


        @if (Session::has('error'))
            <script type="text/javascript">
                Swal.fire(
                    'Error',
                    '{{ session()->get('error') }}',

                );
            </script>
        @endif

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

            });
        </script>


</x-app-layout>
