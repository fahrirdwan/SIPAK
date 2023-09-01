<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalian', function (Blueprint $table) {
            $table->increments('id_pengembalian');
            $table->unsignedInteger('nip');
            $table->string('serial_number', 128)->index();
            $table->string('no_antrian', 25);
            $table->string('status_pengembalian');
            $table->boolean('confirmed');
            $table->tinyInteger('softDelete')->nullable();
            $table->string('created_at', 25)->nullable();
            $table->string('updated_at', 25)->nullable();

            // Foreign Key = users.id_user, barang.id_barang
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
        Schema::dropIfExists('pengembalian');
    }
}
