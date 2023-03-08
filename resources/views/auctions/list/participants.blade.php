<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Participantes de subasta </h1>
        </div>

        <h1 class="page-title text-secondary-d1">
            <small class="page-info">
                <i class="fa fa-angle-double-right text-80"></i>
                Subasta de : {{ $auction->date_to_celebrate}}
            </small>
        </h1>

        <div class="mt-5">
            <table class="table table-striped " id="policies_table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center" >Nombre</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $participant)
                        <tr>
                            <th scope="row" class="text-left">{{ $participant->auctionParticipant->name }} : <small>{{ $participant->auctionParticipant->cedula }}</small></th>
                            <td >
                                @if (count($participant->policiesBought) > 0)
                                    <a href="{{ route('auctions.invoice.participant', $participant->id) }}"
                                    class="btn see w-100"><i class="fa-solid fa-file-invoice mr-2"></i>Factura</a>
                                @endif
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
                    "searchPlaceholder": "Buscar subasta",
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
