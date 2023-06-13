<x-app-layout>

    <div class="py-12">
        <div class="card-deck mt-3">
            <a href="{{ route('policies.create') }}" class="card text-center boder-orange cardbtn">
              <div class="card-body">
                <h4 class="card-title">Nueva Poliza</h4>
                <i class="fa-solid fa-file-circle-plus fa-3x"></i>
              </div>
            </a>          
      
            {{-- <a class="card text-center boder-orange cardbtn">
              <div class="card-body">
                <h4 class="card-title">Registrar Custodia</h4>
                <i class="fa-solid fa-shield fa-3x"></i>
              </div>
            </a>           --}}
        
            <a href="{{ route('certifications.create') }}" class="card text-center boder-orange cardbtn">
              <div class="card-body">
                <h4 class="card-title">Nueva Certificación</h4>
                <i class="fa-solid fa-certificate fa-3x"></i>
              </div>
            </a>          
      
          </div>
    </div>
</x-app-layout>
