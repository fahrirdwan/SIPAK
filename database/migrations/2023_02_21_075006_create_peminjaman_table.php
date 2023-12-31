<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->increments('id_peminjaman');
            $table->unsignedInteger('nip');
            $table->string('serial_number', 128)->index();
            $table->string('no_antrian', 25);
            $table->string('durasi_peminjaman');
            $table->string('status_peminjaman');
            $table->boolean('confirmed');
            $table->tinyInteger('softDelete')->nullable();
            $table->string('created_at', 25)->nullable();
            $table->string('updated_at', 25)->nullable();

            // Foreign Key = users.id_user, barang.serial_number
            $table->foreign('nip')->references('nip')->on('users')->onDelete('cascade');
            $table->foreign('serial_number')->references('serial_number')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('peminjaman');
    }
}
