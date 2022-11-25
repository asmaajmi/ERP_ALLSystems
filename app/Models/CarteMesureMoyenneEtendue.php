<?php

namespace App\Models;

use App\Models\ColonneMesure;
use App\Models\CarteDeControle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarteMesureMoyenneEtendue extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'CoefA2',
        'CoefD4',
        'IDCC'
    ];
    public function CarteControle()
    {
        return $this->belongsTo(CarteDeControle::class, 'IDCC');
    }
    public function ColonneMesures()
    {
        return $this->hasMany(ColonneMesure::class,'IDCM_ME');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
