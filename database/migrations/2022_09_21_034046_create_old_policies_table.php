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
        Schema::create('old_policies', function (Blueprint $table) {
            $table->id();
            $table->string('number_policy')->unique();
            $table->date('date_start');
            $table->date('date_end');
            // $table->date('last_updated_interest');
            // $table->date('last_updated_contract');
            $table->unsignedBigInteger('client_id');
            $table->float('loan_value', 12, 2); // valor a prestar
            $table->float('capital_pay', 12, 2); 
            $table->float('base_capital_pay', 12, 2); 
            $table->float('validity_months');
            $table->float('interest_rate'); // tasa de interes
            $table->float('base_interest_rate'); // base tasa de interes para hacer el calculo
            $table->float('contract_rate'); // tasa de contrato
            $table->float('base_contract_rate'); // base  tasa de contrato para hacer el calculo

            $table->float('interest_pay', 12, 2); // interes a pagar expresado en pesos
            // $table->float('c_interest_pay'); // interes a pagar expresado en pesos
            // $table->float('base_interest_pay'); //base de interes en numeros
            $table->float('contract_pay', 12, 2); // monto de contraro a pagar 
            // $table->float('c_contract_pay'); // monto de contraro a pagar 
            // $table->float('base_contract_pay');  // base de contrato a pagar
            $table->string('note_policy')->nullable();
            $table->string('place_vault')->nullable(); // lugar en boveda
            $table->string('status');
            $table->boolean('status_credit_pay')->default(0);
            $table->boolean('status_renovation')->default(0);
            $table->boolean('status_cancelation')->default(0);
            $table->unsignedBigInteger('user_id');  // Id Usuario
            $table->unsignedBigInteger('branch_offices_id'); // Id de sucursal
            $table->unsignedBigInteger('referrer_id')->nullable(); // Id de referente

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('branch_offices_id')->references('id')->on('branch__offices');
            $table->foreign('referrer_id')->references('id')->on('old_policy_referrers');
            
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
        Schema::dropIfExists('old_policies');
    }
};
