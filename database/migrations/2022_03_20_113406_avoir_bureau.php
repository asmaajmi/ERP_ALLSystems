<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AvoirBureau extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avoir_bureau', function (Blueprint $table) {
            $table->unsignedBigInteger('id_serv');
            $table->unsignedBigInteger('id_bureau');
            $table->foreign('id_serv')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('id_bureau')->references('id')->on('bureaus')->onDelete('cascade');
            $table->timestamps();
        });
        DB::unprepared('ALTER TABLE avoir_bureau  ADD PRIMARY KEY (  id_serv ,  id_bureau )');
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
