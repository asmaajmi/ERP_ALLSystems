<?php

namespace App\Models;
use App\Models\Machine;
use App\Models\Produit;
use App\Models\Nomenclature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProduitConstruisable extends Model
{
    use HasFactory;
    protected $fillable = ['DesProduit','DesProduitC','nom_produit_const',
    'code_barre',
    'lot_optimal',
    'type_produit',
    'Nature_produit',
    'Prix_unit_vente',
    'id_nomenclature',];
    public function produit()
    {
        return $this->belongsTo(Produit::class,'DesProduit','DesProduit');
    }
    public function machines1()
    {
        return $this->belongsToMany(Machine::class,'produits_construisables_machines','IDProduitConstruisable','IDMachine');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
    public function Machines()
    {
        return $this->belongsToMany(Machine::class,'tempsfabrications','id_produit_const','id_machine')->withPivot('temps_unitaire','temps_reglage_lot');
    }

    public function Nomenclatures()
    {
        return $this->belongsToMany(Nomenclature::class,'constituer_pars','id_nomenclature','id_prodconstruisable')->withPivot('quantite','unite','arrondi');
    }
}
