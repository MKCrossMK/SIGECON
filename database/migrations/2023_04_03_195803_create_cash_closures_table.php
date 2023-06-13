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
        Schema::create('cash_closures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_id');
            $table->float('initial_amount', 12, 2); // Este es el valor que inicia el dia la caja, esto se actualizará en cada corte decido por la gestion de las sucursales
            $table->float('income', 12, 2);
            $table->float('expense', 12, 2);
            
            $table->foreign('cash_id')->references('id')->on('cashes');
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
        Schema::dropIfExists('cash_closures');
    }
};
