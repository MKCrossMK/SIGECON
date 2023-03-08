<?php

namespace App\Http\Controllers;

use App\Models\PolicyDetail;
use App\Http\Requests\StorePolicyDetailRequest;
use App\Http\Requests\UpdatePolicyDetailRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Exists;

class PolicyDetailController extends Controller
{
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
     * @param  \App\Http\Requests\StorePolicyDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePolicyDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PolicyDetail  $policyDetail
     * @return \Illuminate\Http\Response
     */
    public function show(PolicyDetail $policyDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PolicyDetail  $policyDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PolicyDetail $policyDetail)
    {
        return view('policies.details.edit')
        ->with('policyDetail', $policyDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePolicyDetailRequest  $request
     * @param  \App\Models\PolicyDetail  $policyDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PolicyDetail $policyDetail)
    {            
            if ($request->hasFile('image')) {
                if (File::exists(public_path($policyDetail->image))) {
                    File::delete(public_path($policyDetail->image));
                }
                $file = $request->file('image');
                $destinationpath = '/img/policydetails/';
                $filename = time() . '-' . $file->getClientOriginalName();
                $uploadSuccess = $file->move(public_path() . $destinationpath, $filename);
                $policyDetailImg = $destinationpath . $filename;

                $policyDetail->update(['image' => $policyDetailImg]);
            }

            $policyDetail->update([
                'description' => $request->description,
                'stone_type' => $request->stone_type,
            ]);

            return redirect()->back()->
            with('message', 'Articulo - Prenda Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PolicyDetail  $policyDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PolicyDetail $policyDetail)
    {
        //
    }
}
