<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Reportes de Sucursales</h1>
        </div>

        <div class="mt-3 table-responsive">
            <table class="table table-striped" id="client_table">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Sucursal</th>
                        <td class="text-center">Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($branch_offices as $office)
                        <tr>
                            <th class="text-center" scope="row">{{ $office->name }}</th>
                            <td><a href="{{ route('report.view', $office->id) }}" class="btn see w-100">Ir <i
                                        class="fa-solid fa-right-from-bracket mr-2"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                    "searchPlaceholder": "Buscar Sucursal",
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

</x-app-layout>
