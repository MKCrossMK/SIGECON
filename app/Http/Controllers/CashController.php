<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Http\Requests\StoreCashRequest;
use App\Http\Requests\UpdateCashRequest;
use App\Models\CashHistory;
use Illuminate\Http\Request;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashes = Cash::all();
        
        return view('cashes.index')
        ->with('cashes', $cashes);
    }


    public function editBalance(Cash $cash){
        return view('cashes.balance.edit')
        ->with('cash', $cash);
    }

    public function updateBalance(Request $request, Cash $cash){

        $request->validate([
            'balance' => ['required', 'max:'. $cash->initial_amount, 'numeric'],
        ],
    [
        'balance.required' => 'Cantidad a actualizar es requerida',
        'balance.max' => 'Cantidad excede al limite de caja',
        'balance.numeric' => 'Exprese en numeros la cantidad a actualizar',

    ]);


    $cash->update([
        'balance' => $request->balance,
    ]);

    
    CashHistory::create([
        'cash_id' => $cash->id,
        'balance' => $request->balance,
        'reason' => CashHistory::UPDATE_REASON,
    ]);


        return redirect()->route('cashes.index');
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
     * @param  \App\Http\Requests\StoreCashRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function show(Cash $cash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function edit(Cash $cash)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashRequest  $request
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashRequest $request, Cash $cash)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cash $cash)
    {
        //
    }
}
