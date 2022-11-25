<?php

namespace App\Models;

use App\Models\CompteRendu;
use App\Models\OTMesureNonValide;
use App\Models\OrdreDeTravailDeMesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FicheDeControle extends Model
{
    use HasFactory;
    protected $fillable=[
        'IDFC',
        'DateFC',
        'enregistrement',
        'Totale_a_Controler',
        'Pourcentage_defaut_estime',
        'NombreDeMesure',
        'Taille_Echantillon',
        'Cm_propose',
        'Cmk_propose',
        'IDOTMNV',
      ];
      public function OrdreTravailMesureNonValide()
      {
          return $this->belongsTo(OTMesureNonValide::class,'IDOTMNV','IDOTMesureNonValide');
      }

      public function CompteRendu()
      {
          return $this->hasOne(CompteRendu::class,'IDFC','IDFC');
      }
      public function getDateFormat(){
          return 'Y-d-m H:i:s.v';
      }
}
