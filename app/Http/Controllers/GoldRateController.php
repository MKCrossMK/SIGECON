<?php

namespace App\Http\Controllers;

use App\Models\GoldRate;
use App\Http\Requests\StoreGoldRateRequest;
use App\Http\Requests\UpdateGoldRateRequest;
use Illuminate\Http\Request;

class GoldRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gold_rates = GoldRate::all();
        return view('rates.gold-index')->with('gold_rate', $gold_rates);
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
     * @param  \App\Http\Requests\StoreGoldRateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGoldRateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GoldRate  $goldRate
     * @return \Illuminate\Http\Response
     */
    public function show(GoldRate $goldRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GoldRate  $goldRate
     * @return \Illuminate\Http\Response
     */
    public function edit(GoldRate $goldRate)
    {
        return view('rates.gold-edit')->with('goldRate', $goldRate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGoldRateRequest  $request
     * @param  \App\Models\GoldRate  $goldRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoldRate $goldRate)
    {
        $goldRate->update([
            'price' => $request->price
        ]);
        return redirect()->back()->with('success', 'Precio actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoldRate  $goldRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoldRate $goldRate)
    {
        //
    }
}
