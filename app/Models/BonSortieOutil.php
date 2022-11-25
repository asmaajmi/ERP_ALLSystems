<?php

namespace App\Models;

use App\Models\OperateurQualiteMesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\OutilMesure;
use App\Models\ResponsableQualite;
use App\Models\OrdreTravail;
class BonSortieOutil extends Model
{
    use HasFactory;
    protected $fillable=
    [ 'id',
      'DateSortie',
      'IDOT',
      'IDResponsable',
      'IDOperateurMesure',
      'IDOutil'];
    public function bon_de_retour(){
        return $this->hasOne(OutilMesure::class,'IDBS');
    }
      public function outil_mesure(){
        return $this->belongsTo(OutilMesure::class,'IDOutil','DesOutilMesure');
    }
    public function responsable_qualite(){
        return $this->belongsTo(ResponsableQualite::class,'IDResponsable');
    }
    public function ordre_travail(){
        return $this->belongsTo(OrdreTravail::class,'IDOT','IDOT');
    }
    public function operateur_qualite_mesure(){
        return $this->belongsTo(OperateurQualiteMesure::class,'IDOperateurMesure');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
