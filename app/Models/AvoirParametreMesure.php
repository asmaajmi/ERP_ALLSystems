<?php

namespace App\Models;
use App\Models\Precision;
use App\Models\TypeOutil;
use App\Models\TestCapabilite;
use App\Models\ParametreMesure;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdreTravailTestValidation;
use App\Models\OrdreTravailMesureAvoirParametreMesure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MethodeNonValideQualitativeAvoirParametreMesure;

class AvoirParametreMesure extends Model
{
    use HasFactory;
    protected $fillable = [
        'DesTypeOutil','DesParametreMesure','DesPrecision'  
     ];
    protected $table='avoir_parametre_mesure';
    // public function methode_non_valide_qualitative_avoir_parametre_mesures()
    // {
    //     return $this->hasMany(MethodeNonValideQualitativeAvoirParametreMesure::class, array('DTO', 'DPM','DP'),array('DesTypeOutil', 'DesParametreMesure','DesPrecision'));
    // }
    public function ordre_travail_mesure_avoir_parametre_mesures()
    {
        return $this->hasMany(OrdreTravailMesureAvoirParametreMesure::class,array('DesTypeOutil', 'DesParametreMesure','DesPrecision'),array('DesTypeOutil', 'DesParametreMesure','DesPrecision'));
    }
    public function test_capabilites()
    {
        return $this->hasMany(TestCapabilite::class,array('DesTypeOutil', 'DesParametreMesure','DesPrecision'),array('DesTypeOutil', 'DesParametreMesure','DesPrecision'));
    }
    public function ordre_travail_test_validations()
    {
        return $this->hasMany(OrdreTravailTestValidation::class,array('DesTypeOutil', 'DesParametreMesure','DesPrecision'),array('DesTypeOutil', 'DesParametreMesure','DesPrecision'));
    }
    public function type_outil()
    {
        return $this->belongsTo(TypeOutil::class, 'DesTypeOutil','DesTypeOutil');
    }

    public function parametre_mesure()
    {
        return $this->belongsTo(ParametreMesure::class, 'DesParametreMesure','DesParametreMesure');
    }

    public function precision()
    {
        return $this->belongsTo(Precision::class, 'DesPrecision','DesPrecision');
    }
    
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
