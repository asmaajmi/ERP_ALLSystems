<?php

namespace App\Models;

use App\Models\Mesure;

use App\Models\operateur;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarteMesureMoyenneEtendue;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ColonneMesure extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'Moyenne',
        'Etendue',
        'IDCM_ME',
        'date',
        'heure',
        'Xdbar',
        'Rbar',
        'operateur',
        'lot'

    ];
    public function CarteMesureME()
    {
        return $this->belongsTo(CarteMesureMoyenneEtendue::class, 'IDCM_ME');
    }
    public function Mesures()
    {
        return $this->hasMany(Mesure::class,'IDCM');
    }
 
    public function operateur()
    {
        return $this->belongsTo(operateur::class,'operateur');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
