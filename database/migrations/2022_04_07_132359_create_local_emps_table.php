<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalEmpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_emps', function (Blueprint $table) {
            $table->date('date_emp');
            $table->string('des_emp_fk');
            $table->unsignedBigInteger('id_emplacement');
            $table->string('id_machine');
            $table->float('x_emp');
            $table->float('y_emp');
            $table->float('z_emp');
            $table->foreign('id_emplacement')->references('id')->on('emplacement_machines')->onDelete('cascade');
            $table->foreign('id_machine')->references('DesMachine')->on('machines');
            $table->timestamps();
        });
        DB::unprepared('ALTER TABLE local_emps  ADD PRIMARY KEY (  date_emp ,  id_emplacement , id_machine)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('local_emps');
    }
}
