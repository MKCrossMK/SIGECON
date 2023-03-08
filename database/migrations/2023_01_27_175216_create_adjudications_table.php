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
        Schema::create('adjudications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auction_detail_id');
            $table->date('date_created')->default(date('Y-m-d'));

            $table->foreign('auction_detail_id')->references('id')->on('auction_details');
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
        Schema::dropIfExists('adjudications');
    }
};
