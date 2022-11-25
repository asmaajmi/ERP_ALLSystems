<?php

namespace App\Models;

use App\Models\Caisse;
use App\Models\SuivieDesRebuts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuivieDesDrebus1 extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable=[
      'IDCR',
      'DesParametreMesure',
      'Ncaisse',
      'Remarque',
      'Nbr_Pieces'
    ];
    public function Caisse()
      {
          return $this->belongsTo(Caisse::class,'Ncaisse','Ncaisse');
      }
      public function SuivieDesRebut()
      {
          return $this->belongsTo(SuivieDesRebuts::class,array('IDCR', 'DesParametreMesure','Ncaisse'),array('IDCR', 'DesParametreMesure','Ncaisse'));
      }
      public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
