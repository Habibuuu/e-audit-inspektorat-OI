<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaduan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id();
            $table->text('perihal');
            $table->string('pengirim');
            $table->date('tgl_pengaduan');
            $table->string('no_pengaduan');
            $table->text('alamat');
            $table->json('penerima');
            $table->string('isi');
            $table->json('scanfile');
            $table->json('lampiran');
            $table->string('catatan');
            $table->softDeletes();
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
        Schema::dropIfExists('pengaduan');
    }
}
