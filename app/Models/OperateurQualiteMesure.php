<?php

namespace App\Models;

use App\Models\Employe;
use App\Models\Certification;
use App\Models\ColonneMesure;
use App\Models\BonSortieOutil;
use App\Models\OrdreDeTravailDeMesure;
use Illuminate\Database\Eloquent\Model;
use App\Models\TestCapabiliteOperateurMesure;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperateurQualiteMesure extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','IDEmploye','DesTesteur'
     ];
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'IDEmploye');
    }
    public function test_capabilite_operateur_mesures()
    {
        return $this->hasMany(TestCapabiliteOperateurMesure::class ,'IDOperateurMesure');
    }
    public function bon_sortie_outils()
    {
        return $this->hasMany(BonSortieOutil::class ,'IDOperateurMesure');
    }
    public function bon_de_retour()
    {
        return $this->hasMany(BonSortieOutil::class ,'IDOperateurMesure');
    }
    public function ordre_de_travail_de_mesures()
    {
        return $this->hasMany(OrdreDeTravailDeMesure::class ,'IDOperateurMesure');
    }
    public function certification()
    {
        return $this->belongsTo(Certification::class ,'DesTesteur','DesTesteur');
    }
     public function ColonneMesure()
    {
        return $this->hasMany(ColonneMesure::class,'operateur');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
