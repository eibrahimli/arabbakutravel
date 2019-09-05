<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('turBas', 500);
            $table->integer('turKat');
            $table->integer('turQiy');
            $table->text('turAciq');
            $table->text('turCedvel');
            $table->string('turP');
            $table->string('turSingleP');
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
        Schema::dropIfExists('turs');
    }
}
