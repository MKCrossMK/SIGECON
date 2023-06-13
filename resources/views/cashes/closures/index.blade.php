<x-app-layout>

    <div class="py-12">

        <div class="title_div mb-5">
            <h1 class="title_views">Cierre de Caja</h1>
        </div>

        <div class="row d-flex flex-wrap mt-4">
            <div class="col">
                <a href="{{ route('cashes.closure.store') }}" class="card text-center boder-orange cardbtn">
                    <div class="card-body">
                    <h4 class="card-title">Cerrar</h4>
                    <i class="fa-solid fa-cash-register fa-3x"></i>
                    </div>
                </a>          
            </div>
        </div>
    
    </div>
</x-app-layout>
