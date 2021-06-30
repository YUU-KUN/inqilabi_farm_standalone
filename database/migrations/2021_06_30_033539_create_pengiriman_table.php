<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pembayaran');
            $table->string('nama_penerima');
            $table->string('no_wa');
            $table->string('tempat_penerima');
            $table->string('alamat');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi')  ;
            $table->timestamps();

            $table->foreign('id_pembayaran')->references('id')->on('pembayarans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengirimans');
    }
}
