<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nomenclature extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'id',
        'designation',
        ];

    public function Produits_construisables()
    {
        return $this->belongsToMany(ProduitConstruisable::class,'constituer_pars','id_nomenclature','id_prodconstruisable')->withPivot('quantite','unite','arrondi');
    }
    public function Produits_achetables()
    {
        return $this->belongsToMany(ProduitAchetable::class,'constituer_pars','id_nomenclature','id_prodachetable')->withPivot('quantite','unite','arrondi');
    }
}
