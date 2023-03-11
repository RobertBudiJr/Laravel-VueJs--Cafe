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
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->bigIncrements('id_detail_transaksi', 11);
            $table->bigInteger('id_transaksi')->unsigned();
            $table->bigInteger('id_menu')->unsigned();
            $table->bigInteger('jumlah');
            $table->bigInteger('total_harga');

            $table->foreign('id_transaksi')->references('id_transaksi')->on('transaksis')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreign('id_menu')->references('id_menu')->on('menus')
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
        Schema::dropIfExists('detail_transaksi');
    }
};
