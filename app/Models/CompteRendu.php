<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompteRendu extends Model
{
    use HasFactory;
    protected $fillable=[
      'IDCR',
      'DateCR',
      'TotaleControler',
      'SommeDefautsTotale',
      'Pourcentage_defaut_reel',
      'Cm_mesure',
      'Cmk_mesure',
      'Description',
      'IDFC',
      'IDOperateurCalcul',
    ];
    public function OperateurCalcul()
    {
        return $this->belongsTo(OperateurQualiteCalcul::class, 'IDOperateurCalcul');
    }
    public function FicheControle()
    {
        return $this->belongsTo(FicheDeControle::class, 'IDFC','IDFC');
    }
    public function SuivieDesRebuts()
    {
        return $this->hasMany(SuivieDesRebuts::class,'IDCR','IDCR');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
