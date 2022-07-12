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
        if (Schema::hasTable('kelas')) {
            Schema::table('kelas', function(Blueprint $table) {
                $table->bigInteger('jurusan_id', false)->unsigned();

                $table->foreign('jurusan_id')->references('id')->on('jurusan');
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
        Schema::dropIfExists('jurusan_id_relations');
    }
};
