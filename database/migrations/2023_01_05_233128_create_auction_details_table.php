<?php

use App\Models\AuctionDetail;
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
        Schema::create('auction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('auction_id');
            $table->string('policy_id');
            $table->string('policie_class_name');
            $table->unsignedBigInteger('user_creator_id');
            $table->float('first_bid_price')->nullable();
            $table->float('auctioned_price')->nullable();
            $table->string('status')->default(AuctionDetail::STATUS_TO_AUCTION);
            
            $table->bigInteger('participant_on_auctions_id')->nullable()->unsigned();
            $table->index('participant_on_auctions_id')->nullable();
            $table->integer('bid_qty')->default(0);  // cantidad de pujas

                // Detalle Subasta(id, id_subasta, id_poliza, poliza_class_name ) 

            $table->foreign('auction_id')->references('id')->on('auctions');
            $table->foreign('participant_on_auctions_id')->references('id')->on('participant_on_auctions'); // comprador
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
        Schema::dropIfExists('auction_details');
    }
};
