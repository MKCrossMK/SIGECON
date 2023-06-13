<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Detalles de Cliente </h1>
        </div>
        <div class="title_div">
            <h1 class="client_name">{{$client->name . " " . $client->lastname }}</h1>
            <h1 class="client_cedula"><span style="font-weight: normal">Cedula: </span> {{$client->cedula }}</h1>
            <a href="{{ route('clients.edit', $client->id) }}" class="btn btn_gold"><i class="fa-solid fa-file-pen mr-2"></i>Editar datos del Cliente</a>

        </div>

        @if (Session::has('message'))
                        <script type="text/javascript">
                            Swal.fire(
                                'Excelente!',
                                '{{ session()->get('message') }}',

                            );
                        </script>
                    @endif


        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa-solid fa-user-plus mr-3 color-gold"></i> Polizas 
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <div class="mt-3">
                            <table class="table table-striped " id="client_table">
                                <thead>
                                    <tr>
                                        <th scope="col">Numero de Poliza</th>
                                        <th scope="col">Fecha de Inicio</th>
                                        <th scope="col">Fecha de Fin</th>
                                        <th scope="col">Sucursal</th>
                                        <th scope="col">Valor prestado</th>
                                        <th scope="col">Estado</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($policies as $policy)
                                    <tr>
                                        <th scope="row"><a href="{{ route('policies.show', $policy->id)}}" style="text-decoration-line: none !important;">{{ $policy->number_policy }}</a></th>
                                        <td>{{ $policy->date_start }}</td>
                                        <td>{{ $policy->date_end }}</td>
                                        <td>{{ $policy->branch_office->name}}</td>
                                        <td>{{ $policy->loan_value }}</td>
                                        <td>
                                            @if ($policy->status === "Aprobada")
                                            <span class="bg-green-200 text-green-800 font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                {{ $policy->status }}
                                            </span>
                                            @endif
                                            @if ($policy->status === "Cancelada")
                                            <span class="bg-red-200 text-red-800 font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                {{ $policy->status }}
                                            </span>
                                            @endif
                                            @if ($policy->status === "Renovada")
                                            <span class="bg-blue-200 text-blue-800 font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                {{ $policy->status }}
                                            </span>
                                            @endif
                                            @if ($policy->status === "Vencida")
                                            <span class="bg-yellow-200 text-yellow-800 font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                {{ $policy->status }}
                                            </span>
                                            @endif
                                            @if ($policy->status === "Subastada")
                                            <span class="bg-orange-200 text-orange-800 font-bold mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                                {{ $policy->status }}
                                            </span>
                                            @endif
                                        
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                       

                    </div>
                </div>
            </div>
        </div>


     

    <script>
        $(document).ready(function() {
            $('#client_table').DataTable({
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "Mostrando _START_ to _END_ of _TOTAL_ entradas",
                    "searchPlaceholder": "Buscar ",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },

                }
            });
        });
    </script>

    <script src="{{ asset('js/dashboard.js') }}"></script>
</x-app-layout>
