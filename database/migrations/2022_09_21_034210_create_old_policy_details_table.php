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
        Schema::create('old_policy_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('old_policy_id');
            $table->string('image')->nullable();
            $table->string('description');
            $table->string('carat');
            $table->string('stone_type');
            $table->float('weight');
            $table->float('valued_price');
            $table->float('loan_price');

            $table->foreign('old_policy_id')->references('id')->on('old_policies')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('old_policy_details');
    }
};
