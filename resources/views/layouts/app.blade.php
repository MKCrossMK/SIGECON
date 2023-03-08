<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('img/favicon_mp.png') }}"/>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('sidebar/css/style.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/navstyles.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/dashboardstyles.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/printpages.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/auctionstyle.css') }}">


    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />

    <link rel="stylesheet" href="{{ asset('toastnotify/dist/simple-notify.min.css') }}" />
    <script src="{{ asset('toastnotify/dist/simple-notify.min.js') }}"></script>
    {{-- Sweet Alert --}}
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="font-sans antialiased">

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="img bg-wrap text-center py-4" style="background-image: url({{ asset('img/background.jpg') }});">
                <div class="user-logo">
                    <a href="#" class="img logo rounded-circle mb-5"
                        style="background-image: url({{ asset('img/mp.png') }});"></a>
                </div>
            </div>
            <div class="p-4">
                <ul class="list-unstyled components mb-2">
                    <li>
                        <a href="{{ route('dashboard') }}"><i class="fa-solid fa-house mr-3"></i></i>Home</a>
                    </li>
                    <li>
                        <a href="#clientSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i
                                class="fa-solid fa-users mr-3"></i>Clientes</a>
                        <ul class="collapse list-unstyled" id="clientSubmenu">
                            <li>
                                <a href="{{ route('clients.index') }}"><i class="fa-solid fa-eye mr-3"></i>Ver
                                    Clientes</a>
                            </li>
                            <li>
                                <a href="{{ route('clients.create') }}"><i class="fa-solid fa-user-plus mr-3"></i>Nuevo
                                    Cliente</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#polizasSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"><i class="fa-solid fa-file-invoice mr-3"></i>Polizas</a>
                        <ul class="collapse list-unstyled" id="polizasSubmenu">
                            <li>
                                <a href="{{ route('policies.index') }}"><i class="fa-solid fa-eye mr-3"></i>Ver Polizas</a>
                            </li>
                            <li>
                                <a href="{{ route('policies.create') }}" ><i class="fa-solid fa-file-circle-plus mr-3"></i>Nueva Poliza</a>
                            </li>
                            <li>
                                <a href="#oldpolizasSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"><i class="fa-sharp fa-solid fa-file mr-3"></i>Polizas Sistemas Anteriores</a>
                        <ul class="collapse list-unstyled" id="oldpolizasSubmenu">
                            <li>
                                <a href="{{ route('old.policies.index') }}"><i class="fa-solid fa-magnifying-glass mr-3"></i>Ver</a>
                            </li>
                            <li>
                                <a href="{{ route('old.policies.create') }}" ><i class="fa-solid fa-file-export mr-3"></i>Agregar Poliza de Sistemas Anteriores</a>
                            </li>
                        </ul>
                            </li>
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="#custodySubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"><i class="fa-solid fa-shield mr-3"></i>Custodias</a>
                        <ul class="collapse list-unstyled" id="custodySubmenu">
                            <li>
                                <a href="#"><i class="fa-solid fa-eye mr-3"></i>Ver Custodias</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa-solid fa-plus mr-3"></i>Nueva Custodia</a>
                            </li>
                        </ul>
                    </li> --}}
                    <li>
                        <a href="#certificationSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"><i class="fa-solid fa-certificate mr-3"></i>Certificaciones</a>
                        <ul class="collapse list-unstyled" id="certificationSubmenu">
                            <li>
                                <a href="{{ route('certifications.index') }}"><i class="fa-solid fa-eye mr-3"></i>Ver Certificaciones</a>
                            </li>
                            <li>
                                <a href="{{ route('certifications.create') }}"><i class="fa-solid fa-plus mr-3"></i> Nueva Certificacion</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}"><i class="fa-solid fa-user-plus mr-3"></i>Usuarios</a>
                    </li>
                    <li>
                        <a href="{{ route('auctions.index') }}"><i class="fa-solid fa-money-bill-trend-up mr-3"></i>Subasta</a>
                    </li>
                    {{-- <li>
                        <a href="#auctionSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"><i class="fa-solid fa-money-bill-trend-up mr-3"></i>Subasta</a>
                        <ul class="collapse list-unstyled" id="auctionSubmenu">
                            <li>
                                <a href="#">Ver Subasta</a>
                            </li>
                          
                        </ul>
                    </li> --}}
                    <li>
                        <a href="#RateSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle"><i class="fa-solid fa-coins mr-3"></i>Tasas</a>
                        <ul class="collapse list-unstyled" id="RateSubmenu">
                            <li>
                                <a href="{{ route('rate.gold.index') }}"><i class="fa-solid fa-ring mr-3"></i>Tasa de Oro</a>
                            </li>
                            <li>
                                <a href="{{route('rate.interest.index')}}"><i class="fa-solid fa-money-bill-trend-up mr-3"></i> Tasa de Contrato e Interes</a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <div class="footer">
                    <p class="text-justify">
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved <i class="icon-heart"
                            aria-hidden="true"></i>
                            <br>
                            <br>
                            <center>TIC Monte de Piedad</center>
                    </p>

                </div>

            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

            @include('layouts.navigation')


            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

        </div>
    </div>


    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>


    <!-- Scripts -->

    <script src="{{ asset('sidebar/js/jquery.min.js') }} "></script>
    <script src="{{ asset('sidebar/js/popper.js') }} "></script>
    <script src="{{ asset('sidebar/js/bootstrap.min.js') }} "></script>
    <script src="{{ asset('sidebar/js/main.js') }}"></script>
    <script src="https://kit.fontawesome.com/f3820ef930.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>

    {{-- Mask Jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
        integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
</body>

</html>
