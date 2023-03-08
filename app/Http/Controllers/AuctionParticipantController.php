<?php

namespace App\Http\Controllers;

use App\Models\AuctionParticipant;
use App\Http\Requests\StoreAuctionParticipantRequest;
use App\Http\Requests\UpdateAuctionParticipantRequest;
use App\Models\Auction;
use App\Models\ParticipantOnAuction;
use Dotenv\Parser\Parser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuctionParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auction = Auction::latest()->select('id', 'places')->where('status', 1)->first();
        $places = [];
        $participants = AuctionParticipant::all();

        if ($auction != null) {

            $participantOnAuction = ParticipantOnAuction::where('auction_id', $auction->id)->get();

            for ($i = 1; $i <= $auction->places; $i++) {
                array_push($places, $i);
            }

            foreach ($participantOnAuction as $participant) {
                $clave = array_search($participant->number_paddle, $places); // Buscar en el array para sacar el numero de paleta que ya está en uso
                unset($places[$clave]);
            }

            return view('auctions.participants.index')
                ->with('participants', $participants)
                ->with('places', $places);
        } else {
            return view('auctions.participants.index')
                ->with('error', 'No hay subasta en curso')
                ->with('places', $places)
                ->with('participants', $participants)
                ->with('mdp', AuctionParticipant::MDP['cedula']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuctionParticipantRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuctionParticipantRequest $request)
    {
        $request->validated();

        $auction_id = Auction::latest()->select('id')->where('status', 1)->first();

        if ($auction_id != null) {

            $auctionParticipant = AuctionParticipant::create([
                'name' => $request->name,
                'cedula'  => $request->cedula,
                'user_creator_id' => Auth::user()->id,
            ]);


            if (isset($request->number_paddle)) {
                ParticipantOnAuction::create([
                    'auction_participant_id' => $auctionParticipant->id,
                    'number_paddle' => $request->number_paddle,
                    'auction_id' => $auction_id->id,
                ]);
            }


            return redirect()->route('auctions.participants.index')
                ->with('success', 'Participante registrado sastifactoriamente');
        } else {

            return redirect()->route('auctions.index')
                ->with('error', 'No existe subasta');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AuctionParticipant  $auctionParticipant
     * @return \Illuminate\Http\Response
     */
    public function show(AuctionParticipant $auctionParticipant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuctionParticipant  $auctionParticipant
     * @return \Illuminate\Http\Response
     */
    public function edit(AuctionParticipant $auctionParticipant)
    {
        $places = Auction::latest()->select('places')->where('status', 1)->first();

        return view('auctions.participants.edit')
            ->with('auctionParticipant', $auctionParticipant)
            ->with('places', $places->places);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuctionParticipantRequest  $request
     * @param  \App\Models\AuctionParticipant  $auctionParticipant
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuctionParticipantRequest $request, AuctionParticipant $auctionParticipant)
    {
        $auctionParticipant->update([
            'name' => $request->name,
            'cedula'  => $request->cedula,
        ]);

        return redirect()->route('auctions.participants.index')
            ->with('success', 'Participante registrado sastifactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuctionParticipant  $auctionParticipant
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuctionParticipant $auctionParticipant)
    {
        //
    }


    public function toAuction(AuctionParticipant $auctionParticipant)
    {

        $auction_id = Auction::latest()->select('id')->where('status', 1)->first();
        $places = [];
        if ($auction_id != null) {

            $participants = ParticipantOnAuction::where('auction_id', $auction_id->id)->get();
            $auction_places = Auction::latest()->select('places')->where('status', 1)->first();

            for ($i = 1; $i <= $auction_places->places; $i++) {
                array_push($places, $i);
            }

            foreach ($participants as $participant) {
                $clave = array_search($participant->number_paddle, $places); // Buscar en el array para sacar el numero de paleta que ya está en uso
                unset($places[$clave]);
            }

            return view('auctions.participants.sendtoauction')
                ->with('auctionParticipant', $auctionParticipant)
                ->with('places', $places);
        } else {
            return redirect()->back()
            ->with('error', 'No existe subasta en curso');
        }
    }

    public function sendToAuction(Request $request,  AuctionParticipant $auctionParticipant)
    {
        $auction_id = Auction::latest()->select('id')->where('status', 1)->first();
        $request = new Request([
            'auction_participant_id' => $auctionParticipant->id,
            'number_paddle' => $request->number_paddle,
        ]);

        $this->validate($request, [
            'number_paddle' => ['required', 'numeric', Rule::unique('participant_on_auctions')->where('auction_id', $auction_id->id)->where('auction_participant_id', $auctionParticipant->id), 'min:1'],
            'auction_participant_id' => [Rule::unique('participant_on_auctions')->where('auction_id', $auction_id->id)],
        ], [
            'number_paddle.required' => 'Numero de paleta es requerido',
            'number_paddle.numeric' => 'Numero de paleta es debe ser especificado en forma numérica',
            'number_paddle.unique' => 'Numero de paleta está en uso',
            'auction_participant_id.unique' => 'El participante ya está dentro de la subasta',
        ]);

        if ($auction_id != null) {

            if (isset($request->number_paddle)) {

                ParticipantOnAuction::create([
                    'auction_participant_id' => $auctionParticipant->id,
                    'number_paddle' => $request->number_paddle,
                    'auction_id' => $auction_id->id,
                ]);

                return redirect()->route('auctions.participants.index')
                    ->with('success', 'Participante agregado a subasta correctamente');
            }
        } else {
            return redirect()->route('auctions.index')
                ->with('error', 'No existe subasta');
        }
    }
}
