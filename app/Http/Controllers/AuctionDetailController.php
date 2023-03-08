<?php

namespace App\Http\Controllers;

use App\Models\AuctionDetail;
use App\Http\Requests\StoreAuctionDetailRequest;
use App\Http\Requests\UpdateAuctionDetailRequest;
use App\Models\Adjudication;
use App\Models\Auction;
use App\Models\OldPolicy;
use App\Models\ParticipantOnAuction;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAuctionDetailRequest  $request
     * @return \Illuminate\Http\Response
     */

     // 
    public function store(StoreAuctionDetailRequest $request, Policy $policy)
    {
        
        $auction_id = Auction::latest()->select('id')->where('status', 1)->first();

        if($auction_id != null){
            $save = AuctionDetail::create([
                'auction_id' => $auction_id->id,
                'policy_id' => $policy->id,
                'policie_class_name' => Policy::class,
                'user_creator_id' => Auth::user()->id,
                'status' => AuctionDetail::STATUS_TO_AUCTION

            ]);
    
            if ($save) {
                $policy->update([
                    'status' => Policy::STATUS_TO_AUCTION,
                ]);
            }
    
            return redirect()->route('auctions.index')
            ->with('success', 'Poliza: ' . $policy->number_policy . ' enviada a subasta correctamente');

        } else{

            return redirect()->route('auctions.index')
            ->with('error', 'No existe subasta');

        }

       
    }
    
    public function storeOldPolicy(StoreAuctionDetailRequest $request, OldPolicy $oldPolicy){
        $auction_id = Auction::latest()->select('id')->where('status', 1)->first();

        if($auction_id != null){
            $save = AuctionDetail::create([
                'auction_id' => $auction_id->id,
                'policy_id' => $oldPolicy->id,
                'policie_class_name' => OldPolicy::class,
                'user_creator_id' => Auth::user()->id,
                'status' => AuctionDetail::STATUS_TO_AUCTION
            ]);
    
            if ($save) {
                $oldPolicy->update([
                    'status' => OldPolicy::STATUS_TO_AUCTION,
                ]);
            }
    
            return redirect()->route('auctions.index')
            ->with('success', 'Poliza: ' . $oldPolicy->number_policy . ' enviada a subasta correctamente');

        } else{

            return redirect()->route('auctions.index')
            ->with('error', 'No existe subasta');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AuctionDetail  $auctionDetail
     * @return \Illuminate\Http\Response
     */
    public function show(AuctionDetail $auctionDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AuctionDetail  $auctionDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(AuctionDetail $auctionDetail)
    {
        return view('auctions.details.edit')
        ->with('auctionDetail', $auctionDetail);
    }
    
    public function updateFirstBidPrice(Request $request, AuctionDetail $auctionDetail)
    {
        $request->validate([
            'first_bid_price' => 'required|numeric', 
        ],[
            'first_bid_price.required' => 'Precio de primera puja requerido',
            'first_bid_price.numeric' => 'Precio debe ser numerico',
        ]);

        $auctionDetail->update([
            'first_bid_price' => $request->first_bid_price,
            'auctioned_price' => $request->first_bid_price,
        ]);

        return redirect()->route('auctions.index')
        ->with('sucess', 'Precio de primera puja colocado a poliza:' . $auctionDetail->policy()->number_policy);
    }


    // Este metodo aumenta en 1% el precio de la poliza en la subasta al pujarse
    public function upAuctionedrice(AuctionDetail $auctionDetail){
        
        $cant = $auctionDetail->auctioned_price * 0.01;
        $auctionDetail->auctioned_price += $cant;
        $auctionDetail->bid_qty += 1;
        $saved =  $auctionDetail->save();

        if ($saved) {
            return redirect()->back()->with('success', 'Precio pujado');
        } else {
            return redirect()->back()->with('error', 'Ha ocurrido un error');
        }
        
    }

       // Metodo pora vender al participante la poliza 
    // Funcionará un metodo ruta para editar la poliza y actualizar el estado ponerla como subastada y el participante que la compró

    public function sellPolicyAuctioned(Request $request, AuctionDetail $auctionDetail){

        $request->validate([
            'participant_id' => 'required|',
        ], ['participant_id.required' => 'Comprador no seleccionado']);

        $mdp = ParticipantOnAuction::where('number_paddle', 0)->first();

        if ($request->participant_id == $mdp->id ) {

            $auctionDetail->update([
                'participant_on_auctions_id' => $request->participant_id,
                'status' => AuctionDetail::STATUS_AUCTIONED,
            ]);

            // Automaticamente al seleccionar monte de piedad, se adjudicará a este y se creará el registro en la BD
            
            Adjudication::create([
                'auction_detail_id' => $auctionDetail->id,
            ]);

        } else {

        $auctionDetail->update([
            'participant_on_auctions_id' => $request->participant_id,
            'status' => AuctionDetail::STATUS_AUCTIONED,
        ]);

        }
        

        return redirect()->route('auctions.go')
        ->with('Poliza vendida a ');

    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuctionDetailRequest  $request
     * @param  \App\Models\AuctionDetail  $auctionDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuctionDetailRequest $request, AuctionDetail $auctionDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AuctionDetail  $auctionDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(AuctionDetail $auctionDetail)
    {
        $auctionDetail->policy()->update(['status' => Policy::STATUS_EXPIRED]);

        $auctionDetail->delete();

        return redirect()->route('auctions.index')
        ->with('info', 'Poliza eliminada de subasta');

    }
}
