<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history', function (Blueprint $table) {
            $table->increments('id_history');
            $table->unsignedInteger('nip');
            $table->unsignedInteger('id_barang');
            $table->string('no_antrian', 25);
            $table->string('pesan', 128);
            $table->string('status', 25);
            $table->string('tgl_peminjaman', 25)->nullable();
            $table->string('tgl_pengembalian', 25)->nullable();
            $table->tinyInteger('softDelete')->nullable();
            $table->string('created_at', 25);
            $table->string('updated_at', 25);

            // Foreign Key = users.id_user, barang.id_barang
            $table->foreign('nip')->references('nip')->on('users');
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('history');
    }
}
