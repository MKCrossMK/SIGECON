<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Polizas de Sistemas Anteriores</h1>
        </div>

        <div>
            <a href="{{ route('old.policies.create') }}" class="btn btn_link w-100" ><i class="fa-solid fa-file-circle-plus mr-2 color-gold"></i> Nueva Poliza de Sistemas Anteriores <i class="fa-solid fa-arrow-up-right-from-square" style="float: right"></i></a>
        </div>

        <div class="mt-3 table-responsive">
            <table class="table table-striped " id="policies_table">
                <thead>
                    <tr>
                        <th scope="col">Numero de Poliza</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha de Inicio</th>
                        <th scope="col">Fecha de Fin</th>
                        <th scope="col">Sucursal</th>
                        <th scope="col">Valor prestado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($oldPolicies as $policy)
                        <tr>
                            <th scope="row"><a href="{{ route('old.policies.show', $policy->id)}}" style="text-decoration-line: none !important;">{{ $policy->number_policy }}</a></th>
                            <td>{{ $policy->clients->name . " " .  $policy->clients->lastname }}</td>
                            <td>{{ $policy->date_start }}</td>
                            <td>{{ $policy->date_end }}</td>
                            <td>{{ $policy->branch_office->name}}</td>
                            <td>{{ $policy->loan_value }}</td>
                            <td class="flex gap-2"> 
                                <a href="{{ route('old.policies.pay.create', $policy->id) }}" class="btn btn_blue" title="Abonar a la Poliza"><i class="fa-sharp fa-solid fa-file-invoice-dollar"></i></a>
                                <a href="{{ route('old.policies.renovation.create', $policy->id) }}" class="btn btn_gray" title="Renovar Poliza"><i class="fa-sharp fa-solid fa-arrow-rotate-right"></i></a>
                                <a href="{{ route('old.policies.cancelation.create', $policy->id) }}" class="btn btn_gold" title="Cancelar(pagar) Poliza"><i class="fa-sharp fa-solid fa-cash-register "></i></a>
                            

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#policies_table').DataTable({
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


                
            });
        });
    </script>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</x-app-layout>
