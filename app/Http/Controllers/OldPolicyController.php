<?php

namespace App\Http\Controllers;

use App\Models\OldPolicy;
use App\Http\Requests\StoreOldPolicyRequest;
use App\Http\Requests\UpdateOldPolicyRequest;
use App\Models\GoldRate;
use App\Models\InterestRate;
use App\Models\OldPolicyReferrer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Mockery\Undefined;

class OldPolicyController extends Controller
{

    public $policiesStatus;
    
    public function __construct()
    {
        $this->policiesStatus = [OldPolicy::STATUS_APPROVED, OldPolicy::STATUS_RENOVATED, OldPolicy::STATUS_CANCELED, OldPolicy::STATUS_AUCTIONED, OldPolicy::STATUS_EXPIRED];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oldPolicies = OldPolicy::all();
        return view('old-policies.index')
        ->with('oldPolicies', $oldPolicies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gold_rates = GoldRate::select('carat', 'price')->get();
        $interest_rates = InterestRate::all();

        return view('old-policies.create')
            ->with('gold_rates', $gold_rates)
            ->with('interest_rates', $interest_rates)
            ->with('policiesStatus', $this->policiesStatus);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOldPolicyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOldPolicyRequest $request)
    {

        // dd($request);
        $request->validated();

        $lastReferrerID = null;
        $lastRefID =  null;        
        if($request->ref_cedula != "") {
            OldPolicyReferrer::create([
                'cedula' => $request->ref_cedula,
                'name' => $request->ref_name,
                'phone' => $request->ref_phone,
                'address' => $request->ref_address,
                'note' => $request->ref_note,
                'user_id' => Auth::user()->id,
            ]);

            $lastReferrerID =  $this->lastReferrerID(Auth::user()->id);
            $lastRefID = $lastReferrerID->id == null ? null : $lastReferrerID->id;            
        }


        if (count($request['description']) > 0 && $request->client_id != null ) {

            $oldPolicy = OldPolicy::create([
                'number_policy' => $request->number_policy,
                'date_start' => $request->date_start,
                'date_end' => $request->date_end,
                'client_id' => $request->client_id,
                'loan_value' => $request->loan_value,
                'validity_months' => $request->validity_months,
                'interest_rate' => $request->interest_rate,
                'base_interest_rate' => $request->interest_rate,
                'contract_rate' => $request->contract_rate,
                'base_contract_rate' => $request->contract_rate,
                'capital_pay' => $request->capital_pay,
                'base_capital_pay' => $request->capital_pay,
                'interest_pay' => $request->interest_pay,
                'contract_pay' => $request->contract_pay,
                'note_policy' => $request->note_policy,
                'user_id' => Auth::user()->id,
                'status' => $request->status,
                'branch_offices_id' => Auth::user()->branch_office_id,
                'referrer_id' => $lastRefID,
            ]);

            $lastOldPolicyID = $this->lastPolicyID(Auth::user()->id);

            $policyDetailImg = null;

            for ($i = 0; $i < count($request['description']); $i++) {

              
                if ($request->hasFile('image') ) {
                    $file = $request->file(['image']);
                    if(isset($file[$i])){
                        $destinationpath = '/img/oldpolicydetails/';
                        $filename = time() . '-' . $file[$i]->getClientOriginalName();
                        $uploadSuccess = $file[$i]->move(public_path() . $destinationpath, $filename);
                        $policyDetailImg = $destinationpath . $filename;
                    }else{
                        $file[$i] = null;
                        $policyDetailImg = null;
                    }
                }

                $data[] = array(
                    'old_policy_id' => $lastOldPolicyID,
                    'image' => $policyDetailImg,
                    'description' => $request['description'][$i],
                    'carat' => $request['carat'][$i],
                    'stone_type' => $request['stone_type'][$i],
                    'weight' => $request['weight'][$i],
                    'valued_price' => $request['valued_price'][$i],
                    'loan_price' => $request['loan_price'][$i],
                );
            }

            $oldPolicy->policyDetails()->createMany($data);

            
            return redirect()->route('old.policies.show', $lastOldPolicyID);
        }
        else{
            return redirect()->route('policies.create')
            ->with('error', 'Error de solicitud, compruebe que todos los datos esten correctos al enviar');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OldPolicy  $oldPolicy
     * @return \Illuminate\Http\Response
     */
    public function show(OldPolicy $oldPolicy)
    {
        // dd($oldPolicy);
        $oldPolicyDetails = $oldPolicy->policyDetails;

        return view('old-policies.show')
        ->with('oldPolicy', $oldPolicy)
        ->with('oldPolicyDetails', $oldPolicyDetails)
        ->with('policiesStatus', $this->policiesStatus);
        ;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OldPolicy  $oldPolicy
     * @return \Illuminate\Http\Response
     */
    public function edit(OldPolicy $oldPolicy)
    {
        return view('old-policies.edit')
        ->with('oldPolicy', $oldPolicy)
        ->with('policiesStatus', $this->policiesStatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOldPolicyRequest  $request
     * @param  \App\Models\OldPolicy  $oldPolicy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOldPolicyRequest $request, OldPolicy $oldPolicy)
    {
        $oldPolicy->update([
            'status' => $request->status,
        ]);
        return redirect()->route('old.policies.show', $oldPolicy->id)
        ->with('success', 'Estado de poliza actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OldPolicy  $oldPolicy
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldPolicy $oldPolicy)
    {
        //
    }

    public function lastPolicyID($userID)
    {
        return OldPolicy::latest('id')->Where('user_id', $userID)->first();
    }

    public function lastReferrerID($userID)
    {
        return OldPolicyReferrer::latest('id')->Where('user_id', $userID)->first();
    }


    public function printPolicy(OldPolicy $oldPolicy){

        $policyDetails = $oldPolicy->policyDetails;

        return view('print.policies.policy')
        ->with('oldPolicy', $oldPolicy)
        ->with('policyDetails', $policyDetails);
    }


}
