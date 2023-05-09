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
        Schema::create('culture_dispositif', function (Blueprint $table) {
            $table->unsignedBigInteger('culture_id');
            $table->unsignedBigInteger('dispositif_id');
            $table->foreign('culture_id')->references('id')->on('cultures')->onDelete('cascade');
            $table->foreign('dispositif_id')->references('id')->on('dispositifs')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispositif_culture');
    }
};
