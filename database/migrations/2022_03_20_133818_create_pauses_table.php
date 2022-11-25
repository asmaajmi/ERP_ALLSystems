<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePausesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pauses', function (Blueprint $table) {
            $table->id();
            $table->string('designation_pause',30);
            $table->time('heure_deb_pause');
            $table->time('heure_fin_pause');
            $table->unsignedBigInteger('num_seq_j');
            $table->foreign('num_seq_j')->references('id')->on('jour_a_effectuers')->onDelete('cascade');
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
        Schema::dropIfExists('pauses');
    }
}
