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
        Schema::create('soal', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_soal');
            $table->longText('isi');
            $table->text('pilA')->nullable();
            $table->text('pilB')->nullable();
            $table->text('pilC')->nullable();
            $table->text('pilD')->nullable();
            $table->text('pilE')->nullable();
            $table->string('kunci_jawaban')->nullable();
            $table->string('jenis');
            $table->foreignId('paket_id')->constrained('paket')->nullable();
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
        Schema::dropIfExists('soal');
    }
};
