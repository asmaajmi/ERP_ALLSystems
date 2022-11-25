<?php

namespace App\Models;
use App\Models\Produit;
use App\Models\Nomenclature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProduitAchetable extends Model
{
    use HasFactory;
    protected $fillable = ['DesProduit','DesProduitA','nom_produit','type_prod'
];
    public function produit()
    {
        return $this->belongsTo(Produit::class,'DesProduit','DesProduit');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
    public function Nomenclatures()
    {
        return $this->belongsToMany(Nomenclature::class,'constituer_pars','id_nomenclature','id_prodachetable')->withPivot('quantite','unite','arrondi');
    }
}
