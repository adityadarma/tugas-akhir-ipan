<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('pelanggan_id');
            $table->foreign('pelanggan_id')->references('id')->on('pelanggan');

            $table->unsignedBigInteger('barang_id');
            $table->foreign('barang_id')->references('id')->on('barang');

            $table->string('kode')->unique();
            $table->date('tgl_pesanan');
            $table->date('tgl_jadi');
            $table->string('ukuran');
            $table->integer('harga_barang');
            $table->integer('jumlah_pesanan');
            $table->integer('jumlah_warna');
            $table->integer('disc')->default(0);
            $table->integer('total_harga');
            $table->integer('uang_muka');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('pesanan');
    }
}
