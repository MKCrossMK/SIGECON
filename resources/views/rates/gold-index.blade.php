<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Tasas del Oro</h1>
        </div>

        <div class="mt-3">
            <table class="table table-striped" id="client_table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Quilate (K)</th>
                        <th scope="col" class="text-center">Precio</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($gold_rate as $gold)
                        <tr>
                            <th scope="row" class="text-center">{{ $gold->carat }}</th>
                            <td class="text-center">{{ $gold->price}}</td>
        
                            <td><a href="{{ route('rate.gold.edit', $gold->id) }}" class="btn see w-100">
                                Editar <i class="fa-solid fa-pen mr-2"></i></a></td>
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
                    "searchPlaceholder": "Buscar Tasa de Oro",
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
