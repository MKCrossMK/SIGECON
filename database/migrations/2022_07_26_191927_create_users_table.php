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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('user')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('rol_id');
            $table->unsignedBigInteger('branch_office_id');
            $table->string('unique_code')->nullable();
            $table->boolean('logged')->nullable();
            $table->dateTime('last_access')->nullable();
            $table->boolean('status')->nullable()->default(0);

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('rol_id')->references('id')->on('roles');
            $table->foreign('branch_office_id')->references('id')->on('branch__offices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
