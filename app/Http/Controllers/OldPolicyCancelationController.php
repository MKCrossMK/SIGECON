<?php

namespace App\Http\Controllers;

use App\Models\OldPolicyCancelation;
use App\Http\Requests\StoreOldPolicyCancelationRequest;
use App\Http\Requests\UpdateOldPolicyCancelationRequest;
use App\Models\OldPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OldPolicyCancelationController extends Controller
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

    public function makeCancelationCreate(OldPolicy $oldPolicy)
    {

        $s_policy = OldPolicyCancelation::where('policy_id', $oldPolicy->id)->first();

        if ($s_policy != null) {

            return redirect()->back()
                ->with('warning', 'La poliza: ' . $oldPolicy->number_policy . ' está registrada como cancela, este proceso solo se realiza una vez');
        } else {
            return view('old-policies.makecancelation')
                ->with('oldPolicy', $oldPolicy);
        }
    }

    public function makeCancelationStore(Request $request, OldPolicy $oldPolicy)
    {

        OldPolicyCancelation::create([
            'policy_id' => $oldPolicy->id,
            'user_id' => Auth::user()->id,
            'date_paid' => $this->date_start,
            'amount' => $request->amount_pay,
            'description' => $request->description,
        ]);


        $oldPolicy->update([
            'status_cancelation' => 1,
            'status' => $this->statusCanceled,

        ]);

        $policyCancelation =  OldPolicyCancelation::latest()->where('policy_id', $oldPolicy->id)->first();


        return view('print.policies.cancelation')
            ->with('success', 'La poliza: ' . $oldPolicy->number_policy . ' Se ha registrado como cancelado Correctamente')
            ->with('policyCancelation', $policyCancelation)
            ->with('policy', $oldPolicy);
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
     * @param  \App\Http\Requests\StoreOldPolicyCancelationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOldPolicyCancelationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OldPolicyCancelation  $oldPolicyCancelation
     * @return \Illuminate\Http\Response
     */
    public function show(OldPolicyCancelation $oldPolicyCancelation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OldPolicyCancelation  $oldPolicyCancelation
     * @return \Illuminate\Http\Response
     */
    public function edit(OldPolicyCancelation $oldPolicyCancelation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOldPolicyCancelationRequest  $request
     * @param  \App\Models\OldPolicyCancelation  $oldPolicyCancelation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOldPolicyCancelationRequest $request, OldPolicyCancelation $oldPolicyCancelation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OldPolicyCancelation  $oldPolicyCancelation
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldPolicyCancelation $oldPolicyCancelation)
    {
        //
    }
}
