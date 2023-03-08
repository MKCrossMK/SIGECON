<?php

namespace App\Http\Controllers;

use App\Models\PolicyRenovation;
use App\Http\Requests\StorePolicyRenovationRequest;
use App\Http\Requests\UpdatePolicyRenovationRequest;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyRenovationController extends Controller
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
    }


    public function makeRenovationCreate(Policy $policy)
    {

        $total_interest =  $policy->interest_pay + $policy->contract_pay;
        if ($total_interest <= 0) {

            return redirect()->back()
                ->with('warning', 'El cliente dueño de la poliza: ' . $policy->number_policy . ' no debe intereses ni contrato');
        } else {
            return view('policies.makerenovation')
                ->with('policy', $policy);
        }
    }

    public function makeRenovationStore(Request $request, Policy $policy)
    {
        $total = $policy->interest_pay + $policy->contract_pay;

        PolicyRenovation::create([
            'policy_id' => $policy->id,
            'user_id' => Auth::user()->id,
            'interest_rate_paid' => $policy->interest_pay,
            'contract_rate_paid' => $policy->contract_pay,
            'date_paid' => $this->date_start,
            'amount' => $total,
        ]);


        $policy->update([
            'status_renovation' => 1,
            'interest_pay' => 0,
            'contract_pay' => 0,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'status' => Policy::STATUS_RENOVATED,

        ]);

        $policyRenovation =  PolicyRenovation::latest()->where('policy_id', $policy->id)->first();



        return view('print.policies.renovation')
        ->with('success', 'Renovación Realizada Correctamente')
        ->with('policyRenovation', $policyRenovation)
        ->with('policy', $policy);

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
     * @param  \App\Http\Requests\StorePolicyRenovationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePolicyRenovationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PolicyRenovation  $policyRenovation
     * @return \Illuminate\Http\Response
     */
    public function show(PolicyRenovation $policyRenovation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PolicyRenovation  $policyRenovation
     * @return \Illuminate\Http\Response
     */
    public function edit(PolicyRenovation $policyRenovation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePolicyRenovationRequest  $request
     * @param  \App\Models\PolicyRenovation  $policyRenovation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePolicyRenovationRequest $request, PolicyRenovation $policyRenovation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PolicyRenovation  $policyRenovation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PolicyRenovation $policyRenovation)
    {
        //
    }
}
