<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Desembolsar Poliza desde {{$cash->name}} </h1>
        </div>

        <div class="mt-3 table-responsive">
            <table class="table table-striped " id="policies_table">
                <thead>
                    <tr>
                        <th scope="col">Numero de Poliza</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha de Inicio</th>
                        <th scope="col">Fecha de Fin</th>
                        <th scope="col">Sucursal</th>
                        <th scope="col">Valor prestado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($policies as $policy)
                        <tr>
                            <th scope="row"><a href="{{ route('policies.show', $policy->id)}}" style="text-decoration-line: none !important;">{{ $policy->number_policy }}</a></th>
                            <td>{{ $policy->clients->name . " " .  $policy->clients->lastname }}</td>
                            <td>{{ $policy->date_start }}</td>
                            <td>{{ $policy->date_end }}</td>
                            <td>{{ $policy->branch_office->name}}</td>
                            <td>{{ $policy->loan_value }}</td>
                            <td class="flex"> 
                                <a href="{{ route('policies.manager.disburse.policy.store', [$policy->id, $cash->id]) }}"
                                     class="btn btn_blue w-100" title="Desembolsar" onclick="confirmation(event)">
                                    <i class="fa-sharp fa-solid fa-sack-dollar"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>

    <script>


function confirmation(e) {
    e.preventDefault();

    var url = e.currentTarget.getAttribute('href')
    
    Swal.fire({
        icon: 'warning',
        title: 'Desembolsar valor a prestar',
        text: '¿Quiere proceder a desembolsar el valor a prestar de esta poliza?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Desembolsar'
    }).then((result) => {
        if (result.value) {
            window.location.href=url;
            console.log(url);
        }
    })
}
        $(document).ready(function() {
            $('#policies_table').DataTable({
                "language": {
                    "search": "Buscar:",
                    "lengthMenu": "Mostrar _MENU_ entradas",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "Mostrando _START_ to _END_ of _TOTAL_ entradas",
                    "searchPlaceholder": "Buscar Poliza",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },

                },
                order: [[2, 'desc']]
                
            });
        });
    </script>
    
    @error('policy_id')
        <script type="text/javascript">
            Swal.fire({
                title: "{{$message}}",
                icon: 'info',
            });
        </script>
    @enderror
    
    @error('amount')
        <script type="text/javascript">
            Swal.fire({
                title: "{{$message}}",
                icon: 'info',
            });
        </script>
    @enderror

    @if (Session::has('success'))
        <script type="text/javascript">
            Swal.fire(
                'Excelente!',
                '{{ session()->get('success') }}',

            );
        </script>
    @endif

      @if (Session::has('error'))
      <script type="text/javascript">
          Swal.fire(
              'Error!',
              '{{ session()->get('error') }}',

          );
      </script>
  @endif

  @if (Session::has('warning'))
      <script type="text/javascript">
          Swal.fire(
              'Aviso',
              '{{ session()->get('warning') }}',
          );
      </script>
  @endif



    <script src="{{ asset('js/dashboard.js') }}"></script>
</x-app-layout>
