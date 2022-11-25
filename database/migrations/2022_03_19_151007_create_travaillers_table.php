<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravaillersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   Schema::create('travaillers', function (Blueprint $table) {
        $table->date('date_debut_tr');
        $table->date('date_fin_tr')->nullable();
        $table->unsignedBigInteger('id_emp');
        $table->unsignedBigInteger('id_serv');
        $table->foreign('id_emp')->references('id')->on('employes')->onDelete('cascade');
        $table->foreign('id_serv')->references('id')->on('services');
        $table->timestamps(); });
        DB::unprepared('ALTER TABLE travaillers  ADD PRIMARY KEY (  date_debut_tr,id_serv , id_emp )');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
