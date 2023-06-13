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
    
        // Colocar validacion de pago si es mayor a la cantidad definida por el cajero

        // Interes restante se debe guardar en un campo de la tabla pagos, restar el capital pagado al capital poliza

        // Interes restante se pondrá en el campo de la poliza y posteriormente se sumará el valor que contiene cuando el  cronjob haga update a la poliza

        Schema::create('policy_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('policy_id'); // Id poliza
            $table->unsignedBigInteger('user_id');  // Id Usuario
            $table->unsignedBigInteger('branch_offices_id');  // Id de sucursal

           
            $table->float('interest_rate_paid'); 
            $table->float('interest_rate_paid_residuary');
            $table->float('contract_rate_paid'); 
            $table->float('contract_rate_paid_residuary'); 
            $table->float('capital_paid'); 
            $table->float('capital_paid_residuary'); 
            $table->float('amount'); 
            $table->date('date_paid'); 

        

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('policy_id')->references('id')->on('policies');
            $table->foreign('branch_offices_id')->references('id')->on('branch__offices');

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
        Schema::dropIfExists('policy_payments');
    }
};
