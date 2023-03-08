<?php

namespace App\Http\Controllers;

use App\Models\OldPolicyDetail;
use App\Http\Requests\StoreOldPolicyDetailRequest;
use App\Http\Requests\UpdateOldPolicyDetailRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OldPolicyDetailController extends Controller
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
     * @param  \App\Http\Requests\StoreOldPolicyDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOldPolicyDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OldPolicyDetail  $oldPolicyDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OldPolicyDetail $oldPolicyDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OldPolicyDetail  $oldPolicyDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OldPolicyDetail $oldPolicyDetail)
    {
        return view('old-policies.details.edit')
        ->with('oldPolicyDetail', $oldPolicyDetail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOldPolicyDetailRequest  $request
     * @param  \App\Models\OldPolicyDetail  $oldPolicyDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OldPolicyDetail $oldPolicyDetail)
    {
        
        if ($request->hasFile('image')) {
            if (File::exists(public_path($oldPolicyDetail->image))) {
                File::delete(public_path($oldPolicyDetail->image));
            }
            $file = $request->file('image');
            $destinationpath = '/img/oldpolicydetails/';
            $filename = time() . '-' . $file->getClientOriginalName();
            $uploadSuccess = $file->move(public_path() . $destinationpath, $filename);
            $policyDetailImg = $destinationpath . $filename;

            $oldPolicyDetail->update(['image' => $policyDetailImg]);
        }

        $oldPolicyDetail->update([
            'description' => $request->description,
            'stone_type' => $request->stone_type,
        ]);

        return redirect()->back()->
        with('message', 'Articulo - Prenda Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OldPolicyDetail  $oldPolicyDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OldPolicyDetail $oldPolicyDetail)
    {
        //
    }
}
