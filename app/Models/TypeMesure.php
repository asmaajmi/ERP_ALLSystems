<?php

namespace App\Models;
use App\Models\OrdreTravailTestValidation;
use App\Models\OrdreTravailMesureTypeMesure;
use App\Models\ParametreMesure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeMesure extends Model
{
    use HasFactory;
    protected $fillable = ['DesTypeMesure'];
    public function ordre_travail_test_validations()
    {
        return $this->hasMany(OrdreTravailTestValidation::class);
    }
    public function parametre_mesures()
    {
        return $this->hasMany(ParametreMesure::class,'DesTypeMesure','DesTypeMesure');
    }
    public function ordre_travail_mesure_type_mesures()
    {
        return $this->hasMany(OrdreTravailMesureTypeMesure::class,'DesTypeMesure','DesTypeMesure');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
