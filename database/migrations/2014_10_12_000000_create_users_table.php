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
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone');
            $table->unsignedBigInteger('profile_img')->index()->nullable();
            $table->foreign('profile_img')->references('id')->on('files')->onDelete('cascade');
            $table->unsignedBigInteger('cover_img')->nullable();
            $table->foreign('cover_img')->references('id')->on('files')->onDelete('cascade');
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->unsignedBigInteger('breed_id')->nullable();
            $table->foreign('breed_id')->references('id')->on('animals_breeds')->onDelete('cascade');
            $table->timestamps();
            $table->rememberToken();
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
