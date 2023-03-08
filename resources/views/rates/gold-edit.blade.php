<x-app-layout>

    <div class="container mt-3">

        <div class="title_div mb-5">
            <h1 class="title_views">Editar Tasa del Oro : {{$goldRate->carat}} </h1>
        </div>

        <div class="div-view">
            <form action="{{ route('rate.gold.update',$goldRate->id ) }}" method="POST">
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
                        <label style="font-weight: bold">Quilate (K):</label>
                        <input type="text" id="carat" name="carat" class="form-control" value="{{$goldRate->carat}}" disabled>
                    </div>
                    <div class="col">
                        <label for="price" style="font-weight: bold">Precio:</label>
                        <input type="text" id="price" name="price" class="form-control" value="{{$goldRate->price}}">
                    </div>
                </div>

        </div>
        
        <div class="div-view-buttons mt-5">
            <div class="row ">
                <div class="col"><a href="{{ route('rate.gold.index') }}" class="btn btn_blue w-100">Volver</a></div>
                <div class="col"><button class="btn btn_add w-100">Actualizar</button>
                </div>
            </div>
        </div>
    </form>


        <script src="{{ asset('js/dashboard.js') }}"></script>
</x-app-layout>
