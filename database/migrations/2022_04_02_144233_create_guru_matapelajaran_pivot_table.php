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
        Schema::create('guru_matapelajaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->foreignId('matapelajaran_id')->constrained('matapelajaran')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guru_matapelajaran_pivot');
    }
};
