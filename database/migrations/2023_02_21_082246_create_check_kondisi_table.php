<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckKondisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_kondisi', function (Blueprint $table) {
            $table->increments('id_check_kondisi');
            $table->unsignedInteger('nip');
            $table->unsignedInteger('id_barang');
            $table->string('no_antrian', 25);
            $table->string('kondisi_barang');
            $table->tinyInteger('softDelete')->nullable();
            $table->string('created_at', 25)->nullable();
            $table->string('updated_at', 25)->nullable();

            // Foreign Key = users.id_user, barang.id_user
            $table->foreign('nip')->references('nip')->on('users')->onDelete('cascade');
            $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('check_kondisi');
    }
}
