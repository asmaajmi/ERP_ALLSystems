<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use phpDocumentor\Reflection\Types\Float_;
use Illuminate\Database\Migrations\Migration;

class CreatePrimeMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prime__missions', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mission');
            $table->unsignedBigInteger('id_inter_serv');
            $table->float('prime')->nullable();
            $table->foreign('id_mission')->references('id')->on('missions')->onDelete('cascade');
            $table->foreign('id_inter_serv')->references('id')->on('inter__services')->onDelete('cascade');
            $table->timestamps();
        });
        DB::unprepared('ALTER TABLE prime__missions  ADD PRIMARY KEY (  id_mission ,  id_inter_serv )');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prime__missions');
    }
}
