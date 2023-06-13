<?php

namespace App\Http\Controllers;

use App\Models\PolicyCancelation;
use App\Http\Requests\StorePolicyCancelationRequest;
use App\Http\Requests\UpdatePolicyCancelationRequest;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyCancelationController extends Controller
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

    public function makeCancelationCreate(Policy $policy)
    {

        $total = $policy->capital_pay +  $policy->interest_pay + $policy->contract_pay;

        if ($total <= 0 && $policy->status == Policy::STATUS_CANCELED) {

            return redirect()->back()
                ->with('warning', 'La poliza: ' . $policy->number_policy . ' está cancelada');
        } else {
            return view('policies.makecancelation')
                ->with('policy', $policy);
        }
    }

    public function makeCancelationStore(Request $request, Policy $policy)
    {
        $total = $policy->capital_pay +  $policy->interest_pay + $policy->contract_pay;

        if ($total <= 0 && $policy->status == Policy::STATUS_CANCELED) {

            return redirect()->route('policies.index')
            ->with('warning', 'La poliza: ' . $policy->number_policy . ' está cancelada');

        } else {
            PolicyCancelation::create([
                'policy_id' => $policy->id,
                'user_id' => Auth::user()->id,
                'branch_offices_id' => Auth::user()->branch_office->id,
                'interest_rate_paid' => $policy->interest_pay,
                'contract_rate_paid' => $policy->contract_pay,
                'capital_paid' => $policy->capital_pay,
                'date_paid' => $this->date_start,
                'amount' => $total,
            ]);


            $policy->update([
                'status_cancelation' => 1,
                'interest_pay' => 0,
                'contract_pay' => 0,
                'capital_pay' => 0,
                'status' => Policy::STATUS_CANCELED,

            ]);

            $policyCancelation =  PolicyCancelation::latest()->where('policy_id', $policy->id)->first();


            return view('print.policies.cancelation')
                ->with('success', 'La poliza: ' . $policy->number_policy . ' Se ha cancelado Correctamente')
                ->with('policyCancelation', $policyCancelation)
                ->with('policy', $policy);
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
     * @param  \App\Http\Requests\StorePolicyCancelationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePolicyCancelationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PolicyCancelation  $policyCancelation
     * @return \Illuminate\Http\Response
     */
    public function show(PolicyCancelation $policyCancelation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PolicyCancelation  $policyCancelation
     * @return \Illuminate\Http\Response
     */
    public function edit(PolicyCancelation $policyCancelation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePolicyCancelationRequest  $request
     * @param  \App\Models\PolicyCancelation  $policyCancelation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePolicyCancelationRequest $request, PolicyCancelation $policyCancelation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PolicyCancelation  $policyCancelation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PolicyCancelation $policyCancelation)
    {
        //
    }
}
