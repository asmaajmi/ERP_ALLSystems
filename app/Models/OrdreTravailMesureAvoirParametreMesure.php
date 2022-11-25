<?php

namespace App\Models;

use App\Models\AvoirParametreMesure;
use App\Models\OrdreDeTravailDeMesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrdreTravailMesureAvoirParametreMesure extends Model
{
    use HasFactory;
    protected $fillable = [
        'DesTypeOutil',
        'DesParametreMesure',
        'DesPrecision',
        'IDOrdreTravailMesure',
     ];
     public function avoir_parametre_mesure()
     {
         return $this->belongsTo(AvoirParametreMesure::class, array('DesTypeOutil', 'DesParametreMesure','DesPrecision'),array('DesTypeOutil', 'DesParametreMesure','DesPrecision'));
     }
     public function ordre_de_travail_de_mesure()
     {
         return $this->belongsTo(OrdreDeTravailDeMesure::class,'IDOrdreTravailMesure' ,'IDOrdreTravailMesure');
     }
     public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
