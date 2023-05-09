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
        Schema::create('culture_etape', function (Blueprint $table) {
            $table->unsignedBigInteger('culture_id');
            $table->unsignedBigInteger('etape_id');
            $table->foreign('culture_id')->references('id')->on('cultures')->onDelete('cascade');
            $table->foreign('etape_id')->references('id')->on('etapes')->onDelete('cascade');
            $table->primary(['culture_id', 'etape_id']);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etape_culture');
    }
};
