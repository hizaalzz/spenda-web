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
        Schema::create('bank_soal', function (Blueprint $table) {
            $table->id();
            $table->enum('opsi_pg', [1, 2, 3, 4, 5])->nullable();
            $table->string('tahun')->nullable();
            $table->foreignId('level_id')->constrained('levels');
            $table->foreignId('jurusan_id')->constrained('jurusan');
            $table->foreignId('matapelajaran_id')->constrained('matapelajaran');
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->enum('status', ['Aktif', 'Nonaktif']);
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
        Schema::dropIfExists('bank_soal');
    }
};
