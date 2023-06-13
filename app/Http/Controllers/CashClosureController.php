<?php

namespace App\Http\Controllers;

use App\Models\CashClosure;
use App\Http\Requests\StoreCashClosureRequest;
use App\Http\Requests\UpdateCashClosureRequest;
use App\Models\Cash;
use App\Models\CashHistory;
use Illuminate\Support\Facades\Auth;

class CashClosureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cashes.closures.index');
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
     * @param  \App\Http\Requests\StoreCashClosureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCashClosureRequest $request)
    {
        if (Auth::user()->role->name == 'Cajero') {

            $cash = Cash::find(Auth::user()->cash->id);

            dd($cash);
            
        

            // CashClosure::create([
            //     'cash_id',
            //     'initial_amount',
            //     'income',
            //     'expense',
            //     'cash_id',
            // ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CashClosure  $cashClosure
     * @return \Illuminate\Http\Response
     */
    public function show(CashClosure $cashClosure)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CashClosure  $cashClosure
     * @return \Illuminate\Http\Response
     */
    public function edit(CashClosure $cashClosure)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCashClosureRequest  $request
     * @param  \App\Models\CashClosure  $cashClosure
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCashClosureRequest $request, CashClosure $cashClosure)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CashClosure  $cashClosure
     * @return \Illuminate\Http\Response
     */
    public function destroy(CashClosure $cashClosure)
    {
        //
    }
}
