<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsConstruisablesMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits_construisables_machines', function (Blueprint $table) {
       
            $table->string('IDProduitConstruisable');
            $table->string('IDMachine');
            $table->timestamps();
            $table->foreign('IDProduitConstruisable')->references('DesProduitC')->on('produit_construisables')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('IDMachine')->references('DesMachine')->on('machines')->onUpdate('cascade')->onDelete('cascade');
            $table->primary(array('IDProduitConstruisable', 'IDMachine'));
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("produits_construisables_machines",function(Blueprint $table)
        {
             $table->dropConstrainedForeignId("IDProduitConstruisable");
             $table->dropConstrainedForeignId("IDMachine");
  
        });
        Schema::dropIfExists('produits_construisables_machines');
    }
}
