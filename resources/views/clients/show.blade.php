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
                                        <th scope="col">Cedula</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Telefono</th>
                                        <th scope="col">Correo Electronico</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Cedula</th>
                                        <td>Name</td>
                                        <td>Phone</td>
                                        <td>Email</td>
                                        <td><a href="#" class="btn see w-100">Ver <i class="fa-solid fa-eye mr-2"></i></a></td>
                                    </tr>
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
