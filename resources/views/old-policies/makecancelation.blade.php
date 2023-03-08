<x-app-layout>



    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views text-center"><i class="fa-solid fa-ban mr-2 color-gold"></i></i>Registrar Cancelacion
                Poliza</h1>
        </div>


        <div class="div-view-policies">
            <div>



                <form enctype="multipart/form-data" action="{{ route('old.policies.cancelation.store', $oldPolicy->id) }}"
                    method="POST">
                    @csrf

                    <div>
                        <div class="mb-3">
                            <h1 class="page-title text-secondary-d1">
                                <small class="page-info">
                                    <i class="fa fa-angle-double-right text-80"></i>
                                    Nº Poliza : {{ $oldPolicy->number_policy }}
                                </small>
                            </h1>
                        </div>



                    </div>


                    <div class="row mb-2 align-items-center">
                        <div class="col col_label_input_align">
                            <label for="date_paid" class="date_paid">Fecha de Cancelación:</label>
                            <input type="date" id="date_paid" name="date_paid" class="form-control"
                                placeholder="Monto" aria-label="Monto a abonar" value="{{ old('amount_pay') }}">
                            @error('date_paid')
                                <div id="alert" class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col col_label_input_align">
                            <label for="date_start" class="date_title">Monto pagado para Cancelación:</label>
                            <input type="number" id="amount_pay" name="amount_pay" step="any" class="form-control"
                                placeholder="Monto" aria-label="Monto a abonar" value="{{ old('amount_pay') }}">
                            @error('amount_pay')
                                <div id="alert" class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-12 mt-2">
                            <textarea class="form-control"cols="" rows="3"
                                placeholder="Nota de renovación ---" name="cancelation_note">{{old('cancelation_note')}}</textarea>
                        </div>
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
