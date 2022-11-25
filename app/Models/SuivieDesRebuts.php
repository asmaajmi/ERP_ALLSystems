<?php

namespace App\Models;

use App\Models\CompteRendu;
use App\Models\ParametreMesure;
use App\Models\SuivieDesDrebus1;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuivieDesRebuts extends Model
{
    use HasFactory;
    protected $fillable=[
      'IDCR',
      'DesParametreMesure',
      'PourcentagePartielle',
      'Date_Encaissement'
    ];

      public function CompteRendu()
      {
          return $this->belongsTo(CompteRendu::class,'IDCR','IDCR');
      }
      public function ParametreMesure()
      {
          return $this->belongsTo(ParametreMesure::class,'DesParametreMesure','DesParametreMesure');
      }
      public function SuivieDesRebut1s()
      {
          return $this->hasMany(SuivieDesDrebus1::class,array('IDCR', 'DesParametreMesure'),array('IDCR', 'DesParametreMesure'));
      }  
      public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
      
}
