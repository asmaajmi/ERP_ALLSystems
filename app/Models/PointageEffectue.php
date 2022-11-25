<?php

namespace App\Models;

use App\Models\Employe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PointageEffectue extends BaseModel
{
   protected $table = "pointage_effectues";
   protected $fillable = [
       'id',
       'datepe',
       'heure_entree',
       'heure_sortie',
       'num_j',
       'mois',
       'annee',
       'id_emp',
       'des_j'
   ];

   public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_emp');

    }
}
