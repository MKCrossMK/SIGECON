<?php

namespace App\Http\Controllers;

use App\Models\PolicyPayment;
use App\Http\Requests\StorePolicyPaymentRequest;
use App\Http\Requests\UpdatePolicyPaymentRequest;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyPaymentController extends Controller
{

    public $date_start;
    public $date_end;
   
    public function __construct()
    {
        $this->date_start = date('Y-m-d'); // Fecha de hoy
        $this->date_end =  date('Y-m-d', strtotime(date('Y-m-d') . '+4 month')); //  4 meses apartir de hoy  

    }


    public function makePayCreate(Policy $policy)
    {
        $total = $policy->capital_pay +  $policy->interest_pay + $policy->contract_pay;

        if ($total <= 0) {
            return redirect()->back()
                ->with('warning', 'La poliza: ' . $policy->number_policy . ' no tiene adeudo');
        } else {
            return view('policies.makepay')
                ->with('policy', $policy);
        }
    }


    public function makePayStore(Request $request, Policy $policy)
    {
        $request->validate([
            'amount_pay' => 'required',
        ], ['amount_pay.required' => 'Monto es obligatorio']);

        if ($request->amount_pay >= $policy->interest_pay + $policy->contract_pay + $policy->capital_pay) {
            return redirect()->back()
            ->with('error', 'Sí el cliente desea pagar el prestamo completo, ir a cancelación de poliza');
            
        } else {

            if ($request->amount_pay >= $policy->interest_pay + $policy->contract_pay) {

                $paid =  (float)$request->amount_pay;

                // $paid es lo que se recibe por el request

                $interest = $policy->interest_pay > $paid ? $paid : $policy->interest_pay;  // Si el interes que hay en poliza es mayor que el pago que se recibe, el interes es igual al pago y sera todo para la variable interest, de lo contrario, la variable interes tomara el valor de lo que se debe en la poliza

                $interest_residuary = $policy->interest_pay - $interest > 0 ?  $policy->interest_pay - $interest : 0;

                $paid = $paid - $interest;



                $contract  = $policy->contract_pay > $paid ? $paid : $policy->contract_pay;

                $contractResiduary = $policy->contract_pay - $contract > 0 ? $policy->contract_pay - $contract : 0;

                $paid = $paid - $contract;



                $capital  = $policy->capital_pay > $paid ? $paid : $policy->capital_pay;

                $capitalResiduary = $policy->capital_pay - $contract > 0 ? $policy->capital_pay - $capital : 0;

                $paid = $paid - $capital;


                $policy->update([
                    'status_credit_pay' => 1,
                    'interest_pay' => $interest_residuary,
                    'contract_pay' => $contractResiduary,
                    'capital_pay' => $capitalResiduary,
                    'date_start' => $this->date_start,
                    'date_end' => $this->date_end,
                    'status' => Policy::STATUS_RENOVATED,

                ]);


              PolicyPayment::create([
                    'policy_id' => $policy->id,
                    'user_id' => Auth::user()->id,
                    'branch_offices_id' => Auth::user()->branch_office->id,
                    'interest_rate_paid' => $interest,
                    'interest_rate_paid_residuary' => $interest_residuary,
                    // 'cp_interest_rate_paid_residuary' => $interest_residuary,
                    'contract_rate_paid' => $contract,
                    'contract_rate_paid_residuary' => $contractResiduary,
                    // 'cp_contract_rate_paid_residuary' => $contractResiduary,
                    'capital_paid' => $capital,
                    'capital_paid_residuary' => $capitalResiduary,
                    // 'cp_capital_paid_residuary' => $capitalResiduary,
                    'amount' => (float)$request->amount_pay,
                    'date_paid' => date('Y-m-d'),
                ]);
                
                $policyPayment =  PolicyPayment::latest()->where('policy_id', $policy->id)->first();


                $total = $policy->capital_pay +  $policy->interest_pay + $policy->contract_pay;


                if ($total <= 0) {
                    $policy->update([
                        'status' => Policy::STATUS_CANCELED, 
                    ]);
                } 
                
                return view('print.policies.payment')
                    ->with('success', 'Pago Realizado Correctamente')
                    ->with('policyPayment', $policyPayment)
                    ->with('policy', $policy);
            } else {
                return redirect()->back()
                    ->with('error', 'Se debe pagar los interes completos');
            }
        }
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
     * @param  \App\Http\Requests\StorePolicyPaymentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePolicyPaymentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PolicyPayment  $policyPayment
     * @return \Illuminate\Http\Response
     */
    public function show(PolicyPayment $policyPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PolicyPayment  $policyPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(PolicyPayment $policyPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePolicyPaymentRequest  $request
     * @param  \App\Models\PolicyPayment  $policyPayment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePolicyPaymentRequest $request, PolicyPayment $policyPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PolicyPayment  $policyPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(PolicyPayment $policyPayment)
    {
        //
    }
}
