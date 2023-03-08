<?php

use App\Models\Auction;
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
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->date('date_to_celebrate');
            $table->text('note')->nullable();
            $table->integer('places');
            
            $table->float('amount_to_auction')->nullable();
            $table->integer('qty_policies_published')->nullable();
            $table->float('total_auctioned')->nullable();
            $table->float('total_not_auctioned')->nullable();
            $table->integer('qty_policies_auctioned')->nullable();
            
            $table->unsignedBigInteger('branch_office_celebrate_id');
            $table->unsignedBigInteger('user_creator_id');

            $table->boolean('status');
            $table->string('a_status')->default(Auction::STATUS_CREATED);

            $table->foreign('branch_office_celebrate_id')->references('id')->on('branch__offices');
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
        Schema::dropIfExists('auctions');
    }
};
