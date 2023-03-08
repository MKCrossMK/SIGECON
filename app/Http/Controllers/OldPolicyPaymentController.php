<?php

namespace App\Http\Controllers;

use App\Models\OldPolicyPayment;
use App\Http\Requests\StoreOldPolicyPaymentRequest;
use App\Http\Requests\UpdateOldPolicyPaymentRequest;
use App\Models\OldPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OldPolicyPaymentController extends Controller
{

    public $date_start;
    public $date_end;
    public $statusApproved;
    public $statusRenovated;
    public $statusCanceled;
    
    public function __construct()
    {
        $this->date_start = date('Y-m-d'); // Fecha de hoy
        $this->date_end =  date('Y-m-d', strtotime(date('Y-m-d') . '+4 month')); //  4 meses apartir de hoy  

        $this->statusApproved = "Aprobada";
        $this->statusRenovated = "Renovada";
        $this->statusCanceled = "Cancelada";
    }


    public function makePayCreate(OldPolicy $oldPolicy)
    {
        // $total = $policy->capital_pay +  $policy->interest_pay + $policy->contract_pay;

        return view('old-policies.makepay')
            ->with('oldPolicy', $oldPolicy);
    }


    public function makePayStore(Request $request, OldPolicy $oldPolicy)
    {
        $request->validate([
            'amount_pay' => 'required',
            'date_'
        ], ['amount_pay.required' => 'Monto es obligatorio']);

                $oldPolicy->update([
                    'status_credit_pay' => 1,
                    'status' => $this->statusRenovated,
                ]);

                OldPolicyPayment::create([
                    'policy_id' => $oldPolicy->id,
                    'user_id' => Auth::user()->id,

                    'amount' => (float)$request->amount_pay,
                    'date_paid' => $request->date_paid,
                ]);

                $oldPolicyPayment =  OldPolicyPayment::latest()->where('policy_id', $oldPolicy->id)->first();

                return view('print.old-policies.payment')
                    ->with('success', 'Pago Realizado Correctamente')
                    ->with('oldPolicyPayment', $oldPolicyPayment)
                    ->with('oldPolicy', $oldPolicy);
    }



    public function printPolicyPayment(OldPolicyPayment $oldPolicyPayment){

        
        return view('print.old-policies.paymentshow')
                    ->with('oldPolicyPayment', $oldPolicyPayment);
    }

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
     * @param  \App\Http\Requests\StoreOldPolicyPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOldPolicyPaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OldPolicyPayment  $oldPolicyPayment
     * @return \Illuminate\Http\Response
     */
    public function show(OldPolicyPayment $oldPolicyPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OldPolicyPayment  $oldPolicyPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(OldPolicyPayment $oldPolicyPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOldPolicyPaymentRequest  $request
     * @param  \App\Models\OldPolicyPayment  $oldPolicyPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOldPolicyPaymentRequest $request, OldPolicyPayment $oldPolicyPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OldPolicyPayment  $oldPolicyPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldPolicyPayment $oldPolicyPayment)
    {
        //
    }
}
