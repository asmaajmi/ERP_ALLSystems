<?php

namespace App\Models;

use App\Models\CarteP;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MesureCarteP extends Model
{
    use HasFactory;
    protected $fillable=[
      'id',
      'D',
      'Taille_echantillon',
      'P',
      'IDCP',
      ];
      public function CarteP()
      {
          return $this->belongsTo(CarteP::class,'IDCP');
      }
      public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
