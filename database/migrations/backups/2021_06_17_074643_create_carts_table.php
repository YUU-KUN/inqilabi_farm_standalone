<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('packages_id');
            $table->unsignedBigInteger('user_id');
            $table->string('nama');
            $table->string('jumlah');
            $table->integer('total');
            $table->enum('penyaluran', ['inqilabi_farm', 'dikirim']);
            $table->string('nama_penerima')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('tempat_penerima')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->timestamps();

            $table->foreign('packages_id')->references('id')->on('packages');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
