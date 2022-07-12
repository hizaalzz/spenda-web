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
        if(Schema::hasTable('jadwal') && Schema::hasTable('jenis_ujian'))
        {
            Schema::table('jadwal', function(Blueprint $table) {
                $table->foreignId('jenisujian_id')->nullable()->constrained('jenis_ujian')->onDelete('set null');
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
        Schema::dropIfExists('jenisujian_id_relation_on_jadwal');
    }
};
