<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views text-center"><i class="fa-solid fa-user-plus mr-3 color-gold"></i>Nuevo Cliente</h1>
        </div>

        <div class="div-view">
            <div>
                <form action="{{ route('clients.store') }}" method="POST">
                    @csrf


                    @if (Session::has('message'))
                        <script type="text/javascript">
                            Swal.fire(
                                'Excelente!',
                                '{{ session()->get('message') }}',

                            );
                        </script>
                    @endif
                    <div class="row mb-2 align-items-center form-group">
                        <div class="col-8 ">
                            <input type="text" id="cedula" name="cedula" class="form-control" placeholder="Cedula"
                                aria-label="Cedula" data-mask="000-0000000-0" value="{{ old('cedula') }}">
                            @error('cedula')
                                <div id="alert" class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>
                        <div class="col-4 ">
                            <input type="checkbox" class="form-control" id="foreign_chbox">
                            <label id="foreign_text" for="foreign">¿Pasaporte?</label>
                        </div>
                    </div>
                    <div class="row mb-2 align-items-center">
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
                    <div class="row mb-2 align-items-center">
                        <div class="col-12">
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
                    </div>
                    <div class="row align-items-center mb-2">

                        <div class="col">
                            <select id="sex" name="sex" class="form-select" aria-label="Sexo">
                                <option value="" selected disabled>Selecciona Sexo</option>
                                <option @if (old('sex') == 'F') selected @endif value="F">Femenino
                                </option>
                                <option @if (old('sex') == 'M') selected @endif value="M">Masculino
                                </option>
                            </select>
                        </div>
                        <div class="col">
                            <select id="civil_status" name="civil_status" class="form-select" aria-label="Sexo">
                                <option value="" selected disabled>Selecciona Estado Civil</option>
                                <option @if (old('civil_status') == 'Soltero') selected @endif value="Soltero">Soltero
                                </option>
                                <option @if (old('civil_status') == 'Casado') selected @endif value="Casado">Casado</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <input type="tel" id="phone" name="phone" class="form-control"
                                placeholder="Telefono 1" data-mask="000-000-0000" value="{{ old('phone') }}">
                            @error('phone')
                                <div id="alert" class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col">
                            <input type="tel" id="cellphone" name="cellphone" class="form-control"
                                placeholder="Telefono 2" data-mask="000-000-0000" value="{{ old('cellphone') }}">
                            @error('cellphone')
                                <div id="alert" class="alert alert-danger text-center" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>

                    <div class="row mb-2 align-items-center">
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
                    <div class="row mb-2">
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea id="description" name="description" class="form-control" placeholder="Descripcion"
                                    id="floatingTextareaD">{{ old('description') }}</textarea>
                                <label for="floatingTextareaD">Descripcion</label>
                            </div>
                        </div>

                        <div class="mt-5 mb-3">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('dashboard') }}" class="btn btn_blue btn-block"
                                        type="button">Cancelar</a>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn_gold btn-block">Guardar</button>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>

</x-app-layout>
