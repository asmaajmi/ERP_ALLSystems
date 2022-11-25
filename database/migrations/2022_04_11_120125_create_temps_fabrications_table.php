<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempsFabricationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempsfabrications', function (Blueprint $table) {
            $table->string('id_machine');
            $table->string('id_produit_const');
            $table->integer('temps_unitaire');
            $table->integer('temps_reglage_lot');
            $table->foreign('id_machine')->references('DesMachine')->on('machines')->onDelete('cascade');
            $table->foreign('id_produit_const')->references('DesProduitC')->on('produit_construisables')->onDelete('cascade');
            $table->timestamps();
        });

        DB::unprepared('ALTER TABLE tempsfabrications  ADD PRIMARY KEY (  id_machine ,  id_produit_const )');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempsfabrications');
    }
}
