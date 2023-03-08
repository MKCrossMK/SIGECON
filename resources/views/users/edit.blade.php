<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views text-center"><i class="fa-solid fa-user-pen mr-3 color-gold"></i>Editar Usuario</h1>
        </div>

        <div class="div-view">
            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @method('PATCH')
                @csrf

                @if (Session::has('message'))
                    <script type="text/javascript">
                        Swal.fire({
                            icon: 'success',
                            title: '¡Excelente!',
                            text: '{{ session()->get('message') }}',
                        });
                    </script>
                @endif

                @if (Session::has('success'))
                    <script type="text/javascript">
                        Swal.fire({
                            icon: 'success',
                            title: '¡Excelente!',
                            text: '{{ session()->get('success') }}',
                        });
                    </script>
                @endif

                @if (Session::has('info'))
                    <script type="text/javascript">
                        Swal.fire({
                            icon: 'info',
                            title: '¡Informacion!',
                            text: '{{ session()->get('info') }}',
                    });
                    </script>
                @endif
                <div class="row mb-2">
                    <div class="col">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nombre"
                            aria-label="Nombre" value="{{ $user->name }}">
                        @error('name')
                            <div id="alert" class="alert alert-danger text-center" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        <input type="text" id="lastname" name="lastname" class="form-control"
                            placeholder="Apellidos" aria-label="Apellidos" value="{{$user->lastname}}">
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
                            placeholder="Nombre de Usuario" value="{{ $user->user}}">
                        @error('user')
                            <div id="alert" class="alert alert-danger text-center" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        <input type="email" id="email" name="email" class="form-control"
                            placeholder="Correo Electronico" value="{{  $user->email }}">
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
                            <option value="" selected disabled>Selecciona Nivel de Acceso o Rol</option>
                            @foreach ($roles as $rol)
                                <option @if ( $user->rol_id == $rol->id) selected @endif value="{{ $rol->id }}">
                                    {{ $rol->name }}</option>
                            @endforeach
                        </select>
                        @error('rol_id')
                            <div id="alert" class="alert alert-danger text-center" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        <select id="branch_office_id" name="branch_office_id" class="form-select" aria-label="Sexo">
                            <option value="" selected disabled>Selecciona Sucursal</option>
                            @foreach ($branch_offices as $branches)
                                <option @if ($user->branch_office_id == $branches->id) selected @endif value="{{ $branches->id }}">
                                    {{ $branches->name }}</option>
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

                <div class="mt-3">

                    <div class="row mb-3">
                        <div class="col">
                            <a href="{{ route('users.reset.pass', $user->id) }}" class="btn btn_gray btn-block">Reestablecer Contraseña</a>
                        </div>
                        <div class="col">
                            <a href="{{ route('users.delete', $user->id) }}" class="btn @if($user->status == 0) btn_danger @else btn_success @endif  btn-block">@if($user->status == 0) Desactivar @else Activar @endif Usuario</a>
                        </div>
                    </div>
                    @if ($user->role->name == 'Gerente' && $user->unique_code == null)
                    <div class="row mb-3">
                        <div class="col">
                            <a href="{{ route('users.code.generate', $user->id) }}" class="btn btn_generate btn-block">Generar Codigo Unico</a>
                        </div>
                    </div>                        
                    @endif
                    
                
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('users.index') }}" class="btn btn_blue btn-block">Cancelar</a>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn_gold btn-block">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>

        <div>
    <div>

        @if($user->status == 1) <h1 class="user_deactive_text mt-4 text-center parpadea">Este usuario está Inactivo</h1> @endif

</x-app-layout>
