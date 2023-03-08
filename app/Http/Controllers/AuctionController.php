<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Http\Requests\StoreAuctionRequest;
use App\Http\Requests\UpdateAuctionRequest;
use App\Models\AuctionDetail;
use App\Models\AuctionParticipant;
use App\Models\Branch_Office;
use App\Models\OldPolicy;
use App\Models\ParticipantOnAuction;
use App\Models\Policy;
use App\Services\Auction as ServicesAuction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch_offices = Branch_Office::all();

        $policies = Policy::where('status', Policy::STATUS_EXPIRED)->get();
        $old_policies = OldPolicy::where('status', OldPolicy::STATUS_EXPIRED)->get();
        $auction = Auction::where('status', 1)->exists();
        $auction_id = Auction::latest()->select('id')->where('status', 1)->first();

        $participants = [];
        $auction_details = [];
        if ($auction_id != null) {
            $auction_details = AuctionDetail::where('auction_id', $auction_id->id)->get();
            $participants = ParticipantOnAuction::where('auction_id', $auction_id->id)->get();

        }

        return view('auctions.index')->with('auction', $auction)
        ->with('policies', $policies)
        ->with('old_policies', $old_policies)
        ->with('branch_offices', $branch_offices)
        ->with('auction_details', $auction_details)
        ->with('participants', $participants);
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
     * @param  \App\Http\Requests\StoreAuctionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAuctionRequest $request)
    {

        $request->validated();

        $auction = Auction::where('status', 1)->exists();

        if($auction != true){
            Auction::create([
                'date_to_celebrate' => $request->date_to_celebrate ,
                'note' => $request->note,
                'branch_office_celebrate_id' => $request->branch_office_celebrate_id,
                'user_creator_id' => Auth::user()->id,
                'places' => $request->places,
                'status' => 1,
            ]);

            return redirect()->route('auctions.index')->with('success', 'Subasta creada sastifactoriamente');
        }
        else{
            return redirect()->route('auctions.index')->with('error', 'Ya existe una subasta en curso');
        }
    
    }

    public function start(){
        $auctionID = Auction::select('id')->where('status', 1)->where('a_status', Auction::STATUS_CREATED)->first();

        $auctionStarted = Auction::select('id')->where('status', 1)->where('a_status', Auction::STATUS_STARTED)->first();


        if ($auctionID) {
            $auction_details = AuctionDetail::where('auction_id', $auctionID->id)->get();

            if(count($auction_details) > 0){

                foreach ($auction_details as $detail) {
                    if ($detail->first_bid_price == null || $detail->first_bid_price == "" || $detail->first_bid_price <= 0) {
                        return redirect()->route('auctions.index')->with('error', 'Existen polizas sin precio de primera puja');
                    } else {
                       return $this->updateAuctionStatus($auctionID);
                    }
                }
            }else {
                return redirect()->route('auctions.index')->with('info', 'No existen polizas a subastar, seleccione las polizas a subastar');
            }

            
        }else if($auctionStarted){
            return $this->goToAuction();
        }else{
            return redirect()->route('auctions.index')->with('error', 'No existe subasta en curso');
        }

       
        

        // $auction_update = Auction::where('status', 1)->where('a_status', Auction::STATUS_CREATED)->update(['a_status'  => Auction::STATUS_STARTED]); 
        // dd($auction);
    }

    public function updateAuctionStatus(Auction $auction){
        
        $auction->a_status = Auction::STATUS_STARTED;
        $saved = $auction->save();

        if ($saved) {
            return $this->goToAuction()->with('success', 'Se ha iniciado la subasta');
        } else {
            return redirect()->route('auctions.index')->with('error', 'Error');
        }

    }


    public function goToAuction(){
        $auctionID = Auction::select('id')->where('status', 1)->where('a_status', Auction::STATUS_STARTED)->first();
        $auction_detail = AuctionDetail::where('status', AuctionDetail::STATUS_TO_AUCTION)->where('auction_id', $auctionID->id)->first();
        $auction_participants = ParticipantOnAuction::where('auction_id', $auctionID->id)->get();
        $mdp = ParticipantOnAuction::where('number_paddle', 0)->first();

        return view('auctions.start')
        ->with('auction_detail', $auction_detail)
        ->with('auction_participants', $auction_participants)
        ->with('auctionID', $auctionID)
        ->with('mdp', $mdp);
    }

 


    public function closeAuction(Auction $auction){
        $policies_count = count($auction->details);
        $total_auctioned = 0;

        foreach($auction->details as $detail){
           $total_auctioned +=  $detail->auctioned_price;
        }

        $auction->status = 0;
        $auction->a_status = Auction::STATUS_CLOSED;
        $auction->qty_policies_auctioned = $policies_count;
        $auction->total_auctioned = $total_auctioned;
        $saved = $auction->save();

        if ($saved) {
            return redirect()->route('auctions.list')->
            with('info', 'La Subasta ha terminado sastifactoriamente y ha sido cerrada');
        } else {
            return redirect()->route('auctions.index')->
            with('error', 'Ha sucedido un error');
        }
    }

    public function auctionsList(){
        $auctions = Auction::where('status', 0)->where('a_status', Auction::STATUS_CLOSED)->get();

        return view('auctions.list.index')
        ->with('auctions', $auctions);
    } 

    public function auctionListParticipant(Auction $auction){

        $participants = $auction->participants;
        

        return view('auctions.list.participants')
        ->with('participants', $participants)
        ->with('auction', $auction);
    }

    public function auctionInvoiceParticipant(ParticipantOnAuction $participant){

        return view('auctions.invoices.index')
        ->with('participant', $participant)
        ->with('details', $participant->policiesBought);
    }

    public function auctionInvoce(Auction $auction){

        $details = $auction->details;
        $total = 0;

        foreach ($details as $detail) {
            $total += $detail->auctioned_price;
        }


        return view('auctions.invoices.results')
        ->with('auction', $auction)
        ->with('details', $details)
        ->with('total', $total);
    }



   
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function edit(Auction $auction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAuctionRequest  $request
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAuctionRequest $request, Auction $auction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction)
    {
        //
    }
}
