<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestCapabilitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_capabilites', function (Blueprint $table) {
            $table->id();
            $table->float('CapabiliteMesure');
            $table->boolean('Validation');
            $table->string('DesTypeOutil');
            $table->string('DesParametreMesure');
            $table->string('DesPrecision');
            $table->string('IDBonValidation');
            $table->foreign('IDBonValidation')->references('IDBV')->on('bon_de_validations')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(array('DesTypeOutil', 'DesParametreMesure','DesPrecision'))->references(array('DesTypeOutil', 'DesParametreMesure','DesPrecision'))->on('avoir_parametre_mesure');
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
        Schema::table("test_capabilites",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDBonValidation");
             $table->dropConstrainedForeignId(array('DesTypeOutil', 'DesParametreMesure','DesPrecision'));
        });
        Schema::dropIfExists('test_capabilites');
    }
}
