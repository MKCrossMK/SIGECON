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
        Schema::create('branch__offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sub_name');
            $table->string('phone');
            $table->string('phone_ext', 5)->nullable();
            $table->string('address');
            $table->string('province');
            $table->float('case_back')->nullable();
            $table->double('availability')->nullable();
            // $table->integer('user_id');
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
        Schema::dropIfExists('branch__offices');
    }
};
