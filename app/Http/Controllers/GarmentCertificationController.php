<?php

namespace App\Http\Controllers;

use App\Models\GarmentCertification;
use App\Http\Requests\StoreGarmentCertificationRequest;
use App\Http\Requests\UpdateGarmentCertificationRequest;
use App\Models\GarmentCertificationPrice;
use App\Models\GoldRate;
use Illuminate\Support\Facades\Auth;

class GarmentCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $certifications = GarmentCertification::all();
        return view('certifications.index')
        ->with('certifications', $certifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $gold_rates = GoldRate::select('carat', 'price')->get();
        return view('certifications.create')
        ->with('gold_rates', $gold_rates);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGarmentCertificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGarmentCertificationRequest $request)
    {
        $request->validated();
        
        $certificationPrice = GarmentCertificationPrice::first();

        $articleImg = null;
        // Si se necesita que la imagen no sea obligatorio, tomar la funcion del old-policy

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if (isset($file)) {
                $destinationpath = '/img/certificationsImg/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $file->move(public_path() . $destinationpath, $filename);
                $articleImg = $destinationpath . $filename;
            } else {
                $file = null;
                $articleImg = null;
            }
        }


        GarmentCertification::create([
            'client_id' => $request->client_id,
            'user_id' => Auth::user()->id,
            'branch_office_id' => Auth::user()->branch_office->id,
            'description' => $request->a_description,
            'carat' => $request->a_carat,
            'image' => $articleImg,
            'weight' => $request->a_weight,
            'observations' => $request->observations,
            'stone_type' => $request->a_stone_type,
            'price' => $certificationPrice->price
        ]);

        $lastCertificationID = $this->lastPolicyID(Auth::user()->id);

        return redirect()->route('certifications.show', $lastCertificationID);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GarmentCertification  $garmentCertification
     * @return \Illuminate\Http\Response
     */
    public function show(GarmentCertification $garmentCertification)
    {
        return view('certifications.show')->with('garmentCertification', $garmentCertification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GarmentCertification  $garmentCertification
     * @return \Illuminate\Http\Response
     */
    public function edit(GarmentCertification $garmentCertification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGarmentCertificationRequest  $request
     * @param  \App\Models\GarmentCertification  $garmentCertification
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGarmentCertificationRequest $request, GarmentCertification $garmentCertification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GarmentCertification  $garmentCertification
     * @return \Illuminate\Http\Response
     */
    public function destroy(GarmentCertification $garmentCertification)
    {
        //
    }

    
    public function lastPolicyID($userID)
    {
        return GarmentCertification::latest('id')->Where('user_id', $userID)->first();
    }
}
