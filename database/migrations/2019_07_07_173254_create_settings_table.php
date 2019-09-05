<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('siteTitle', 256);
            $table->string('siteDesc', 256);
            $table->string('siteNum');
            $table->string('siteKey', 256);
            $table->string('siteMail', 256);
            $table->string('siteSocial', 1000);
            $table->string('siteAdress', 500);
            $table->string('siteFooterCopy', 256);
            $table->string('siteLogo', 256);
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
        Schema::dropIfExists('settings');
    }
}
