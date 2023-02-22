<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebsiteStyleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('website_style', function (Blueprint $table) {
            $table->id();
            $table->string('main_banner')->nullable();
            $table->string('color_1')->nullable();
            $table->string('color_1_active')->nullable();
            $table->string('color_2')->nullable();
            $table->string('color_2_active')->nullable();
            $table->string('black')->nullable();
            $table->string('white')->nullable();
            $table->string('background_color')->nullable();
            $table->string('font_style')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('website_style');
    }
}
