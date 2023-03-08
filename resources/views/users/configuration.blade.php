<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views text-center"><i class="fa-solid fa-address-card mr-3 color-gold"></i>Perfil de Usuario</h1>
        </div>

        <div class="div-view-configuration">

            <div class="jumbotron" style="background-color: #cb9b2b51">
                <h1 class="display-5">Hola, {{Auth::user()->name . " " . Auth::user()->lastname}}</h1>
                <p class="lead">Cargo: <span class="text_span">{{Auth::user()->role->name }}</span> </p>
                <p class="lead">Usuario: <span class="text_span">{{Auth::user()->user }}</span></p>
                <p class="lead">Correo: <span class="text_span">{{Auth::user()->email }}</span></p>

            </div>


            <hr class="mb-3 mt-3">

            <div class="container mb-5" style="height: 100%;">
                <div class="text-center mb-3">
                    <h1 class="title_cp">Cambiar Contraseña</h1>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <form method="POST" action="{{ route('users.update.pass', Auth::user()->id) }}" style="width: 70%;"
                        class="back_view">
                        @csrf
                        @method('PATCH')

                        <div class="row m-2">
                            <div class="col-12 ">
                                <label for="current_password">Clave actual:</label>
                                <input class="form-control" type="password"
                                    name="current_password" id="current_password" placeholder="Clave actual">
                            </div>
                            <div class="col-12">
                                <label for="new_password">Nueva clave:</label>
                                <input class="form-control" type="password"
                                    name="new_password" id="new_password" placeholder="Clave nueva">
                            </div>
                            <div class="col-12">
                                <label for="confirm_password">Confirmar nueva clave:</label>
                                <input class="form-control" type="password"
                                    name="confirm_password" id="confirm_password" placeholder="Confirmar clave">
                            </div>
                            <div class="col-12 mt-2">
                                <input id="chkbox_showpass" type="checkbox" class="form-control">
                                <label for="chkbox_showpass">Mostrar contraseñas</label>
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn_gold btn-block">Actualizar contraseña</button>
                            </div>
                        </div>
                    </form>
                </div>
                
                @if (Auth::user()->role->name == 'Gerente')

                <hr class="mb-3 mt-3">

                <div class=" justify-content-center align-items-center">
                    <div class="text-center mb-3">
                        <h1 class="title_cp">Codigo Unico</h1>
                    </div>

                    <div class="card">
                        <div class="card-body">
                          <div class="row align-content-center">
                            <div class="col">
                                <p>Este codigo será utilizado para diferentes funciones dentro de este sistema.</p>
                            </div>

                            <div class="col">
                                <div class="row mb-3">
                                    <div class="col">
                                        <a href="{{ route('users.code.request', Auth::user()->id) }}"
                                            class="btn btn_generate btn-block">Solicitar Codigo Unico</a>
                                    </div>
                                </div>                        
                            </div>
                          </div>
                        </div>
                      </div>
                </div>

                @endif

            </div>

        </div>

       
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

    @if (Session::has('error'))
        <script type="text/javascript">
            Swal.fire({
                icon: 'error',
                title: '¡Informacion!',
                text: '{{ session()->get('error') }}',
        });
        </script>
    @endif

</x-app-layout>
