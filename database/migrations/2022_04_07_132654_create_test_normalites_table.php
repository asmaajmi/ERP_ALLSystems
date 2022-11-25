<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestNormalitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_normalites', function (Blueprint $table) {
            $table->id();
            $table->float('NormaliteMesure');
            $table->boolean('Validation');
            $table->string('IDBonValidation');
            $table->foreign('IDBonValidation')->references('IDBV')->on('bon_de_validations')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::table("test_normalites",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDBonValidation");
        });
        Schema::dropIfExists('test_normalites');
    }
}
