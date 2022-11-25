<?php

namespace App\Models;

use App\Models\CarteDeControle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OTMesureValide extends Model
{
    use HasFactory;
    protected $fillable=[
    'IDOTMesureValide',
    'IDOTM',
    ];

    public function CarteControle()
    {
        return $this->hasMany(CarteDeControle::class,'IDOTMesureValide','IDOTMV');
    }
    public function ordre_de_travail_de_mesure()
    {
        return $this->belongsTo(OrdreDeTravailDeMesure::class,'IDOTM' ,'IDOrdreTravailMesure');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
