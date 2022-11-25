<?php

namespace App\Models;

use App\Models\TestCapabilite;
use App\Models\OperateurQualiteMesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestCapabiliteOperateurMesure extends Model
{
    use HasFactory;
    protected $fillable=[
        'IDTestCapabilite',
        'IDOperateurMesure',
    ];
    public function test_capabilite()
    {
        return $this->belongsTo(TestCapabilite::class,'IDTestCapabilite');
    }
    public function operateur_qualite_mesure()
    {
        return $this->belongsTo(OperateurQualiteMesure::class,'IDOperateurMesure');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }

}
