<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\PolicyController;
use App\Models\Policy;
use App\Models\PolicyPayment;
use App\Models\PolicyReferrer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Polizas 
Route::post('/policies/getclient', [PolicyController::class, 'getclient'])->name('policies.getclient');
Route::post('/policies/checkpassword', [PolicyController::class, 'checkPasswordManager'])->name('policies.checkpassword');
//Guardar clientes desde la poliza
Route::post('/policies/save/client', [ClientController::class, 'storeClientApi'])->name('policies.save.client');

Route::get('/policies/id/get',[PolicyController::class, 'lastPolicyID']);

Route::get('/policies/change/interest',[PolicyController::class, 'changeInterestRatePolicies']);

Route::get('/policies/change/contract',[PolicyController::class, 'changeContractRatePolicies']);

Route::get('/policies/interest_rate_month/skip/{policy}',[PolicyController::class, 'skipInterestRate']);

Route::get('/policies/status/expired',[PolicyController::class, 'changeStatusExpiredPolicy']);


// Route::get('/forget/session/{key}',[PolicyController::class, 'clearSessionKey']);





