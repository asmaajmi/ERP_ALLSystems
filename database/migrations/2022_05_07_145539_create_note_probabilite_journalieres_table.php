<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteProbabiliteJournalieresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_probabilite_journalieres', function (Blueprint $table) {
            $table->id();
            $table->year('annee');
            $table->integer('mois');
            $table->string('jour');
            $table->integer('c1');
            $table->integer('c2');
            $table->integer('c3');
            $table->integer('numj');
            $table->float('note');
            $table->string('mention');
            $table->unsignedBigInteger('id_emp');
            $table->foreign('id_emp')->references('id')->on('employes')->onDelete('cascade');
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
        Schema::dropIfExists('note_probabilite_journalieres');
    }
}
