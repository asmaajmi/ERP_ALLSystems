<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutilFabrication extends BaseModel
{
    protected $table = 'outil_fabrications';
    protected $fillable = [
        'id',
        'nom'
    ];

    function machine(){
        return $this->belongsToMany(Machine::class,'consommers','ref_outil','id_machine')
        ->withPivot('quantiteoutil','uniteoutil', 'quantiteproduit','uniteproduit');
       }

    function produit(){
        return $this->belongsToMany(ProduitConstruisable::class,'consommers','ref_outil','id_produit')
        ->withPivot('quantiteoutil','uniteoutil', 'quantiteproduit','uniteproduit');
       }
}