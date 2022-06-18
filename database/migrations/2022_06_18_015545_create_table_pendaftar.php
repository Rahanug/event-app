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
        Schema::create('pendaftar', function (Blueprint $table) {
            $table->increments('id_pendaftar');
            $table->string('nama_pendaftar');
            $table->string('email_pendaftar');
            $table->date('tanggal_lahir');
            $table->integer('id_event')->unsigned();
            $table->foreign('id_event')->references('id_event')->on('events');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_pendaftar');
    }
};
