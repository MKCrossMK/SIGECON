<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Reporte de Sucursal: {{ $branch_Office->name }}</h1>
        </div>


        <div class="card-deck mt-5">
            <a href="{{ route('report.today', $branch_Office->id) }}"class="card text-center boder-orange cardbtn">
                <div class="card-body">
                    <h4 class="card-title">Reporte de Hoy</h4>
                    <i class="fa-solid fa-calendar-day fa-3x"></i>
                </div>
            </a>
            <a href="{{ route('report.month', $branch_Office->id) }}" class="card text-center boder-orange cardbtn">
                <div class="card-body">
                    <h4 class="card-title">Reporte del Mes</h4>
                    <i class="fa-solid fa-calendar-days fa-3x"></i>
                </div>
            </a>
        </div>


        <div class="accordion mt-3" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="fa-solid fa-calendar mr-3 color-gold"></i> Obtener Reporte por Fecha
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <form action="{{ route('report.dates', $branch_Office->id) }}" method="GET"
                        enctype="multipart/form-data">
                        <div class="accordion-body">

                            <div class="row mb-2">
                                <div class="col">
                                    <label for="start_date" class="font-bold">Desde</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        placeholder="Desde" aria-label="Nombre" value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="end_date" class="font-bold">Hasta</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        placeholder="Hasta" aria-label="Apellidos" value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <div id="alert" class="alert alert-danger text-center" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                        </div>

                        <div class="mt-3">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('report.index') }}" class="btn btn_danger btn-block">Volver</a>
                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn_blue btn-block">Filtrar</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
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
                    "searchPlaceholder": "Buscar Sucursal",
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

</x-app-layout>
