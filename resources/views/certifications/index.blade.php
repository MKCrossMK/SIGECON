<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Certificaciones</h1>
        </div>

        <div>
            <a href="{{ route('certifications.create') }}" class="btn btn_link w-100" >
                <i class="fa-solid fa-file-certificate mr-2 color-gold"></i> Nueva Certificación <i class="fa-solid fa-arrow-up-right-from-square" style="float: right"></i></a>
        </div>
    


        <div class="mt-3 table-responsive">
            <table class="table table-striped " id="client_table">
                <thead>
                    <tr>
                        <th scope="col">No. Certificación</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certifications as $certification)
                        <tr>
                            <th scope="row">{{ $certification->nCertification() }}</th>
                            <td>{{ $certification->clients->fullname()}}</td>
                            <td>{{ $certification->date_created()}}</td>
                            <td><a href="{{ route('certifications.show', $certification->id) }}" class="btn see w-100">Ver <i
                                        class="fa-solid fa-eye mr-2"></i></a></td>
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
                    "searchPlaceholder": "Buscar Certificaciones",
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
