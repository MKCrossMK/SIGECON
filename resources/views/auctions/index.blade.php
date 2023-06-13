<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Subastas</h1>
        </div>


        @if ($auction == false)

        <div class="accordion " id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa-solid fa-user-plus mr-3 color-gold"></i> Nueva Subasta
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show " aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('auctions.store') }}" method="POST">
                            @csrf
                            @if (Session::has('message'))
                                <script type="text/javascript">
                                    Swal.fire(
                                        '¡Excelente!',
                                        '{{ session()->get('message') }}',
                                    );
                                </script>
                            @endif


                            <div class="row mb-2">
                                <div class="col">
                                    <label class="total_label" for="">Fecha de celebración</label>
                                    <input type="date" id="date_to_celebrate" name="date_to_celebrate"
                                        class="form-control" placeholder="" value="{{ old('date_to_celebrate') }}">
                                    @error('date_to_celebrate')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea id="note" name="note" class="form-control h-100" placeholder="" id="floatingTextareaD">{{ old('description') }}</textarea>
                                        <label for="floatingTextareaD">Nota o descripción de subasta</label>
                                    </div>
                                    @error('note')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="floatingTextareaD" class="total_label">Lugar de celebración</label>
                                    <select id="branch_office_celebrate_id" name="branch_office_celebrate_id"
                                        class="form-select">
                                        <option value="">Selecciona Sucursal</option>
                                        @foreach ($branch_offices as $branches)
                                            <option @if (old('branch_office_celebrate_id') == $branches->id) selected @endif
                                                value="{{ $branches->id }}">{{ $branches->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('branch_office_celebrate_id')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label class="total_label" for="">Cupos</label>
                                    <input type="number" id="places" name="places"
                                        class="form-control" placeholder="" value="{{ old('places') }}">
                                    @error('places')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>


                            <div class="mt-3">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('dashboard') }}" class="btn btn_blue btn-block"
                                            type="button">Cancelar</a>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn_gold btn-block">Crear</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        @endif



        <div class="row mt-5 table-responsive">
            <div class="col ">
                <table class="table table-striped table-auto" id="policies_table">
                    <thead>
                        <tr>
                            <th scope="col">Numero de Poliza</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Fecha de Inicio</th>
                            <th scope="col">Fecha Vencimiento</th>
                            <th scope="col">Sucursal</th>
                            <th scope="col">Valor prestado</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($policies as $policy)
                            <tr>
                                <th scope="row">{{ $policy->number_policy }}</th>
                                <td>{{ $policy->clients->name . ' ' . $policy->clients->lastname }}</td>
                                <td>{{ $policy->date_start }}</td>
                                <td>{{ $policy->date_end }}</td>
                                <td>{{ $policy->branch_office->name }}</td>
                                <td>{{ $policy->loan_value }}</td>
                                <td>{{ $policy->status }}</td>
                                <td><a href="{{ route('auctions.details.store', $policy->id) }}"
                                    class="btn see w-100"><i class="fa-solid fa-money-bill-trend-up mr-2"></i>Enviar a Subasta ></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col mt-10">
                <table class="table table-striped" id="old_policies_table">
                    <thead>
                        <tr>
                            <th scope="col">Numero de Poliza</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Fecha de Inicio</th>
                            <th scope="col">Fecha Vencimiento</th>
                            <th scope="col">Sucursal</th>
                            <th scope="col">Valor prestado</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($old_policies as $old_policie)
                        <tr>
                            <th scope="row">{{ $old_policie->number_policy }}</th>
                            <td>{{ $old_policie->clients->name . ' ' . $old_policie->clients->lastname }}</td>
                            <td>{{ $old_policie->date_start }}</td>
                            <td>{{ $old_policie->date_end }}</td>
                            <td>{{ $old_policie->branch_office->name }}</td>
                            <td>{{ $old_policie->loan_value }}</td>
                            <td>{{ $old_policie->status }}</td>
                            <td><a href="{{ route('auctions.details.store.old', $old_policie->id) }}"
                                class="btn see w-100"><i class="fa-solid fa-money-bill-trend-up mr-2"></i>Enviar a Subasta </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <div class="m-0 auto mt-3">
                    <a href="{{ route('auctions.participants.index') }}" 
                        class="btn bg-sky-800 hover:bg-sky-500 text-white text_bold w-100"
                        >
                        -- Ver o Agregar participantes--
                    </a>
                </div>                

            </div>
            <div class="col">
                {{-- Policies to auction --}}
                <div class="m-0 auto mt-3">
                    <button type="button" class="btn bg-sky-800 hover:bg-sky-500 text-white text_bold w-100"
                        data-bs-toggle="modal" data-bs-target="#policiesModal">
                        -- Polizas a subastar --
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="policiesModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title text_bold" id="exampleModalLabel">Polizas a subastar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <table class="table table-striped " id="policies_auctions_table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Numero de Poliza</th>
                                            <th scope="col">Precio de primera puja</th>
                                            <th scope="col">Precio de articulo</th>
                                            <th scope="col">Enviado por</th>
                                            <th scope="col">Acciones</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($auction_details as $auction_detail)
                                            <tr>
                                                <th scope="row">{{ $auction_detail->policy()->number_policy  }}</th>
                                                
                                                @if ($auction_detail->first_bid_price)
                                                <td>{{ $auction_detail->first_bid_price }}</td>
                                                @else
                                                <td>No especificado</td>
                                                @endif

                                                @if ($auction_detail->auctioned_price)
                                                <td>{{ $auction_detail->auctioned_price }}</td>
                                                @else
                                                <td>No especificado</td>
                                                @endif

                                                <td>{{ $auction_detail->user->name . " " . $auction_detail->user->lastname }}</td>


                                                <td><a href="{{ route('auctions.details.edit', $auction_detail->id) }}"
                                                    class="btn see w-100"><i class="fa-solid fa-pen mr-2"></i>Precio 1ra puja</a></td>

                                                <td><a href="{{ route('auctions.details.delete', $auction_detail->id) }}"
                                                    class="btn bg-red-700 text-white h-full w-100"><i class="fa-solid fa-trash mr-2"></i>Eliminar </a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn_blue" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

       

        <div class="row">
            <div class="col">
                 {{-- Policies to auction --}}
                 <div class="m-0 auto mt-3">
                    <button type="button" class="btn bg-black text-white color-gold text_bold w-100"
                         data-bs-toggle="modal" data-bs-target="#participantModal">
                        -- Participantes de la subasta --
                    </button>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="participantModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content ">
                            <div class="modal-header">
                                <h5 class="modal-title text_bold" id="exampleModalLabel">Participantes de la Subasta</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body ">

                                <table class="table table-striped e" id="participant_table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Numero de paleta</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($participants as $participant)
                                            <tr>
                                                <th scope="row">{{ $participant->auctionParticipant->name  }}</th>
                                                <td>{{$participant->number_paddle}}</td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col">
                                                            <a href="{{ route('auctions.participants.edit', $participant->id) }}"
                                                                class="btn see w-100"><i class="fa-solid fa-pen mr-2"></i>Editar </a>
                                                        </div>
                                                        <div class="col">
                                                            <a href="{{ route('auctions.participants.delete', $participant->id) }}"
                                                                class="btn btn_delete w-100"><i class="fa-solid fa-trash mr-2"></i>Eliminar </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn_blue" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="col">
                <div class="m-0 auto mt-3">
                    <a href="{{ route('auctions.start') }}" onclick="return confirm('¿Seguro quiere iniciar la subasta?');" type="button"
                        class="btn bg-black hover:bg-green-600 text-white hover:text-blue-600 text_bold w-100">
                        -- Iniciar Subasta --
                    </a>
                </div>                
            </div>

        </div>
     
        <a href="{{ route('auctions.list') }}" class="btn btn_add btn-block mt-3">Ver Subastas</a>

    </div>

    {{-- Button flotante --}}

    {{-- <button onclick="buttonHandler()" title="Contact Sale"
    class="fixed z-90 bottom-10 right-8 bg-blue-600 w-20 h-20 rounded-full drop-shadow-lg
     flex justify-center items-center text-white text-4xl hover:bg-blue-700 hover:drop-shadow-2xl
      hover:animate-bounce duration-300"></button> --}}


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

                }
            });

            $('#participant_table').DataTable({
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

                }
            });

            $('#old_policies_table').DataTable({
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "Mostrando _START_ to _END_ of _TOTAL_ entradas",
                    "searchPlaceholder": "Buscar Poliza Antigua",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },

                }
            });

            $('#policies_auctions_table').DataTable({
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "Mostrando _START_ to _END_ of _TOTAL_ entradas",
                    "searchPlaceholder": "Buscar Poliza Antigua",
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
