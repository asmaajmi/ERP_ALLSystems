<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJourAEffectuersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jour_a_effectuers', function (Blueprint $table) {
            $table->id();
            $table->string('designation_j',30);
            $table->time('heure_entree_j')->nullable();
            $table->time('heure_sortie_j')->nullable();
            $table->unsignedBigInteger('num_seq_pa');
            $table->foreign('num_seq_pa')->references('id')->on('pointage_a_effectuers')->onDelete('cascade');
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
        Schema::dropIfExists('jour_a_effectuers');
    }
}
