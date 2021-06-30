<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pembayaran');
            $table->string('nama')->nullable();
            $table->string('jenis_hewan')->nullable();
            $table->string('berat_hewan')->nullable();
            // $table->string('sertifikat')->nullable();
            $table->string('penyembelih')->nullable();
            $table->date('hari_penyembelihan')->nullable();
            $table->string('pukul_penyembelihan')->nullable();
            $table->string('lokasi_pembagian')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->date('hari_pembagian')->nullable();
            $table->string('supir')->nullable();
            $table->string('no_supir')->nullable();
            $table->date('mobil_pengirim')->nullable();
            $table->string('penerima')->nullable();
            $table->string('hari_diterima')->nullable();
            $table->date('pukul_diterima')->nullable();
            $table->string('foto')->nullable();
            $table->enum('proses', ['foto_hewan', 'penyembelihan', 'pembagian', 'pengiriman', 'sampai']);
            $table->enum('isReported', [0, 1])->default(0);
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
        Schema::dropIfExists('reports');
    }
}
