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
        Schema::create('jurusan_matapelajaran', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('matapelajaran_id', false)->unsigned();
            $table->bigInteger('jurusan_id', false)->unsigned();
            $table->timestamps();

            $table->foreign('matapelajaran_id')->references('id')->on('matapelajaran')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jurusan_id')->references('id')->on('jurusan')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jurusan_matapelajaran_pivot');
    }
};
