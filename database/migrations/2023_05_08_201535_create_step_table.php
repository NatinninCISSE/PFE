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
        Schema::create('steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('poisson_id');
            $table->string('nom_etape');
            $table->text('description_etape');
            $table->date('date_debut_etape');
            $table->date('date_fin_etape');
            $table->string('image_step');
            $table->unsignedInteger('duree_etape')->nullable();
            $table->foreign('poisson_id')->references('id')->on('poissons')->onDelete('cascade');
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
