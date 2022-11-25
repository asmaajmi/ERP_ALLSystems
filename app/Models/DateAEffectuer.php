<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateAEffectuer extends BaseModel
{
    use HasFactory;
    protected $table='date_a_effectuers';

    protected $fillable = [
        'id',
        'dt_a_eff',
        'num_j',
        'des_j',
        'mois',
        'annee',
        'id_pointaeff'];

        public function pointage()
        {
            return $this->belongsTo(PointageAEffectuer::class);
    
        }
}
