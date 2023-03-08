<?php

namespace App\Http\Controllers;

use App\Models\InterestRate;
use App\Http\Requests\StoreInterestRateRequest;
use App\Http\Requests\UpdateInterestRateRequest;
use Illuminate\Http\Request;

class InterestRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interestRate = InterestRate::all();

        return view('rates.interest-index')
        ->with('interestRate', $interestRate);

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
     * @param  \App\Http\Requests\StoreInterestRateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInterestRateRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InterestRate  $interestRate
     * @return \Illuminate\Http\Response
     */
    public function show(InterestRate $interestRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InterestRate  $interestRate
     * @return \Illuminate\Http\Response
     */
    public function edit(InterestRate $interestRate)
    {
        return view('rates.interest-edit')
        ->with('interestRate' , $interestRate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInterestRateRequest  $request
     * @param  \App\Models\InterestRate  $interestRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InterestRate $interestRate)
    {
        $request->validate([
            'porcent' => 'required',
        ], [
           'porcent.required' => 'Porcentaje de tasa de interest requerido',
        ]);

        
        $interestRate->update([
            'porcent' => $request->porcent,
        ]);

        return redirect()->route('rate.interest.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InterestRate  $interestRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(InterestRate $interestRate)
    {
        //
    }
}
