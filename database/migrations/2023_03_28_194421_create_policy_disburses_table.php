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
        Schema::create('policy_disburses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('policy_id')->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cash_id');
            $table->float('amount', 12, 2);

            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('policy_id')->references('id')->on('policies');
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
        Schema::dropIfExists('policy_disburses');
    }
};
