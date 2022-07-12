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
        Schema::create('konten', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('soal_id', false)->unsigned();
            $table->text('isi')->nullable();
            $table->enum('type', ['image', 'audio']);
            $table->enum('layout', ['top', 'bottom']);
            $table->timestamps();
        });

        if(Schema::hasTable('konten')) {
            Schema::table('konten', function(Blueprint $table) {
                $table->foreign('soal_id')->references('id')->on('soal');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konten');
    }
};
