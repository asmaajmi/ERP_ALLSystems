<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MethodeNonValideQualitativeAvoirParametreMesure;
use App\Models\OrdreDeTravailDeMesure;

class MethodeNonValideQualitative extends Model
{
    use HasFactory;
    protected $fillable = [
        'GenrePrelevement',
        'NbrPrelevement',
        'IDBVNV',
        'IDOrdreTravailMesure',
     ];
     public function methode_non_valide_qualitative_avoir_parametre_mesures()
    {
        return $this->hasMany(MethodeNonValideQualitativeAvoirParametreMesure::class, array('IDBVNV', 'IDOTM'),array('IDBVNV', 'IDOrdreTravailMesure'));
    } 
    public function ordre_de_travail_de_mesure()
    {
        return $this->belongsTo(OrdreDeTravailDeMesure::class,'IDOrdreTravailMesure' ,'IDOrdreTravailMesure');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
