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
        if(Schema::hasTable('admins') && Schema::hasTable('guru'))
        {
            Schema::table('admins', function(Blueprint $table){
                $table->bigInteger('guru_id', false)->unsigned();

                $table->foreign('guru_id')->references('id')->on('guru');
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
        Schema::dropIfExists('guru_id_relations');
    }
};
