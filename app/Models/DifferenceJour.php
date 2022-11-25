<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DifferenceJour extends BaseModel
{
    use HasFactory;
    protected $table = 'difference_jours';
    protected $fillable = [
        'id',
        'nbj_lundi',
        'diffhr_lundi',
        'diffmin_lundi',

        'nbj_mardi',
        'diffhr_mardi',
        'diffmin_mardi',

        'nbj_mercredi',
        'diffhr_mercredi',
        'diffmin_mercredi',

        'nbj_jeudi',
        'diffhr_jeudi',
        'diffmin_jeudi',

        'nbj_vendredi',
        'diffhr_vendredi',
        'diffmin_vendredi',

        'nbj_samedi',
        'diffhr_samedi',
        'diffmin_samedi',

        'nbj_dimanche',     
        'diffhr_dimanche',
        'diffmin_dimanche',
        
        'id_pointaeff'];

        public function pointage()
        {
            return $this->belongsTo(PointageAEffectuer::class);
    
        }
}
