<?php

namespace App\Http\Controllers;

use App\Models\PolicyReferrer;
use App\Http\Requests\StorePolicyReferrerRequest;
use App\Http\Requests\UpdatePolicyReferrerRequest;

class PolicyReferrerController extends Controller
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
     * @param  \App\Http\Requests\StorePolicyReferrerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePolicyReferrerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PolicyReferrer  $policyReferrer
     * @return \Illuminate\Http\Response
     */
    public function show(PolicyReferrer $policyReferrer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PolicyReferrer  $policyReferrer
     * @return \Illuminate\Http\Response
     */
    public function edit(PolicyReferrer $policyReferrer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePolicyReferrerRequest  $request
     * @param  \App\Models\PolicyReferrer  $policyReferrer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePolicyReferrerRequest $request, PolicyReferrer $policyReferrer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PolicyReferrer  $policyReferrer
     * @return \Illuminate\Http\Response
     */
    public function destroy(PolicyReferrer $policyReferrer)
    {
        //
    }
}
