<?php

namespace App\Http\Controllers;

use App\Models\Adjudication;
use App\Http\Requests\StoreAdjudicationRequest;
use App\Http\Requests\UpdateAdjudicationRequest;

class AdjudicationController extends Controller
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
     * @param  \App\Http\Requests\StoreAdjudicationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdjudicationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adjudication  $adjudication
     * @return \Illuminate\Http\Response
     */
    public function show(Adjudication $adjudication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adjudication  $adjudication
     * @return \Illuminate\Http\Response
     */
    public function edit(Adjudication $adjudication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdjudicationRequest  $request
     * @param  \App\Models\Adjudication  $adjudication
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdjudicationRequest $request, Adjudication $adjudication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Adjudication  $adjudication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Adjudication $adjudication)
    {
        //
    }
}
