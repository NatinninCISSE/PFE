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
        Schema::create('etapes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('culture_id');
            $table->string('nom_etape');
            $table->text('description_etape');
            $table->date('date_debut_etape');
            $table->date('date_fin_etape');
            $table->string('image_etape');
            $table->unsignedInteger('duree_etape')->nullable();
            $table->foreign('culture_id')->references('id')->on('cultures')->onDelete('cascade');
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
        Schema::dropIfExists('taches');
    }
};
