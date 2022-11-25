<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourAEffectuer extends BaseModel
{
    protected $table = 'jour_a_effectuers';
    protected $fillable = [
        'id',
        'designation_j',
        'heure_entree_j',
        'heure_sortie_j',
        'num_seq_pa'
    ];
    public function pointage()
    {
        return $this->belongsTo(PointageAEffectuer::class);

    }

    public function pause()
    {
        return $this->hasMany(Pause::class,'num_seq_j','id');
    }
}
