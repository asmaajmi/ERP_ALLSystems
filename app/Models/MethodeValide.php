<?php

namespace App\Models;

use App\Models\BonDeValidationValide;
use App\Models\OrdreDeTravailDeMesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class MethodeValide extends Model
{
    use HasFactory;
    protected $fillable = [
    'TolérenceSup',
    'TolérenceInf',
    'GenrePrelevement',
    'NbrPrelevement',
    'PeriodePrelevement',
    'TailleEchantillon',
    'IDBVV',
    'IDOrdreTravailMesure',
    ];
    public function ordre_de_travail_de_mesure()
    {
        return $this->belongsTo(OrdreDeTravailDeMesure::class,'IDOrdreTravailMesure' ,'IDOrdreTravailMesure');
    }
    public function bon_de_validation_valide()
    {
        return $this->belongsTo(BonDeValidationValide::class,'IDBVV' ,'IDBVV');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
