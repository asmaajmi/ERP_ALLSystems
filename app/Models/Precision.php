<?php

namespace App\Models;

use App\Models\AvoirParametreMesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MethodeNonValideQualitativeAvoirParametreMesure;

class Precision extends Model
{

    use HasFactory;
    protected $fillable = [
        'DesPrecision'
    ];
    public function avoir_parametre_mesures()
    {
        return $this->hasMany(AvoirParametreMesure::class,"DesPrecision","DesPrecision");
    }
    public function methode_non_valide_qualitative_avoir_parametre_mesures()
    {
        return $this->hasMany(MethodeNonValideQualitativeAvoirParametreMesure::class,"DesPrecision","DesPrecision");
    }
      public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
   
}
