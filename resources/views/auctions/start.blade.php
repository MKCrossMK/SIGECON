<x-app-layout>

    <div class="container mt-3">

        <div class="title_div">
            <h1 class="title_views">Subasta</h1>
        </div>

        @if($auction_detail)

        <div class="row align-items-center">
            <div class="col">
                <div id="carouselExampleControls" class="carousel slide relative w_carousel" data-bs-ride="carousel">
                    <div class="carousel-inner overflow-hidden">
                        @foreach ($auction_detail->policy()->policyDetails as $detail)
                            <div class="carousel-item @if ($auction_detail->policy()->policyDetails[0] == $detail) active @endif w-full">
                                <img src="{{ $detail->image ? $detail->image : asset('img/img-noavble.jpg')  }}" class="block w-full article_img"
                                    alt="Subasta articulo" />
                            </div>
                        @endforeach
    
                    </div>
                    <button
                        class="carousel-control-prev absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline left-0"
                        type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon inline-block bg-no-repeat nextorprev_btn"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button
                        class="carousel-control-next absolute top-0 bottom-0 flex items-center justify-center p-0 text-center border-0 hover:outline-none hover:no-underline focus:outline-none focus:no-underline right-0"
                        type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon inline-block bg-no-repeat nextorprev_btn"
                            aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col">
                <div class="detail_t rounded">
                    <p class="font-bold">Precio: {{ $auction_detail->auctioned_price }} DOP</p>
                    <p><small>Este precio aumentará un 1% por cada puja</small></p>

                    <a href="{{ route('auctions.details.price.update', $auction_detail->id ) }}" class="btn btn_blue w-full mt-3">PUJAR</a>

                    <div class="mt-4">
                        <input type="checkbox" name="add_price" id="add_price">
                        <label id="label_add_price" for="">Fijar Precio</label>

                        <form action="{{ route('auctions.details.price.set', $auction_detail->id ) }}" class="mt-2" id="form_add_price" style="display: none">

                            <div class="row align-items-center">
                                <div class="col-3">
                                    <label for="price" class="font-bold"> Precio a Fijar:</label>
                                </div>
                                <div class="col">
                                    <input type="number" placeholder="Precio a fijar" name="price" id="price" value="{{old('price')}}" class="w-100">
                                    @error('price')
                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                        {{ $message }}
                                    </div>
                                 @enderror

                                 
                                @if (Session::has('priceError'))
                                    <div id="alert" class="alert alert-danger text-center" role="alert">
                                        {{ session()->get('priceError') }}
                                    </div>
                                    
                                @endif
                                </div>
                            </div>
                            <button type="submit" class="btn btn_gold w-100 mt-2">Actualizar</button>
                        </form>
                    </div>
              
                </div>


                

                <form action="{{ route('auctions.details.sell', $auction_detail->id) }}" method="POST" class="mt-3">
                    @csrf
                    @method('PATCH')
                    <div class="row align-items-center">
                        <div class="col">
                            <label for="" class="font-bold">Vender a:</label>
                        </div>
                        <div class="col-9">
                            <select name="participant_id" id="participant_id" class="w-full">
                                <option value="" selected disabled>Seleccionar Comprador...</option>
                                <option value="{{$mdp->id}}">{{$mdp->auctionParticipant->name}}</option>
                                @foreach ($auction_participants as $participant)
                                    <option value="{{ $participant->id }}">{{ $participant->auctionParticipant->name }} - <span class="font-bold"> Paleta:
                                            <span>{{ $participant->number_paddle }}</span></span> </option>
                                @endforeach
                            </select>
                            @error('participant_id')
                            <div id="alert" class="alert alert-danger text-center" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn_gold w-75 float-right mt-2">Vender</button>
                </form>

            </div>
        </div>

        @else
        
        <div class="flex flex-col justify-content-center ">
            <p class="text-center text-gray-800 font-bold text-lg mb-5">Ya no existen más polizas para subastar</p>
            <a href="{{ route('auctions.close', $auctionID->id) }}" class="btn btn_gray text-center">Cerrar subasta</a>
        </div>
        @endif







        @if (Session::has('success'))
            <script type="text/javascript">
                new Notify({
                    status: "success",
                    title: "{{ session()->get('success') }}",
                    effect: "slide",
                    speed: 300,
                    showIcon: true,
                    showCloseButton: false,
                    autoclose: true,
                    autotimeout: 5000,
                    gap: 20,
                    distance: 20,
                    type: 1,
                    position: "right top",
                });
            </script>
        @endif

        @if (Session::has('error'))
        <script>
                new Notify({
                status: "error",
                title: "{{ session()->get('error') }}",
                // text: "{{ session()->get('error') }}",
                effect: "slide",
                speed: 300,
                showIcon: true,
                showCloseButton: false,
                autoclose: true,
                autotimeout: 5000,
                gap: 20,
                distance: 20,
                type: 1,
                position: "right top",
            });
        </script>
            
        @endif
      

        <script src="{{ asset('js/dashboard.js') }}"></script>
        <script src="{{ asset('js/auction.js') }}"></script>

        @error('price')
 
        <script>
            let add_price = document.getElementById('add_price');
            add_price.click();
        </script>
       
       @enderror 

       
       @if (Session::has('priceError'))
       <script>
               let add_price = document.getElementById('add_price');
            add_price.click();
       </script>
           
       @endif

</x-app-layout>
