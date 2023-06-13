<x-app-layout>

    <div class="py-12">

        <div class="title_div mb-5">
            <h1 class="title_views">Cajas de la Sucursal</h1>
        </div>

        <div class="row d-flex flex-wrap mt-4">
            @foreach ($cashes as $cash)
                <div class="col">
                    <a href="{{ route('policies.manager.disburse.policy.index', $cash->id) }}" class="card text-center boder-orange cardbtn">
                        <div class="card-body">
                        <h4 class="card-title">{{$cash->name}}</h4>
                        <i class="fa-solid fa-cash-register fa-3x"></i>
                        </div>
                    </a>          
                </div>
            @endforeach
          
        
        </div>
    
    </div>
</x-app-layout>
