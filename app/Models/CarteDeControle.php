<?php

namespace App\Models;

use App\Models\CarteP;
use App\Models\CarteU;
use App\Models\OTMesureValide;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarteMesureMoyenneEtendue;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarteDeControle extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'Limite_Sup',
        'Limite_Inf',
        'Parametre',
        'IDOTMV',
    ];
    public function OTMesureValide()
    {
        return $this->belongsTo(OTMesureValide::class, 'IDOTMV','IDOTMesureValide');
    }
    public function CarteMesureMoyenneEtendues()
    {
        return $this->hasMany(CarteMesureMoyenneEtendue::class,'IDCC');
    }
    public function CarteUs()
    {
        return $this->hasMany(CarteU::class,'IDCC');
    }
    public function CartePs()
    {
        return $this->hasMany(CarteP::class,'IDCC');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }

}
