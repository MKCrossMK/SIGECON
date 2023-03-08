<x-app-layout>

    <div class="container mt-3">

        <div class="title_div mb-5">
            <h1 class="title_views">Editar Tasa del Oro : {{$interestRate->porcent}} %</h1>
        </div>

        <div class="div-view">
            <form action="{{ route('rate.interest.update', $interestRate->id ) }}" method="POST">
                @csrf
                @method('PATCH')

                @if (Session::has('success'))
                <script type="text/javascript">
                    Swal.fire(
                        '¡Excelente!',
                        '{{ session()->get('success') }}',

                    );
                </script>
            @endif

                <div class="row">
                    <div class="col">
                        <label for="porcent" style="font-weight: bold">Precio:</label>
                        <input type="text" id="porcent" name="porcent" class="form-control" value="{{$interestRate->porcent}}">
                    </div>
                </div>

        </div>
        
        <div class="div-view-buttons mt-5">
            <div class="row ">
                <div class="col"><a href="{{ route('rate.interest.index') }}" class="btn btn-dark font-bold w-100">
                    <i class="fa-solid fa-circle-arrow-left mr-2"></i>Volver</a></div>
                <div class="col"><button class="btn btn_blue w-100">Actualizar</button>

                </div>
            </div>
        </div>
    </form>


        <script src="{{ asset('js/dashboard.js') }}"></script>
</x-app-layout>
