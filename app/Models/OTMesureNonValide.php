<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTMesureNonValide extends Model
{
    use HasFactory;
    protected $fillable = 
    [
    'IDOTMesureNonValide',
    'IDOTM'];

    public function FicheControle()
    {
        return $this->hasOne(FicheDeControle::class,'IDOTMesureNonValide','IDOTMNV');
    }
    public function ordre_de_travail_de_mesure()
    {
        return $this->belongsTo(OrdreDeTravailDeMesure::class,'IDOTM' ,'IDOrdreTravailMesure');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
