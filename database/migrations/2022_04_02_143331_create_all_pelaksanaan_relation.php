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
        if(Schema::hasTable('pelaksanaan'))
        {
            Schema::table('pelaksanaan', function(Blueprint $table) {
                $table->foreign('sesi_id')->references('id')->on('sesi');
                $table->foreign('murid_id')->references('id')->on('murid');
                $table->foreign('ruangan_id')->references('id')->on('ruangan');
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
        Schema::dropIfExists('all_pelaksanaan_relation');
    }
};
