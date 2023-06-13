<?php

namespace App\Http\Controllers;

use App\Models\CashHistory;
use App\Http\Requests\StoreCashHistoryRequest;
use App\Http\Requests\UpdateCashHistoryRequest;

class CashHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
     * @param  \App\Http\Requests\StoreCashHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashHistory  $cashHistory
     * @return \Illuminate\Http\Response
     */
    public function show(CashHistory $cashHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashHistory  $cashHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(CashHistory $cashHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashHistoryRequest  $request
     * @param  \App\Models\CashHistory  $cashHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashHistoryRequest $request, CashHistory $cashHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashHistory  $cashHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashHistory $cashHistory)
    {
        //
    }
}
