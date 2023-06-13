<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientApiRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use GrahamCampbell\ResultType\Success;
use Illuminate\Contracts\Validation\Validator as ContractsValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator as ValidationValidator;
use Nette\Utils\Validators;
use Illuminate\Contracts\Validation\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return view('clients.index')
        ->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
        $request->validated();

        Client::create([
            'cedula' => $request->cedula, 
            'name' => $request->name,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'sex' => $request->sex,
            'civil_status' => $request->civil_status,
            'phone' => $request->phone,
            'cellphone' => $request->cellphone,
            'email' => $request->email,
            'description' => $request->description,

        ]);

        return redirect()->back()->with('message', 'Cliente registrado satisfactoriamente!');


    }

    public function storeClientApi(StoreClientApiRequest $request)
    {
        $request->validated();

        Client::create([
            'cedula' => $request->cedula, 
            'name' => $request->name,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'sex' => $request->sex,
            'civil_status' => $request->civil_status,
            'phone' => $request->phone,
            'cellphone' => $request->cellphone,
            'email' => $request->email,
            'description' => $request->description,

        ]);

        return response()->json([
            'response' => true, 
            'success' => 'Cliente registrado correctamente'], 201);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $policies = $client->policies;
        return view('clients.show')
        ->with('client', $client)
        ->with('policies', $policies);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('clients.edit')
        ->with('client', $client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $request->validated();

        $client->update([

            'name' => $request->name,
            'lastname' => $request->lastname,
            'address' => $request->address,
            'sex' => $request->sex,
            'civil_status' => $request->civil_status,
            'phone' => $request->phone,
            'cellphone' => $request->cellphone,
            'email' => $request->email,
            'description' => $request->description, 

            
        ]);

        return redirect()->back()
        ->with('message', 'Datos del Cliente Actualizados Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
}
