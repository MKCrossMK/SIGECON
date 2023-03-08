<?php

namespace App\Http\Controllers;

use App\Models\GarmentCertification;
use App\Http\Requests\StoreGarmentCertificationRequest;
use App\Http\Requests\UpdateGarmentCertificationRequest;
use App\Models\GoldRate;

class GarmentCertificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $certifications = GarmentCertification::all();
        return view('certifications.index');
        // ->with('certifications', $certifications);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GarmentCertification  $garmentCertification
     * @return \Illuminate\Http\Response
     */
    public function show(GarmentCertification $garmentCertification)
    {
        //
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
}
