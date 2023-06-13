<x-app-layout>

    <div class="py-12">

        <div class="title_div mb-5">
            <h1 class="title_views">Cajas</h1>
        </div>


        <div class="mt-3 table-responsive">
            <table class="table table-striped " id="client_table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Caja</th>
                        <th scope="col">Monto Inicial</th>
                        <th scope="col">Balance</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cashes as $cash)
                        <tr>
                            <th scope="row" class="text-center">{{ $cash->name }}</th>
                            <td>{{$cash->initial_amount}}</td>
                            <td>{{$cash->balance}}</td>                          
                            <td><a href="{{ route('cashes.balance.edit', $cash->id) }}" class="btn see w-100"><i
                                class="fa-solid fa-pen mr-2"></i> Actualizar Balance </a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>

</x-app-layout>
