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
        Schema::create('tache_culture', function (Blueprint $table) {
            
            $table->unsignedBigInteger('culture_id');
            $table->unsignedBigInteger('tache_id');
            $table->foreign('culture_id')->references('id')->on('cultures')->onDelete('cascade');
            $table->foreign('tache_id')->references('id')->on('taches')->onDelete('cascade');
            

            // $table->primary(['culture_id', 'tache_id']);
            $table->id();
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
        Schema::dropIfExists('tache_culture');
    }
};
