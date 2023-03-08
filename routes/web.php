<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\AuctionDetailController;
use App\Http\Controllers\AuctionParticipantController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GarmentCertificationController;
use App\Http\Controllers\GoldRateController;
use App\Http\Controllers\InterestRateController;
use App\Http\Controllers\OldPolicyCancelationController;
use App\Http\Controllers\OldPolicyController;
use App\Http\Controllers\OldPolicyDetailController;
use App\Http\Controllers\OldPolicyPaymentController;
use App\Http\Controllers\OldPolicyRenovationController;
use App\Http\Controllers\PolicyCancelationController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\PolicyDetailController;
use App\Http\Controllers\PolicyPaymentController;
use App\Http\Controllers\PolicyRenovationController;
use App\Http\Controllers\UserController;
use App\Models\Auction;
use App\Models\OldPolicyCancelation;
use App\Models\OldPolicyRenovation;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


route::middleware(['auth'])->group(function () {
    
    // Clients
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/client/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/client/store', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/client/edit/{client}', [ClientController::class, 'edit'])->name('clients.edit');
    Route::patch('/client/update/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::get('/client/show/{client}', [ClientController::class, 'show'])->name('clients.show');


    // Certifications

    Route::get('/certifications', [GarmentCertificationController::class, 'index'])->name('certifications.index');
    Route::get('/certifications/create', [GarmentCertificationController::class, 'create'])->name('certifications.create');
    Route::post('/certifications/store', [GarmentCertificationController::class, 'store'])->name('certifications.store');
    Route::get('/certifications/edit/{garmentCertification}', [GarmentCertificationController::class, 'edit'])->name('certifications.edit');
    Route::patch('/certifications/update/{garmentCertification}', [GarmentCertificationController::class, 'update'])->name('certifications.update');
    Route::get('/certifications/show/{garmentCertification}', [GarmentCertificationController::class, 'show'])->name('certifications.show');


    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::patch('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/reset/password/{user}', [UserController::class, 'resetPassword'])->name('users.reset.pass');
    Route::patch('/users/update/password/{user}', [UserController::class, 'updatePassword'])->name('users.update.pass');
    Route::get('/users/code/generate/{user}', [UserController::class, 'CodeUnique'])->name('users.code.generate');
    Route::get('/users/code/generate/request/{user}', [UserController::class, 'CodeUniqueRequest'])->name('users.code.request');
    Route::get('users/delete/{user}', [UserController::class, 'destroy'])->name('users.delete');
    Route::get('/users/configuration/{user}', [UserController::class, 'configure'])->name('users.config');


    // Policy (Polizas)

    Route::get('/policies', [PolicyController::class, 'index'])->name('policies.index');
    Route::get('/policies/create', [PolicyController::class, 'create'])->name('policies.create');
    Route::post('/policies/store', [PolicyController::class, 'store'])->name('policies.store');
    Route::get('/policies/show/{policy}', [PolicyController::class, 'show'])->name('policies.show');
    Route::get('/policies/detail/edit/{policyDetail}', [PolicyDetailController::class, 'edit'])->name('policies.detail.edit');
    Route::patch('/policies/detail/edit/{policyDetail}', [PolicyDetailController::class, 'update'])->name('policies.detail.update');

    Route::get('/policies/pay/create/{policy}', [PolicyPaymentController::class, 'makePayCreate'])->name('policies.pay.create');
    Route::post('/policies/pay/store/{policy}', [PolicyPaymentController::class, 'makePayStore'])->name('policies.pay.store');

    Route::get('/policies/renovation/create/{policy}', [PolicyRenovationController::class, 'makeRenovationCreate'])->name('policies.renovation.create');
    Route::post('/policies/renovation/store/{policy}', [PolicyRenovationController::class, 'makeRenovationStore'])->name('policies.renovation.store');

    Route::get('/policies/cancelation/create/{policy}', [PolicyCancelationController::class, 'makeCancelationCreate'])->name('policies.cancelation.create');
    Route::post('/policies/cancelation/store/{policy}', [PolicyCancelationController::class, 'makeCancelationStore'])->name('policies.cancelation.store');


    Route::get('/policies/print/{policy}', [PolicyController::class, 'printPolicy'])->name('policies.print');
    Route::get('/policies/print/payment/{policyPayment}', [PolicyController::class, 'printPolicyPayment'])->name('policies.print.payment');
    Route::get('/policies/print/renovation/{policyRenovation}', [PolicyController::class, 'printPolicyRenovation'])->name('policies.print.renovation');
    Route::get('/policies/print/cancelation/{policyCancelation}', [PolicyController::class, 'printPolicyCancelation'])->name('policies.print.cancelation');

                    // oldPolice ------------------------------------------------------------------------
 
    Route::get('/old/policies', [OldPolicyController::class, 'index'])->name('old.policies.index');
    Route::get('/old/policies/create', [OldPolicyController::class, 'create'])->name('old.policies.create');
    Route::post('/old/policies/store', [OldPolicyController::class, 'store'])->name('old.policies.store');
    Route::get('/old/policies/show/{oldPolicy}', [OldPolicyController::class, 'show'])->name('old.policies.show');
    Route::get('/old/policies/detail/edit/{oldPolicyDetail}', [OldPolicyDetailController::class, 'edit'])->name('old.policies.detail.edit');
    Route::patch('/old/policies/detail/edit/{oldPolicyDetail}', [OldPolicyDetailController::class, 'update'])->name('old.policies.detail.update');

    Route::patch('/old/policies/update/{oldPolicy}', [OldPolicyController::class, 'update'])->name('old.policies.update');


    Route::get('/old/policies/pay/create/{oldPolicy}', [OldPolicyPaymentController::class, 'makePayCreate'])->name('old.policies.pay.create');
    Route::post('/old/policies/pay/store/{oldPolicy}', [OldPolicyPaymentController::class, 'makePayStore'])->name('old.policies.pay.store');

    Route::get('/old/policies/renovation/create/{oldPolicy}', [OldPolicyRenovationController::class, 'makeRenovationCreate'])->name('old.policies.renovation.create');
    Route::post('/old/policies/renovation/store/{oldPolicy}', [OldPolicyRenovationController::class, 'makeRenovationStore'])->name('old.policies.renovation.store');

    Route::get('/old/policies/cancelation/create/{oldPolicy}', [OldPolicyCancelationController::class, 'makeCancelationCreate'])->name('old.policies.cancelation.create');
    Route::post('/old/policies/cancelation/store/{oldPolicy}', [OldPolicyCancelationController::class, 'makeCancelationStore'])->name('old.policies.cancelation.store');


    
    Route::get('/old/policies/print/{oldPolicy}', [OldPolicyController::class, 'printPolicy'])->name('old.policies.print');
    Route::get('/old/policies/print/payment/{oldPolicyPayment}', [OldPolicyPaymentController::class, 'printPolicyPayment'])->name('old.policies.print.payment');
    Route::get('/old/policies/print/renovation/{oldPolicyRenovation}', [OldPolicyController::class, 'printPolicyRenovation'])->name('old.policies.print.renovation');
    Route::get('/old/policies/print/cancelation/{oldPolicyCancelation}', [OldPolicyController::class, 'printPolicyCancelation'])->name('old.policies.print.cancelation');
    //Rate 

    Route::get('/rate/gold', [GoldRateController::class, 'index'])->name('rate.gold.index');
    Route::get('/rate/gold/edit/{goldRate}', [GoldRateController::class, 'edit'])->name('rate.gold.edit');
    Route::patch('/rate/gold/update/{goldRate}', [GoldRateController::class, 'update'])->name('rate.gold.update');

    Route::get('/rate/interest', [InterestRateController::class, 'index'])->name('rate.interest.index');
    Route::get('/rate/interest/edit/{interestRate}', [InterestRateController::class, 'edit'])->name('rate.interest.edit');
    Route::patch('/rate/interest/update/{interestRate}', [InterestRateController::class, 'update'])->name('rate.interest.update');



    // auction

    Route::get('/auction', [AuctionController::class, 'index'])->name('auctions.index');
    Route::post('/auction/store', [AuctionController::class, 'store'])->name('auctions.store');
    Route::get('/auction/start', [AuctionController::class, 'start'])->name('auctions.start');

    Route::get('/auction/go', [AuctionController::class, 'goToAuction'])->name('auctions.go');

    Route::get('/auction/close/{auction}', [AuctionController::class, 'closeAuction'])->name('auctions.close');


    Route::get('/auction/list', [AuctionController::class, 'auctionsList'])->name('auctions.list');
    Route::get('/auction/list/see/{auction}', [AuctionController::class, 'auctionListParticipant'])->name('auctions.list.see');
    Route::get('/auction/results/{auction}', [AuctionController::class, 'auctionInvoce'])->name('auctions.list.result');
    Route::get('/auction/invoce/participant/{participant}', [AuctionController::class, 'auctionInvoiceParticipant'])->name('auctions.invoice.participant');

    





    // auction detail
    Route::get('/auction/detail/store/policy/{policy}', [AuctionDetailController::class, 'store'])->name('auctions.details.store'); // new policies  this system
    Route::get('/auction/detail/store/old/policy/{oldPolicy}', [AuctionDetailController::class, 'storeOldPolicy'])->name('auctions.details.store.old'); // Old policies  this system


    Route::get('/auction/detail/edit/{auctionDetail}', [AuctionDetailController::class, 'edit'])->name('auctions.details.edit'); 
    Route::patch('/auction/detail/update/price/{auctionDetail}', [AuctionDetailController::class, 'updateFirstBidPrice'])->name('auctions.details.update.price'); 


    Route::get('/auction/detail/delete/{auctionDetail}', [AuctionDetailController::class, 'destroy'])->name('auctions.details.delete'); 

    Route::get('/auction/update/price/{auctionDetail}', [AuctionDetailController::class, 'upAuctionedrice'])->name('auctions.details.price.update'); 
    Route::patch('/auction/sell/policy/{auctionDetail}', [AuctionDetailController::class, 'sellPolicyAuctioned'])->name('auctions.details.sell'); 


    




    // auction participants

    Route::get('/auction/participants', [AuctionParticipantController::class, 'index'])->name('auctions.participants.index');
    Route::post('/auction/participants/store', [AuctionParticipantController::class, 'store'])->name('auctions.participants.store');
    Route::get('/auction/participants/edit/{auctionParticipant}', [AuctionParticipantController::class, 'edit'])->name('auctions.participants.edit');
    Route::patch('/auction/participants/update/{auctionParticipant}', [AuctionParticipantController::class, 'update'])->name('auctions.participants.update');


    Route::get('/auction/participants/send/{auctionParticipant}', [AuctionParticipantController::class, 'toAuction'])->name('auctions.participants.send');
    Route::post('/auction/participants/send/store/{auctionParticipant}', [AuctionParticipantController::class, 'sendToAuction'])->name('auctions.participants.send.store');













});

require __DIR__.'/auth.php';
