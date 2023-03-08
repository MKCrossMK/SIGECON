<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Participantes de subastas</h1>
        </div>


        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa-solid fa-user-plus mr-3 color-gold"></i> Registrar Nuevo Participante
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('auctions.participants.store') }}" method="POST">
                            @csrf
                            @if (Session::has('message'))
                                <script type="text/javascript">
                                    Swal.fire(
                                        '¡Excelente!',
                                        '{{ session()->get('message') }}',

                                    );
                                </script>
                            @endif
                            <div class="row mb-2 align-items-center">
                                <div class="col-4">
                                    <input type="text" id="cedula" name="cedula" class="form-control"
                                        placeholder="Cedula" aria-label="Cedula" value="{{ old('cedula') }}"
                                        data-mask="000-0000000-0">
                                    @error('cedula')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                </div>
                                <div class="col-2">
                                    <input type="checkbox" class="form-control" id="foreign_chbox">
                                    <label id="foreign_text" for="foreign">¿Pasaporte?</label>
                                </div>
                                <div class="col-6">
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Nombre" aria-label="Nombre" value="{{ old('name') }}">
                                    @error('name')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            @if (is_countable($places) && count($places) > 0)
                                
                            <div class="row align-items-center mb-2">
                            
                                <div class="col">
                                    <select id="number_paddle" name="number_paddle" class="form-select">
                                        <option value="" selected>Seleccione numero de paleta</option>
                                        @foreach ($places as $place)
                                            <option @if (old('number_paddle') == $place) selected @endif value="{{$place}}">
                                            {{$place}}</option>
                                        @endforeach
                                    </select>
                                    @error('number_paddle')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                               
                            </div>
                            @endif

                            <div class="mt-3">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('auctions.index') }}" class="btn btn_blue btn-block"
                                            type="button">Cancelar</a>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn btn_gold btn-block">Registrar</button>
                                    </div>
                                </div>
                            </div>

                            
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <div class="mt-3">
            <table class="table table-striped " id="client_table">
                <thead>
                    <tr>
                        <th scope="col">Cedula</th>
                        <th scope="col">Nombre</th>
                        {{-- <th scope="col">Numero de Paleta</th> --}}
                        <th scope="col">Registrado por</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $participant)
                    @if ($participant->cedula != $mdp)

                        <tr>
                            <th scope="row">{{ $participant->cedula }}</th>
                            <td>{{ $participant->name }}</td>
                            <td>{{ $participant->user->fullname()}}</td>
                            <td>
                                <div class="row gap-2">
                                    <div class="col ">
                                        <a href="{{ route('auctions.participants.edit', $participant->id) }}" class="btn see w-100 h-100"><i
                                            class="fa-solid fa-pen mr-2 "></i> Editar </a>
                                    </div>
                                    <div class="col">
                                        <a href="{{ route('auctions.participants.send', $participant->id) }}" class="btn btn-dark  w-100"><i
                                            class="fa-solid fa-arrow-up-right-from-square mr-2"></i> Enviar a subasta </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif

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
                    "searchPlaceholder": "Buscar Cliente",
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

    <script src="{{ asset('js/dashboard.js') }}"></script>
</x-app-layout>
