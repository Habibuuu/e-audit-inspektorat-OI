<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->dateTime('datetime')->useCurrent();
            $table->date('date');
            $table->ipAddress('ip_address');
            $table->text('url')->nullable();
            $table->text('referal')->nullable();
            $table->enum('tipe',['Public','Admin']);
            $table->string('visit');
            $table->string('country');
            $table->string('country_code');
            $table->string('browser');
            $table->string('device');
            $table->string('os');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
}
