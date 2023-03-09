<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->bigIncrements('id_transaksi', 11);
            $table->timestamp('tgl_transaksi');
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_meja')->unsigned();
            $table->string('nama_pelanggan', 100);
            $table->enum('status', ['belum_bayar', 'lunas']);

            $table->foreign('id_user')->references('id_user')->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('id_meja')->references('id_meja')->on('mejas')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
