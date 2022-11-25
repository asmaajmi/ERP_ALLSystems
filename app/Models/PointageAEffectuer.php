<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointageAEffectuer extends BaseModel
{   protected $table = 'pointage_a_effectuers';
    protected $fillable = [
        'id',
        'designation_periode',
        'date_debut_periode',
        'date_fin_periode',
        'annee',
        'mois',
        'id_emp'
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class);

    }

    public function jour()
    {
        return $this->hasMany(JourAEffectuer::class,'num_seq_pa','id');
    }

    public function dateAEff()
    {
        return $this->hasMany(DateAEffectuer::class,'id_pointaeff','id');
    }

    public function diffjrs()
    {
        return $this->hasMany(DifferenceJour::class,'id_pointaeff','id');
    }

}
