<?php

namespace App\Http\Controllers;

use App\Models\OldPolicyRenovation;
use App\Http\Requests\StoreOldPolicyRenovationRequest;
use App\Http\Requests\UpdateOldPolicyRenovationRequest;
use App\Models\OldPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OldPolicyRenovationController extends Controller
{

    public $date_start;
    public $date_end;
    
    public function __construct()
    {
        $this->date_start = date('Y-m-d'); // Fecha de hoy
        $this->date_end =  date('Y-m-d', strtotime(date('Y-m-d') . '+4 month')); //  4 meses apartir de hoy  
    }


    public function makeRenovationCreate(OldPolicy $oldPolicy)
    {

            return view('old-policies.makerenovation')
                ->with('oldPolicy', $oldPolicy);
    }

    public function makeRenovationStore(Request $request, OldPolicy $oldPolicy)
    {

        OldPolicyRenovation::create([
            'policy_id' => $oldPolicy->id,
            'user_id' => Auth::user()->id,
            'date_paid' => $request->date_paid,
            'amount' => $request->amount_pay,
        ]);


        $oldPolicy->update([
            'status_renovation' => 1,
            'status' => OldPolicy::STATUS_RENOVATED,

        ]);

        $oldPolicyRenovation =  OldPolicyRenovation::latest()->where('policy_id', $oldPolicy->id)->first();



        return view('print.old-policies.renovation')
        ->with('success', 'Renovación Realizada Correctamente')
        ->with('oldPolicyRenovation', $oldPolicyRenovation)
        ->with('oldPolicy', $oldPolicy);

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
     * @param  \App\Http\Requests\StoreOldPolicyRenovationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOldPolicyRenovationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OldPolicyRenovation  $oldPolicyRenovation
     * @return \Illuminate\Http\Response
     */
    public function show(OldPolicyRenovation $oldPolicyRenovation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OldPolicyRenovation  $oldPolicyRenovation
     * @return \Illuminate\Http\Response
     */
    public function edit(OldPolicyRenovation $oldPolicyRenovation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOldPolicyRenovationRequest  $request
     * @param  \App\Models\OldPolicyRenovation  $oldPolicyRenovation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOldPolicyRenovationRequest $request, OldPolicyRenovation $oldPolicyRenovation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OldPolicyRenovation  $oldPolicyRenovation
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldPolicyRenovation $oldPolicyRenovation)
    {
        //
    }
}
