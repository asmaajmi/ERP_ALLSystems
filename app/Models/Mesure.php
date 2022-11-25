<?php

namespace App\Models;

use App\Models\ColonneMesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mesure extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'valeur_mesure',
        'IDCM',
      ];
      public function ColonneMesure()
      {
          return $this->belongsTo(ColonneMesure::class,'IDCM');
      }
      public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
