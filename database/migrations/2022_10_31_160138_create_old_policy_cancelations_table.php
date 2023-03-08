<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_policy_cancelations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('policy_id'); // Id poliza
            $table->unsignedBigInteger('user_id');  // Id Usuario
           
            // $table->float('interest_rate_paid'); 
            // // $table->float('interest_rate_paid_residuary');
            // $table->float('contract_rate_paid'); 
            // // $table->float('contract_rate_paid_residuary'); 
            // $table->float('capital_paid'); 
            // // $table->float('capital_paid_residuary'); 
            $table->float('amount'); 

            $table->date('date_paid');

            $table->string('cancelation_note');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('policy_id')->references('id')->on('old_policies');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('old_policy_cancelations');
    }
};
