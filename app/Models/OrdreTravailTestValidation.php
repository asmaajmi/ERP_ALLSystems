<?php

namespace App\Models;

use App\Models\DirecteurQualite;
use App\Models\ResponsableQualite;
use App\Models\Machine;
use App\Models\Produit;
use App\Models\TypeMesure;
use App\Models\AvoirParametreMesure;
use App\Models\Capabilite;
use App\Models\Normalite;
use App\Models\TaillePeriode;
use App\Models\BonDeValidation;
use App\Models\OrdreTravail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class OrdreTravailTestValidation extends Model
{     use HasFactory;
    protected $fillable = 
    [     
        'IDOTTV',
        'DateOrdreTestValidation',
        'Objectif',
        'Description',
        'IDResponsable',
        'IDDirecteur',
        'IDMachine',
        'DesProduit',
        'DesTypeOutil',
        'DesParametreMesure',
        'DesPrecision',
        'DesTypeMesure',
        'Etat',
        'IDOT'
        
           
    ];
  
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'IDMachine','DesMachine');
    }
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'DesProduit','DesProduit');
    }
    public function directeur_qualite()
    {
        return $this->belongsTo(DirecteurQualite::class, 'IDDirecteur');
    }
    public function responsable_qualite()
    {
        return $this->belongsTo(ResponsableQualite::class, 'IDResponsable');
    }
    public function type_mesure()
    {
        return $this->belongsTo(TypeMesure::class, 'DesTypeMesure', 'DesTypeMesure');
    }
    public function avoir_parametre_mesure()
    {
        return $this->belongsTo(AvoirParametreMesure::class, array('DesTypeOutil', 'DesParametreMesure','DesPrecision'),array('DesTypeOutil', 'DesParametreMesure','DesPrecision'));
    }
    public function ordre_travail()
    {
        return $this->belongsTo(OrdreTravail::class, 'IDOT', 'IDOT');
    }
    public function bon_de_validation()
    {
        return $this->hasOne(BonDeValidation::class,'IDOrdreTravailTestValidation','IDOTTV');
    }
    public function capabilite()
    {
        return $this->hasOne(Capabilite::class,'IDOrdreTravailTestValidation','IDOTTV');
    }
    public function normalite()
    {
        return $this->hasOne(Normalite::class,'IDOrdreTravailTestValidation','IDOTTV');
    }
    public function taille_periode()
    {
        return $this->hasOne(TaillePeriode::class,'IDOrdreTravailTestValidation','IDOTTV');
    }
 
    
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }

}
