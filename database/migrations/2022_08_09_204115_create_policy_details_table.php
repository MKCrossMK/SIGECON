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
        Schema::create('policy_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('policy_id');
            $table->string('image');
            $table->string('description');
            $table->string('carat');
            $table->string('stone_type');
            $table->float('weight');
            $table->float('valued_price');
            $table->float('loan_price');

            $table->foreign('policy_id')->references('id')->on('policies');
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
        Schema::dropIfExists('policy_details');
    }
};
