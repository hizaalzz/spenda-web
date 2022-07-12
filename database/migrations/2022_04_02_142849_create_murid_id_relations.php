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
        if(Schema::hasTable('users')) 
        {
            Schema::table('users', function(Blueprint $table) {
                $table->bigInteger('murid_id', false)->unsigned();

                $table->foreign('murid_id')->references('id')->on('murid');
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
        Schema::dropIfExists('murid_id_relations');
    }
};
