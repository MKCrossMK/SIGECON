<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Clientes</h1>
        </div>


        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa-solid fa-user-plus mr-3 color-gold"></i> Registrar Nuevo Cliente
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('clients.store') }}" method="POST">
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
                                <div class="col-3">
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
                                <div class="col-3">
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Nombre" aria-label="Nombre" value="{{ old('name') }}">
                                    @error('name')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <input type="text" id="lastname" name="lastname" class="form-control"
                                        placeholder="Apellidos" aria-label="Apellidos" value="{{ old('lastname') }}">
                                    @error('lastname')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row align-items-center mb-2">
                                <div class="col">
                                    <div class="form-floating">
                                        <textarea id="address" name="address" class="form-control" placeholder="Escribe la direccion" id="floatingTextarea">{{ old('address') }}</textarea>
                                        <label for="floatingTextarea">Direccion</label>
                                    </div>
                                    @error('address')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <select id="sex" name="sex" class="form-select" aria-label="Sexo">
                                        <option value="" selected disabled>Selecciona Sexo</option>
                                        <option @if (old('sex') == 'F') selected @endif value="F">
                                            Femenino</option>
                                        <option @if (old('sex') == 'M') selected @endif value="M">
                                            Masculino</option>
                                    </select>
                                    @error('sex')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <select id="civil_status" name="civil_status" class="form-select" aria-label="Sexo">
                                        <option value="" selected disabled>Selecciona Estado Civil</option>
                                        <option @if (old('civil_status') == 'Soltero') selected @endif value="Soltero">
                                            Soltero</option>
                                        <option @if (old('civil_status') == 'Casado') selected @endif value="Casado">Casado
                                        </option>
                                    </select>
                                    @error('civil_status')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <input type="tel" id="phone" name="phone" class="form-control"
                                        placeholder="Telefono 1" value="{{ old('phone') }}" data-mask="000-000-0000">
                                    @error('phone')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="tel" id="cellphone" name="cellphone" class="form-control"
                                        placeholder="Telefono 2" value="{{ old('cellphone') }}"
                                        data-mask="000-000-0000">
                                </div>
                                <div class="col">
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="Correo Electronico" value="{{ old('email') }}">
                                    @error('email')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea id="description" name="description" class="form-control" placeholder="Descripcion"
                                            id="floatingTextareaD">{{ old('description') }}</textarea>
                                        <label for="floatingTextareaD">Descripcion</label>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <div class="row">
                                        <div class="col">
                                            <a href="#" class="btn btn_blue btn-block" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne"
                                                onclick="cancelNewClient()">Cancelar</a>
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn_gold btn-block">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <div class="mt-3 table-responsive">
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
                    @foreach ($clients as $client)
                        <tr>
                            <th scope="row">{{ $client->cedula }}</th>
                            <td>{{ $client->name . ' ' . $client->lastname }}</td>
                            <td>
                                @if ($client->phone == null)
                                    Ver descripcion
                                @else
                                    {{ $client->phone }}
                                @endif
                            </td>
                            <td>{{ $client->email }}</td>
                            <td><a href="{{ route('clients.show', $client->id) }}" class="btn see w-100">Ver <i
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

    <script src="{{ asset('js/dashboard.js') }}"></script>
</x-app-layout>
