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
        Schema::create('conseil_culture', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conseil_id');
            $table->unsignedBigInteger('culture_id');
            $table->timestamps();
        
            $table->foreign('conseil_id')->references('id')->on('conseils')->onDelete('cascade');
            $table->foreign('culture_id')->references('id')->on('cultures')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conseil_culture');
    }
};
