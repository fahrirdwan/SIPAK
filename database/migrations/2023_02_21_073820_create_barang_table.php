<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->string('serial_number', 128)->index();
            $table->string('nomor_model', 50);
            $table->string('nama_barang', 255);
            $table->unsignedInteger('id_jenis_barang');
            $table->string('gambar', 128);
            $table->text('detail');
            $table->boolean('status_barang');
            $table->timestamps();

            // Foreign Key = jenis_barang.id_jenis_barang
            $table->foreign('id_jenis_barang')->references('id_jenis_barang')->on('jenis_barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
