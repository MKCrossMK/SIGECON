<?php

namespace App\Http\Controllers;

use App\Models\ParticipantOnAuction;
use App\Http\Requests\StoreParticipantOnAuctionRequest;
use App\Http\Requests\UpdateParticipantOnAuctionRequest;

class ParticipantOnAuctionController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreParticipantOnAuctionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreParticipantOnAuctionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParticipantOnAuction  $participantOnAuction
     * @return \Illuminate\Http\Response
     */
    public function show(ParticipantOnAuction $participantOnAuction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParticipantOnAuction  $participantOnAuction
     * @return \Illuminate\Http\Response
     */
    public function edit(ParticipantOnAuction $participantOnAuction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParticipantOnAuctionRequest  $request
     * @param  \App\Models\ParticipantOnAuction  $participantOnAuction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParticipantOnAuctionRequest $request, ParticipantOnAuction $participantOnAuction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParticipantOnAuction  $participantOnAuction
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParticipantOnAuction $participantOnAuction)
    {
        //
    }
}
