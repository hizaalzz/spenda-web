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
        if(Schema::hasTable('bank_soal') && Schema::hasTable('jadwal'))
        {
            Schema::table('jadwal', function(Blueprint $table) {
                $table->foreignId('bank_soal_id')->nullable()->constrained('bank_soal')->onDelete('set null');
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
        Schema::dropIfExists('bank_soal_id_relation_on_jadwal');
    }
};
