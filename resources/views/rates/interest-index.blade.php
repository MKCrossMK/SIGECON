<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Tasas de Interés</h1>
        </div>

        <div class="mt-3">
            <table class="table table-striped " id="interest_table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Porciento (%)</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($interestRate as $interest)
                        <tr>
                            <th class="text-center">{{ $interest->porcent}}</td>
        
                            <td><a href="{{ route('rate.interest.edit', $interest->id) }}" class="btn see w-100">
                                Editar <i class="fa-solid fa-pen mr-2"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#interest_table').DataTable({
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "Mostrando _START_ to _END_ of _TOTAL_ entradas",
                    "searchPlaceholder": "Buscar Tasa Interés",
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
