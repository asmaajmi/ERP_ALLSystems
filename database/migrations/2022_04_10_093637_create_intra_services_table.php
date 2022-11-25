<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntraServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intra_services', function (Blueprint $table) {
            $table->id();
            $table->date('dte_deb_ex_ser');
            $table->date('dte_fin_ex_ser');
            $table->time('hr_deb_ex_ser');
            $table->time('hr_fin_ex_ser');
            $table->float('prime_sup');
            $table->unsignedBigInteger('id_serv');
            $table->foreign('id_serv')->references('id')->on('services')->onUpdate('cascade');
            $table->unsignedBigInteger('id_emp_op');
            $table->foreign('id_emp_op')->references('id')->on('employes')->onDelete('cascade');
            $table->unsignedBigInteger('id_emp_sup');   
            $table->foreign('id_emp_sup')->references('id')->on('employes');
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
        Schema::dropIfExists('intra_services');
    }
}
