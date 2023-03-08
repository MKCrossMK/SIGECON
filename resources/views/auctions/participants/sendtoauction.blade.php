<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views text-center"><i class="fa-solid fa-arrow-up-right-from-square mr-3 color-gold"></i>Enviar Participante a Subasta</h1>
        </div>

        <div class="div-view">
            <div>
                <form action="{{ route('auctions.participants.send.store', $auctionParticipant->id) }}" method="POST">
                    @csrf
                    @if (Session::has('message'))
                        <script type="text/javascript">
                            Swal.fire(
                                'Excelente!',
                                '{{ session()->get('message') }}',
                            );
                        </script>
                    @endif

                    <div class="row mb-2 align-items-center">
                        <div class="row">
                            <div class="col">
                                <p class="font-bold">Cedula o Pass: <span class="font-normal">{{$auctionParticipant->cedula}}</span></p>
                            </div>
                            <div class="col">
                                <p class="font-bold">Nombre: <span class="font-normal">{{ $auctionParticipant->name}}</span></p>
                            </div>
                        </div>
                        <div class="row mb-2 align-items-center">
                            <div class="col mt-2">
                                <select id="number_paddle" name="number_paddle" class="form-select">
                                    <option value="" selected disabled>Seleccione numero de paleta</option>
                                    @if ($auctionParticipant->participantTo() != null)
                                    <option value="{{$auctionParticipant->participantTo()->number_paddle}}" selected>{{$auctionParticipant->participantTo()->number_paddle}}</option>
                                    @endif
                                    @foreach ($places as $place)
                                    <option @if ($auctionParticipant->number_paddle == $place) selected @endif  value="{{$place}}">{{$place}}</option>
                                    @endforeach
                                </select>
                                @error('number_paddle')
                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                                @error('auction_participant_id')
                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
        
                    <div class="mt-5 mb-3">
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('auctions.participants.index') }}" class="btn btn_blue btn-block"
                                    type="button">Volver</a>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn_gold btn-block">Actualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

</x-app-layout>
