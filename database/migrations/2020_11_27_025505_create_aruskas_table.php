<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAruskasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aruskas', function (Blueprint $table) {
            $table->bigIncrements('id');
                        
            $table->unsignedBigInteger('jurnal_id');
            $table->foreign('jurnal_id')->references('id')->on('jurnal');
            
            $table->string('kode')->unique();
            $table->date('tanggal');
            $table->string('keterangan');
            $table->integer('status'); // 1. Debet 2. Kredit
            $table->integer('jenis_transaksi'); //1. Tunai 2.Non Tunai
            $table->integer('nominal');

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
        Schema::dropIfExists('aruskas');
    }
}
