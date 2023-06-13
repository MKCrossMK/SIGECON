<x-app-layout>

    <div class="container mt-3">

        <div class="title_div mb-5">
            <h1 class="title_views">Editar Balance de: {{$cash->name}} </h1>
        </div>

        <div class="div-view">
            <form action="{{ route('cashes.balance.update', $cash->id ) }}" method="POST">
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
                        <label for="price" style="font-weight: bold">Nuevo Balance:</label>
                        <input type="text" id="balance" name="balance" class="form-control" placeholder="Nuevo balance" value="{{old('balance')}}">
                        <small class="mt-5">Balance : {{$cash->balance}}</small>
                        <p>
                            <small>Cantidad limite de caja: {{$cash->initial_amount}}</small>
                        </p>

                    @error('balance')
                        <div id="alert" class="alert alert-danger text-center" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>

        </div>
        
        <div class="div-view-buttons mt-5">
            <div class="row ">
                <div class="col"><a href="{{ route('cashes.index') }}" class="btn btn_blue w-100">Volver</a></div>
                <div class="col"><button class="btn btn_add w-100">Actualizar Balance</button>
                    
                </div>
            </div>
        </div>
    </form>


        <script src="{{ asset('js/dashboard.js') }}"></script>
</x-app-layout>
