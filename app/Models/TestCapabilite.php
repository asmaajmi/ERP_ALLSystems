<?php

namespace App\Models;
use App\Models\BonDeValidation;
use App\Models\AvoirParametreMesure;
use Illuminate\Database\Eloquent\Model;
use App\Models\TestCapabiliteOperateurMesure;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestCapabilite extends Model
{
    use HasFactory;
    protected $fillable=[
      'id',
      'CapabiliteMesure',
      'Validation',
      'DesTypeOutil',
      'DesParametreMesure',
      'DesPrecision',
      'IDBonValidation',
    ];
    public function bon_de_validation()
    {
        return $this->belongsTo(BonDeValidation::class,'IDBonValidation','IDBV');
    }
    public function avoir_parametre_mesures()
    {
        return $this->belongsTo(AvoirParametreMesure::class, array('DesTypeOutil', 'DesParametreMesure','DesPrecision'),array('DesTypeOutil', 'DesParametreMesure','DesPrecision'));
    }
    public function test_capabilite_operateur_mesures()
    {
        return $this->hasMany(TestCapabiliteOperateurMesure::class,"IDTestCapabilite");
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
