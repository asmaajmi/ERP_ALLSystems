<?php

namespace App\Models;

use App\Models\OrdreDeTravailDeMesure;
use App\Models\OrdreTravailTestValidation;
use App\Models\BonSortieOutil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class OrdreTravail extends Model
{
    use HasFactory;
    protected $fillable = [
        'IDOT', 'TypeOrdre'
     ];
    
     public function ordre_de_travail_de_mesures()
     {
         return $this->hasMany(OrdreDeTravailDeMesure::class,'IDOT','IDOT');
     }
     public function ordre_travail_test_validations()
     {
         return $this->hasMany(OrdreTravailTestValidation::class,'IDOT','IDOT');
     }
     public function bon_sortie_outils()
     {
         return $this->hasMany(BonSortieOutil::class,'IDOT','IDOT');
     } 
     public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
