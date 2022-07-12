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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('nuptk')->nullable()->unique();
            $table->string('email')->unique();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir', 120)->nullable();
            $table->date('tanggal_lahir');
            $table->string('telp')->nullable();
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
        Schema::dropIfExists('guru');
    }
};
