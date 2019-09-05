<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteAyarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_ayars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('menuP', 500);
            $table->string('videoP', 500);
            $table->string('videoUrl', 500);
            $table->string('videoTitle', 500);
            $table->string('videoSubTitle', 500);
            $table->string('gsP', 500);
            $table->string('tursP', 500);
            $table->string('otelsP', 500);
            $table->string('transfersP', 500);
            $table->string('restoransP', 500);
            $table->string('contactP', 500);
            $table->string('aboutP', 500);
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
        Schema::dropIfExists('site_ayars');
    }
}
