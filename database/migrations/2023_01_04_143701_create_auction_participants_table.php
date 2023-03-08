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
        Schema::create('auction_participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cedula', 14)->unique();
            $table->unsignedBigInteger('user_creator_id');

            $table->foreign('user_creator_id')->references('id')->on('users');
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
        Schema::dropIfExists('auction_participants');
    }
};
