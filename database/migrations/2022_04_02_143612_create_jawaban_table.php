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
        Schema::create('jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_id')->constrained('jadwal')->nullable();
            $table->foreignId('paket_id')->constrained('paket')->nullable();
            $table->foreignId('murid_id')->constrained('murid')->nullable();
            $table->foreignId('soal_id')->constrained('soal')->nullable();
            $table->text('jawaban')->nullable();
            $table->string('ragu')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jawaban');
    }
};
