<?php

namespace App\Models;
use App\Models\Machine;
use App\Models\Produit;
use App\Models\OrdreTravail;
use App\Models\MethodeValide;
use App\Models\OTMesureValide;
use App\Models\DirecteurQualite;
use App\Models\OTMesureNonValide;
use App\Models\OperateurQualiteMesure;
use Illuminate\Database\Eloquent\Model;
use App\Models\MethodeNonValideQualitative;
use App\Models\OrdreTravailMesureTypeMesure;
use App\Models\OrdreTravailMesureAvoirParametreMesure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MethodeNonValideQuantitativeVariablePhysique;

class OrdreDeTravailDeMesure extends Model
{
    use HasFactory;
    protected $fillable = [
        'IDOrdreTravailMesure',
        'Date',
        'Description',
        'IDOperateurMesure',
        'IDMachine',
        'Etat',
        'IDDirecteur',
        'DesProduit',
        'IDOT',
     ];


     public function operateur_qualite_mesure(){
        return $this->belongsTo(OperateurQualiteMesure::class,'IDOperateurMesure');
    }
    public function directeur_qualite()
    {
        return $this->belongsTo(DirecteurQualite::class, 'IDDirecteur');
    }
    public function machine()
    {
        return $this->belongsTo(Machine::class, 'IDMachine','DesMachine');
    }
    public function produit()
    {
        return $this->belongsTo(Produit::class, 'IDProduit');
    }
    public function ordre_travail()
    {
        return $this->belongsTo(OrdreTravail::class, 'IDOT', 'IDOT');
    }
    public function methode_non_valide_quantitative_variable_physiques()
    {
        return $this->hasMany(MethodeNonValideQuantitativeVariablePhysique::class,'IDOrdreTravailMesure','IDOrdreTravailMesure');
    }
    public function methode_non_valide_qualitative()
    {
        return $this->hasMany(MethodeNonValideQualitative::class,'IDOrdreTravailMesure','IDOrdreTravailMesure');
    }
    public function methode_valides()
    {
        return $this->hasMany(MethodeValide::class,'IDOrdreTravailMesure','IDOrdreTravailMesure');
    }
    public function ordre_travail_mesure_avoir_parametre_mesures()
    {
        return $this->hasMany(OrdreTravailMesureAvoirParametreMesure::class,'IDOrdreTravailMesure','IDOrdreTravailMesure');
    }
    public function ordre_travail_mesure_type_mesures()
    {
        return $this->hasMany(OrdreTravailMesureTypeMesure::class,'IDOrdreTravailMesure','IDOrdreTravailMesure');
    }
    public function ordre_travail_mesure_valides()
    {
        return $this->hasMany(OTMesureValide::class,'IDOrdreTravailMesure','IDOTM');
    }
    public function ordre_travail_mesure_non_valides()
    {
        return $this->hasMany(OTMesureNonValide::class,'IDOrdreTravailMesure','IDOTM');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
       
}
