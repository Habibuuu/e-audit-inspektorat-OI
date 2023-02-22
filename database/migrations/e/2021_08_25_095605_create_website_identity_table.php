<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteIdentityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_identity', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Website Database Ittifaqiyah');
            $table->text('description');
            $table->string('favicon')->default('favicon.png');
            $table->string('logo')->default('logo.png');
            $table->string('email')->default('email@email.com');
            $table->string('address')->default('address');
            $table->text('googlemap');
            $table->string('telephone')->default('08123456789');
            $table->string('facebook')->default('https://www.facebook.com');
            $table->string('instagram')->default('https://www.instagram.com');
            $table->string('youtube')->default('https://www.youtube.com');
            $table->string('twitter')->default('https://www.twitter.com');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_identity');
    }
}
