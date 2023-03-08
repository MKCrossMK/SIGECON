<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Listado de Subasta</h1>
        </div>

        <div>
            <table class="table table-striped " id="policies_table">
                <thead>
                    <tr>
                        <th scope="col">Fecha de celebración</th>
                        <th scope="col">Sucusal de celebración</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auctions as $auction)
                        <tr>
                            <th scope="row">{{ $auction->date_to_celebrate }}</th>
                            <td>{{ $auction->branchOffice->name }}</td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('auctions.details.store', $auction->id) }}"
                                            class="btn see w-100"><i class="fa-solid fa-table-list mr-2"></i>Ver Detalles </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('auctions.list.see', $auction->id) }}"
                                            class="btn btn_gold w-100"><i class="fa-solid fa-list-ul mr-2"></i>Participantes </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('auctions.list.result', $auction->id) }}"
                                            class="btn btn-dark w-100"><i class="fa-solid fa-list-ul mr-2"></i>Remate</a>
                                    </div>
                                </div>
                                

                                
                            
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            <a href="{{ route('auctions.index') }}" class="btn btn_blue btn-block"
            type="button"><i class="fa-solid fa-circle-arrow-left mr-3"></i>Volver</a>
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
                    "searchPlaceholder": "Buscar subasta",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },

                },
                order: [[0, 'desc']]

            });

        });

   
    
    </script>


    @if (Session::has('success'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Genial!',
                text: "{{ session()->get('success') }}",
            });
        </script>
    @endif

    @if (Session::has('error'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'error',
                title: 'Ha ocurrido un error',
                text: "{{ session()->get('error') }}",
            });
        </script>
    @endif

    @if (Session::has('info'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'info',
                title: 'Info',
                text: "{{ session()->get('info') }}",
            });
        </script>
    @endif

    <script src="{{ asset('js/dashboard.js') }}"></script>
</x-app-layout>
