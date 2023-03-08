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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('cedula', 14)->unique();
            $table->string('name', 50);
            $table->string('lastname', 50);
            $table->char('sex', 1)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->string('address')->nullable();
            $table->string('phone');
            $table->string('cellphone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('work_activity')->nullable();
            $table->double('salary')->nullable();
            $table->integer('dependents')->nullable();
            $table->string('password')->nullable();
            $table->string('description')->nullable();
            $table->boolean('account_status')->default(0);


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
        Schema::dropIfExists('clients');
    }
};
