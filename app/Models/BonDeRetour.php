<?php

namespace App\Models;

use App\Models\OutilMesure;
use App\Models\OrdreTravail;
use App\Models\ResponsableQualite;
use App\Models\OperateurQualiteMesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BonDeRetour extends Model
{
    use HasFactory;
    protected $fillable=
    [ 'id',
      'DateRetour',
      'IDBS',
      'IDResponsable',
      'IDOperateurMesure',
      'IDOutil'];
    
      public function outil_mesure(){
        return $this->belongsTo(OutilMesure::class,'IDOutil','DesOutilMesure');
    }
    public function responsable_qualite(){
        return $this->belongsTo(ResponsableQualite::class,'IDResponsable');
    }
    public function bon_sortie(){
        return $this->belongsTo(OrdreTravail::class,'IDBS');
    }
    public function operateur_qualite_mesure(){
        return $this->belongsTo(OperateurQualiteMesure::class,'IDOperateurMesure');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
