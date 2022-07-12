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
            Schema::table('murid', function(Blueprint $table) {
                $table->bigInteger('kelas_id', false)->unsigned()->nullable();

                $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
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
        Schema::dropIfExists('kelas_id_relations');
    }
};
