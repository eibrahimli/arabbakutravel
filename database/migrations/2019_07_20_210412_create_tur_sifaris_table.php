<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurSifarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tur_sifaris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tur_id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('customer');
            $table->integer('price');
            $table->string('email');
            $table->string('phone');
            $table->integer('status');
            $table->integer('adults');
            $table->integer('child');
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
        Schema::dropIfExists('tur_sifaris');
    }
}
