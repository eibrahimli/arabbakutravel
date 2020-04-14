<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDreamtoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dreamtours', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('city');            
            $table->text('desc');
            $table->text('schedule');
            $table->string('price');
            $table->enum('status',['0','1']);            
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
        Schema::dropIfExists('dreamtours');
    }
}
