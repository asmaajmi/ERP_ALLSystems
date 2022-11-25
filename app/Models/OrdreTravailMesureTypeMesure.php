<?php

namespace App\Models;
use App\Models\TypeMesure;
use App\Models\OrdreDeTravailDeMesure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdreTravailMesureTypeMesure extends Model
{
    use HasFactory;
    protected $fillable = [
        'IDOrdreTravailMesure',
        'DesTypeMesure',
     ];
     public function ordre_de_travail_de_mesure()
     {
         return $this->belongsTo(OrdreDeTravailDeMesure::class,'IDOrdreTravailMesure' ,'IDOrdreTravailMesure');
     }
     public function type_mesure()
     {
         return $this->belongsTo(TypeMesure::class, 'DesTypeMesure', 'DesTypeMesure');
     }
     public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
