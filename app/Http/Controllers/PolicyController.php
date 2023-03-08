<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Http\Requests\StorePolicyRequest;
use App\Http\Requests\UpdatePolicyRequest;
use App\Models\Client;
use App\Models\GoldRate;
use App\Models\InterestRate;
use App\Models\PolicyCancelation;
use App\Models\PolicyDetail;
use App\Models\PolicyPayment;
use App\Models\PolicyReferrer;
use App\Models\PolicyRenovation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Unique;
use App\Services\Policy as PolicyService;
use Illuminate\Support\Facades\Session;

class PolicyController extends Controller
{
    public $date_start;
    public $date_end;

    public function __construct()
    {
        $this->date_start = date('Y-m-d'); // Fecha de hoy
        $this->date_end =  date('Y-m-d', strtotime(date('Y-m-d') . '+4 month')); //  4 meses apartir de hoy  

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policies = Policy::orderBy('created_at', 'desc')->get();
        return view('policies.index')
            ->with('policies', $policies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date_start = $this->date_start;
        $date_end = $this->date_end;

        $gold_rates = GoldRate::select('carat', 'price')->get();
        $interest_rates = InterestRate::all();

        return view('policies.create')
            ->with('gold_rates', $gold_rates)
            ->with('interest_rates', $interest_rates)
            ->with('date_start', $date_start)
            ->with('date_end', $date_end);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePolicyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePolicyRequest $request)
    {
        $request->validated();

        $number_policy = DB::select('CALL sp_policy_id(?,?)', array($this->date_start, Auth::user()->branch_office_id));

        $lastReferrerID = null;
        $lastRefID =  null;
        if ($request->ref_cedula != "") {
            PolicyReferrer::create([
                'cedula' => $request->ref_cedula,
                'name' => $request->ref_name,
                'phone' => $request->ref_phone,
                'address' => $request->ref_address,
                'note' => $request->ref_note,
                'user_id' => Auth::id(),
            ]);

            $lastReferrerID =  $this->lastReferrerID(Auth::user()->id);
            $lastRefID = $lastReferrerID->id == null ? null : $lastReferrerID->id;
        }


        if (count($request['description']) > 0 && $request->client_id != null) {
            $policy = Policy::create([
                'number_policy' => $number_policy[0]->policy_id,
                'date_start' => $this->date_start,
                'date_end' => $this->date_end,
                'last_updated_interest' => $this->date_start,
                'last_updated_contract' => $this->date_start,
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
                'c_interest_pay' => $request->interest_pay,
                'base_interest_pay' => $request->interest_pay,
                'contract_pay' => $request->contract_pay,
                'c_contract_pay' => $request->contract_pay,
                'base_contract_pay' => $request->contract_pay,
                'note_policy' => $request->note_policy,
                'user_id' => Auth::user()->id,
                'status' => Policy::STATUS_APPROVED,
                'branch_offices_id' => Auth::user()->branch_office_id,
                'referrer_id' =>  $lastRefID,
            ]);

            $lastPolicyID = $this->lastPolicyID(Auth::user()->id);

            $policyDetailImg = null;

            for ($i = 0; $i < count($request['description']); $i++) {

                // Si se necesita que la imagen no sea obligatorio, tomar la funcion del old-policy
                if ($request->hasFile('image')) {
                    $file = $request->file(['image']);
                    if (isset($file[$i])) {
                        $destinationpath = '/img/policydetails/';
                        $filename = time() . '-' . $file[$i]->getClientOriginalName();
                        $uploadSuccess = $file[$i]->move(public_path() . $destinationpath, $filename);
                        $policyDetailImg = $destinationpath . $filename;
                    } else {
                        $file[$i] = null;
                        $policyDetailImg = null;
                    }
                }

                $data[] = array(
                    'policy_id' => $lastPolicyID,
                    'image' => $policyDetailImg,
                    'description' => $request['description'][$i],
                    'carat' => $request['carat'][$i],
                    'stone_type' => $request['stone_type'][$i],
                    'weight' => $request['weight'][$i],
                    'valued_price' => $request['valued_price'][$i],
                    'loan_price' => $request['loan_price'][$i],
                );
            }

            $policy->policyDetails()->createMany($data);



            return redirect()->route('policies.show', $lastPolicyID);
        } else {
            return redirect()->route('policies.create')
                ->with('error', 'Error de solicitud, compruebe que todos los datos esten correctos al enviar');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function show(Policy $policy, Request $request)
    {
        // $interestRate = number_format($policy->loan_value * ($policy->interest_rate / 100), 1, '.', false);
        // dd($interestRate + 100);

        // dd($request->name);

        $policyDetails = $policy->policyDetails;

        return view('policies.show')
            ->with('policy', $policy)
            ->with('policyDetails', $policyDetails);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function edit(Policy $policy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePolicyRequest  $request
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePolicyRequest $request, Policy $policy)
    {
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Policy  $policy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Policy $policy)
    {
        //
    }


    // Obtener cliente desde la rutas de api, esto para generar clientes en las polizas

    public function getClient(Request $request)
    {
        $user_cedula = $request->cedula;

        $client = Client::select('id', 'name', 'lastname')->where('cedula', $user_cedula)->get();
        // $json = json_encode($client, JSON_FORCE_OBJECT);
        return $client;
    }


    // En las polizas para  cierto porcentajes de interes se requiere una password, que es el codigo unico del Gerente

    public function checkPasswordManager(Request $request)
    {
        $response = false;
        $roles = Role::select('id')->where('name', 'Gerente')->get();
        $role = $roles[0]->id;
        $u_code = User::select('unique_code')->where('rol_id', $role)->get();
        $u_code_count = User::select('unique_code')->where('rol_id', $role)->count();


        if ($u_code_count > 0) {
            for ($i = 0; $i < $u_code_count; $i++) {
                if ($u_code[$i]->unique_code != null) {
                    if (Crypt::decryptString($u_code[$i]->unique_code) == $request->code) {
                        $response = true;
                        break;
                    } else {
                        $response = false;
                    }
                } else {
                    $response = false;
                }
            }
        } else {
            $response = false;
        }

        return json_encode($response);
    }

    public function lastPolicyID($userID)
    {
        return Policy::latest('id')->Where('user_id', $userID)->first();
    }

    public function lastReferrerID($userID)
    {
        return PolicyReferrer::latest('id')->Where('user_id', $userID)->first();
    }



    public function changeInterestRatePolicies()
    {
        // Acuerdate miku que debes llevar el foreach al cronJob All Right

        foreach (PolicyService::getExpiredPolicyInterest() as $policy) {
            PolicyService::updatePolicyInterestRate($policy);
        }
    }

    public function changeContractRatePolicies()
    {
        // Acuerdate miku que debes llevar el foreach al cronJob All Right

        foreach (PolicyService::getExpiredPolicyContract() as $policy) {
            PolicyService::updatePolicyContractRate($policy);
        }
    }


    public function changeStatusExpiredPolicy()
    {

        foreach (PolicyService::getExpiredPolicy() as $policy) {
            PolicyService::updatePolicyStatusToExpired($policy);
        }
    }


    public function skipInterestRate(Policy $policy)
    {
        $response = false;

        // Probar la resta en $interst_pay

        if ($policy->interest_pay > 0 && $policy->skip_interest_rate == 0 && $policy->interest_rate > $policy->base_interest_rate) {
            $policy->interest_rate -= $policy->base_interest_rate;
            $policy->interest_pay -= $policy->capital_pay * ($policy->interest_rate / 100);
            $policy->c_interest_pay -= $policy->capital_pay * ($policy->interest_rate / 100);
            $policy->last_updated_interest = date('Y-m-d');
            $policy->skip_interest_rate = 1;

            $saved = $policy->save();

            if ($saved) {
                $response = true;
            } else {
                $response = false;
            }
        } else {
            $response = false;
        }

        return response()->json(json_encode($response));
    }

    public function printPolicy(Policy $policy)
    {

        $policyDetails = $policy->policyDetails;

        return view('print.policies.policy')
            ->with('policy', $policy)
            ->with('policyDetails', $policyDetails);
    }


    public function printPolicyPayment(PolicyPayment $policyPayment)
    {
        return view('print.policies.paymentshow')
            ->with('policyPayment', $policyPayment);
    }

    public function printPolicyRenovation(PolicyRenovation $policyRenovation)
    {
        return view('print.policies.renovationshow')
            ->with('policyRenovation', $policyRenovation);
    }

    public function printPolicyCancelation(PolicyCancelation $policyCancelation)
    {
        return view('print.policies.cancelationshow')
            ->with('policyCancelation', $policyCancelation);
    }
    // public function clearSessionKey($key)
    // {
    //     if (Session::has($key))
    //     {
    //         Session::forget($key);
    //     }
    // }
}
