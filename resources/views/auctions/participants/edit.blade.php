<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views text-center"><i class="fa-solid fa-user-pen mr-3 color-gold"></i>Editar Participante de Subasta</h1>
        </div>

        <div class="div-view">
            <div>
                <form action="{{ route('auctions.participants.update', $auctionParticipant->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @if (Session::has('message'))
                        <script type="text/javascript">
                            Swal.fire(
                                'Excelente!',
                                '{{ session()->get('message') }}',

                            );
                        </script>
                    @endif

                    <div class="row mb-2 align-items-center">
                        <div class="row mb-2 align-items-center">
                            <div class="col-4">
                                <input type="text" id="cedula" name="cedula" class="form-control"
                                    placeholder="Cedula" aria-label="Cedula" value="{{$auctionParticipant->cedula}}"
                                    data-mask="000-0000000-0">
                                @error('cedula')
                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                            <div class="col-3">
                                <input type="checkbox" class="form-control" id="foreign_chbox">
                                <label id="foreign_text" for="foreign">¿Pasaporte?</label>
                            </div>
                            <div class="col-5">
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Nombre" aria-label="Nombre" value="{{ $auctionParticipant->name }}">
                                @error('name')
                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="row align-items-center mb-2">
                            <div class="col">
                                <select id="number_paddle" name="number_paddle" class="form-select">
                                    <option value="" selected>Seleccione numero de paleta</option>
                                    @for ($i = 1; $i <= $places; $i++)
                                    <option @if ($auctionParticipant->number_paddle == $i) selected @endif value="{{$i}}">
                                        {{$i}}</option>
                                    @endfor
                                </select>
                                @error('number_paddle')
                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                           
                        </div> --}}
                    <div class="mt-5 mb-3">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('auctions.participants.index') }}" class="btn btn_blue btn-block"
                                    type="button">Volver</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn_gold btn-block">Guardar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

</x-app-layout>
