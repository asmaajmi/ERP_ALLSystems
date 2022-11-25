<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BonDeValidationNonValide;
use App\Models\OrdreDeTravailDeMesure;
class MethodeNonValideQuantitativeVariablePhysique extends Model
{
    use HasFactory;
    protected $fillable = [
        'TolérenceSup',
        'TolérenceInf',
        'GenrePrelevement',
        'NbrPrelevement',
        'IDBVNV',
        'IDOrdreTravailMesure',
     ];
     public function bon_de_validation_non_valide()
     {
         return $this->belongsTo(BonDeValidationNonValide::class,'IDBVNV','IDBVNV');
     }
     public function ordre_de_travail_de_mesure()
     {
         return $this->belongsTo(OrdreDeTravailDeMesure::class,'IDOrdreTravailMesure' ,'IDOrdreTravailMesure');
     }
     public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
   
}
