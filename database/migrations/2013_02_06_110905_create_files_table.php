<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('type')->onDelete('cascade');
            $table->integer('size')->onDelete('cascade');
            //change name of this column to refer_to id of user or ^post references to 
            $table->integer('name')->onDelete('cascade');
            //$table->integer('refer_type')->onDelete('cascade');//type of reference post|user

            $table->string('file')->onDelete('cascade');
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
        Schema::dropIfExists('files');
    }
};