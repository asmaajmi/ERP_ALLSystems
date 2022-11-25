<?php

namespace App\Models;

use App\Models\TypeMesure;
use App\Models\SuivieDesRebuts;
use App\Models\AvoirParametreMesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MethodeNonValideQualitativeAvoirParametreMesure;

class ParametreMesure extends Model
{
    use HasFactory;
    protected $table = 'parametre_mesures';
    protected $fillable = [
        'DesParametreMesure','DesTypeMesure','critere'
    ];
    //relation entre parametre mesure et avoir parametre mesure
    public function avoir_parametre_mesures()
    {
        return $this->hasMany(AvoirParametreMesure::class,"DesParametreMesure","DesParametreMesure");
    }
    public function SuivieDesRebuts()
    {
        return $this->hasMany(SuivieDesRebuts::class,'DesParametreMesure','DesParametreMesure');
    }
    public function methode_non_valide_qualitative_avoir_parametre_mesures()
    {
        return $this->hasMany(MethodeNonValideQualitativeAvoirParametreMesure::class,"DesParametreMesure","DesParametreMesure");
    }
    //relation entre parametre mesure et type mesure
    public function type_mesure()
    {
        return $this->belongsTo(TypeMesure::class, 'DesTypeMesure', 'DesTypeMesure');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
