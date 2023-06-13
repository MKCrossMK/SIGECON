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
        Schema::create('cash_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_id');
            $table->float('balance', 12, 2);

            $table->string('reason');  // Razon por la que se hace el registro, en la clase modelo <CashHistory.php> estaran estos estados
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
        Schema::dropIfExists('cash_histories');
    }
};
