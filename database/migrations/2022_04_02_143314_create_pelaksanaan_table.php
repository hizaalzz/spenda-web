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
        Schema::create('pelaksanaan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sesi_id', false)->unsigned();
            $table->bigInteger('murid_id', false)->unsigned();
            $table->bigInteger('ruangan_id', false)->unsigned();
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
        Schema::dropIfExists('pelaksanaan');
    }
};
