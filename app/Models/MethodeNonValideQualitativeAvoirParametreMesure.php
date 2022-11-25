<?php

namespace App\Models;

use App\Models\Precision;
use App\Models\TypeOutil;
use App\Models\ParametreMesure;
use Illuminate\Database\Eloquent\Model;
use App\Models\MethodeNonValideQualitative;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MethodeNonValideQualitativeAvoirParametreMesure extends Model
{
    use HasFactory;

    protected $fillable = [
        'DTO',
        'DPM',
        'DP',
        'IDBVNV',
        'IDOTM',
        'DesT'
     ];

     public function methode_non_valide_qualitative()
     {
         return $this->belongsTo(MethodeNonValideQualitative::class, array('IDBVNV', 'IDOTM') , array('IDBVNV', 'IDOrdreTravailMesure'));
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
