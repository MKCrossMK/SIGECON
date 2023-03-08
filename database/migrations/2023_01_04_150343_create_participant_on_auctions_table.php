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
        Schema::create('participant_on_auctions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auction_participant_id');
            $table->string('number_paddle');
            $table->unsignedBigInteger('auction_id');
            
            $table->foreign('auction_participant_id')->references('id')->on('auction_participants'); // Hacemos relacion con la table de auction_participants y esta hace relacion con la table de participantes
            $table->foreign('auction_id')->references('id')->on('auctions');
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
        Schema::dropIfExists('participant_on_auctions');
    }
};
