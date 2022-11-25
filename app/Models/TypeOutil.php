<?php

namespace App\Models;
use App\Models\OutilMesure;
use App\Models\AvoirParametreMesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MethodeNonValideQualitativeAvoirParametreMesure;

class TypeOutil extends Model
{
    use HasFactory;
    protected $table = 'type_outils';
    protected $fillable = [
        'DesTypeOutil',"Etalon"
    ];
 
  
    public function methode_non_valide_qualitative_avoir_parametre_mesures()
    {
        return $this->hasMany(MethodeNonValideQualitativeAvoirParametreMesure::class,'DesTypeOutil','DesTypeOutil');
    }
    public function outil_mesures()
    {
        return $this->hasMany(OutilMesure::class,'DesTypeOutil','DesTypeOutil');
    }
    public function avoir_parametre_mesures()
    {
        return $this->hasMany(AvoirParametreMesure::class,"DesTypeOutil","DesTypeOutil");
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
