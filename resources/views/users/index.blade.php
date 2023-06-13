<x-app-layout>
    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Usuarios</h1>
        </div>


        <div class="accordion mb-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa-solid fa-user-plus mr-3 color-gold"></i> Registrar Nuevo Usuario
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Nombre" aria-label="Nombre" value="{{ old('name') }}">
                                    @error('name')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <input type="text" id="lastname" name="lastname" class="form-control"
                                        placeholder="Apellidos" aria-label="Apellidos" value="{{ old('lastname') }}">
                                    @error('lastname')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <input type="text" id="user" name="user" class="form-control"
                                        placeholder="Nombre de Usuario" value="{{ old('user') }}">
                                    @error('user')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
                            <div class="row align-items-center mb-2">
                                <div class="col">
                                    <select id="rol_id" name="rol_id" class="form-select" aria-label="Sexo">
                                        <option value="" selected disabled>Selecciona Nivel de Acceso o Rol
                                        </option>
                                        @foreach ($roles as $rol)
                                            <option @if (old('rol_id') == $rol->id) selected @endif
                                                value="{{ $rol->id }}">{{ $rol->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('rol_id')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <select id="branch_office_id" name="branch_office_id" class="form-select">
                                        <option value="" selected disabled>Selecciona Sucursal</option>
                                        @foreach ($branch_offices as $branches)
                                            <option @if (old('branch_office_id') == $branches->id) selected @endif
                                                value="{{ $branches->id }}">{{ $branches->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('branch_office_id')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <input type="hidden" name="password" value="0">
                                </div>
                            </div>

                            <div class="row align-items-center mb-2">
                                <div class="col">
                                    <select id="cash_id" name="cash_id" class="form-select" aria-label="Sexo" hidden>
                                        <option value="" selected disabled>Selecciona Caja Asignada
                                        </option>
                                        @foreach ($cashes as $cash)
                                            <option @if (old('cash_id') == $cash->id) selected @endif
                                                value="{{ $cash->id }}">{{ $cash->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cash_id')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="row">
                                    <div class="col">
                                        <a href="#" class="btn btn_blue btn-block" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne" onclick="cancelNewUser()">Cancelar</a>
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


        <div>
            <table class="table table-striped" id="user_table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo Electronico</th>
                        <th scope="col">Nivel de Acceso</th>
                        <th scope="col">Sucursal</th>
                        <th scope="col">En linea</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->name . ' ' . $user->lastname }}</th>
                            <td>{{ $user->user }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>{{ $user->branch_office->name }}</td>
                            <td>@if ($user->logged == true)
                                <div class=" success w-100">SI</div>
                                @else
                                <div class=" warning w-100" disabled>NO</div>
                                @endif
                            </td>

                            <td>
                                @if ($user->status === 0)
                                    <div class=" success w-100">Activo</div>
                                @else
                                    <div class=" warning w-100" disabled>Inactivo</div>
                                @endif
                            </td>
                            <td><a href="{{ route('users.edit', $user->id) }}" class="btn see w-100">Ver <i
                                        class="fa-solid fa-eye mr-2"></i></a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#user_table').DataTable({
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "Mostrando _START_ to _END_ of _TOTAL_ entradas",
                    "searchPlaceholder": "Buscar Usuario",
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

<script src="{{ asset('js/users.js') }}"></script>


</x-app-layout>
