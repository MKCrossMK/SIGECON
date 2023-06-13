<?php

namespace App\Http\Controllers;

use App\Models\PolicyDisburse;
use App\Http\Requests\StorePolicyDisburseRequest;
use App\Http\Requests\UpdatePolicyDisburseRequest;
use App\Models\Branch_Office;
use App\Models\Cash;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PolicyDisburseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policies = Policy::where('disbursed', false)
        ->where('branch_offices_id', Auth::user()->branch_office->id)
        ->orderBy('created_at', 'desc')
        ->where('disbursed', false)
        ->get();

        return view('policies.disburse.index')
            ->with('policies', $policies);
    }

    public function disburseStore(Policy $policy){

        if (Auth::user()->cash_id != null) {

            $request = new Request([
                'policy_id' => $policy->id,
                'amount' => $policy->loan_value, 
                'user_id' => Auth::user()->id,
                'cash_id' => Auth::user()->cash_id,
            ]);

            $request->validate([
                'policy_id' => 'required|unique:policy_disburses',
                'amount' => ['required', 'numeric','max:'. Auth::user()->cash->balance],
                'user_id' => 'required',
                'cash_id' => 'required',
            ], [
                'policy_id.unique' => 'Poliza ha sido desembolsada',
                'amount.max' => 'No posee balance para desembolsar, pedir que el balance de su caja sea actualizado'
            ]);


            $cash = Cash::find($request->cash_id);


            PolicyDisburse::create([
                'policy_id' => $request->policy_id,
                'amount' => $request->amount, 
                'user_id' => $request->user_id,
                'cash_id' => $request->cash_id,
            ]);

            $policy->disbursed = true;
            $policy->save();

            $cash = Cash::find($request->cash_id);
            $cash->balance -= $request->amount;
            $cash->save();

            return redirect()->back()
            ->with('success', 'Poliza desembolsada sastifactoriamente');

        } else {

            return redirect()->back()
            ->with('error', 'No puede hacer el desembolso, su rol no es cajero');
        }

    }

    public function menuManager(){
        
        $cashes = Cash::where('branch_offices_id', Auth::user()->branch_office->id)->get();

        return view('policies.disburse.manager.cashes')
        ->with('cashes', $cashes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexManager(Cash $cash)
    {
        $policies = Policy::where('disbursed', false)
        ->where('branch_offices_id', $cash->branch_offices_id)
        ->orderBy('created_at', 'desc')
        ->get();

        return view('policies.disburse.manager.index')
            ->with('policies', $policies)
            ->with('cash', $cash);
    }


    public function disburseManagerStore(Policy $policy, Cash $cash){

        if (Auth::user()->role->name == 'Gerente') {

            $request = new Request([
                'policy_id' => $policy->id,
                'amount' => $policy->loan_value, 
                'user_id' => Auth::user()->id,
                'cash_id' => $cash->id,
            ]);

            $request->validate([
                'policy_id' => 'required|unique:policy_disburses',
                'amount' => ['required', 'numeric','max:'. $cash->balance],
                'user_id' => 'required',
                'cash_id' => 'required',
            ], [
                'policy_id.unique' => 'Poliza ha sido desembolsada',
                'amount.max' => 'No posee balance para desembolsar, pedir que el balance de su caja sea actualizado'

            ]);


            PolicyDisburse::create([
                'policy_id' => $request->policy_id,
                'amount' => $request->amount, 
                'user_id' => $request->user_id,
                'cash_id' => $request->cash_id,
            ]);

            $policy->disbursed = true;
            $policy->save();

            $cash->balance -= $request->amount;
            $cash->save();

            return redirect()->back()
            ->with('success', 'Poliza desembolsada sastifactoriamente');

        } else {

            return redirect()->back()
            ->with('error', 'No puede hacer el desembolso');
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePolicyDisburseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePolicyDisburseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PolicyDisburse  $policyDisburse
     * @return \Illuminate\Http\Response
     */
    public function show(PolicyDisburse $policyDisburse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PolicyDisburse  $policyDisburse
     * @return \Illuminate\Http\Response
     */
    public function edit(PolicyDisburse $policyDisburse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePolicyDisburseRequest  $request
     * @param  \App\Models\PolicyDisburse  $policyDisburse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePolicyDisburseRequest $request, PolicyDisburse $policyDisburse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PolicyDisburse  $policyDisburse
     * @return \Illuminate\Http\Response
     */
    public function destroy(PolicyDisburse $policyDisburse)
    {
        //
    }
}
