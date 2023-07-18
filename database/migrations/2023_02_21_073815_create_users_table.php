<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id');
            $table->unsignedInteger('nip')->primary();
            $table->string('name', 128);
            $table->string('email', 128);
            $table->string('password', 128);
            $table->string('picture', 128);
            $table->string('tgl_lahir', 40)->nullable();
            $table->string('jabatan', 50)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->unsignedInteger('id_role');
            $table->rememberToken();
            $table->timestamps();

            // Foreign Key = users.id_user
            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
