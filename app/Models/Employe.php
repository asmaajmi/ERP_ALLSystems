<?php

namespace App\Models;
use App\Models\Diplome;
use App\Models\Service;
use App\Models\HeureSuppEff;
use App\Models\IntraService;
use App\Models\CongePlanifie;
use App\Models\Inter_Service;
use App\Models\NotePonctualite;
use App\Models\CongeNonPlanifie;
use App\Models\DirecteurQualite;
use App\Models\PointageEffectue;
use App\Models\PointageAEffectuer;
use App\Models\ResponsableQualite;
use App\Models\HeureSuppAeffectuer;
use App\Models\OperateurQualiteCalcul;
use App\Models\OperateurQualiteMesure;
use Illuminate\Database\Eloquent\Model;
use App\Models\NoteProbabiliteJournaliere;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employe extends Model
{
    use HasFactory;
    protected $table = 'employes';

    protected $fillable = [
        'id',
        'cin_emp',
        'nom_emp',  
        'prenom_emp',
        'date_naissance_emp',
        'tel1_emp',
        'tel2_emp',
        'mob1_emp', 
        'mob2_emp', 
        'etat_civil_emp',
        'date_recrutement_emp',
        'salaire_base_emp',
        'seuil_conge_maladie',
        'seuil_conge_annuel',
        'seuil_conge_accidentel',
        'role_emp',
        'var_seuil_conge_maladie',
        'var_seuil_conge_annuel',
        'var_seuil_conge_accidentel',
        'salaire_journalier',
    ];
    public function directeur_qualite()
    {
        return $this->hasOne(DirecteurQualite::class);
    }
    public function responsable_qualite()
    {
        return $this->hasMany(ResponsableQualite::class);
    }
    public function operateur_qualite_mesures()
    {
        return $this->hasMany(OperateurQualiteMesure::class);
    }
    public function operateur_qualite_calculs()
    {
        return $this->hasMany(OperateurQualiteCalcul::class);
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
    public function diplome()
    {
        return $this->hasMany(Diplome::class,'id_emp','id');
    }


    public function intraserviceoperateur()
    {
        return $this->hasMany(IntraService::class,'id_emp_op','id');
    }


    public function intraservicesuperviseur()
    {
        return $this->hasMany(IntraService::class,'id_emp_sup','id');
    }


    public function services()
    {
        return $this->hasMany(Service::class,'id_emp','id');
    }

    public function notePonctualite()
    {
        return $this->hasMany(NotePonctualite::class,'id_emp','id');
    }
    
    public function service()
    {
        return $this->belongsToMany(Service::class, 'travaillers', 'id_emp', 'id_serv')
                    ->withPivot('date_debut_tr','date_fin_tr');
    }


    
    public function pointageaeffectuer()
    {
        return $this->hasMany(PointageAEffectuer::class,'id_emp','id');
    }



    public function pointageeffectue()
    {
        return $this->hasMany(PointageEffectue::class,'id_emp','id');
    }
           

    public function heuresuppaeff()
    {
    return $this->belongsTo(HeureSuppAeffectuer::class,'id_emp','id');

    }

    public function heuresuppeff()
    {
    return $this->belongsTo(HeureSuppEff::class,'id_emp','id');

    }

    public function congeplanifie()
    {
    return $this->belongsTo(CongePlanifie::class,'id');

    }

    public function congeNonplanifie()
    {
    return $this->belongsTo(CongeNonPlanifie::class,'id');

    }


    public function Interservices()
    {
        return $this->belongsToMany(Inter_Service::class,'id','id_emp');
    }
    

    public function noteProbabiliteJournaliere()
    {
        return $this->hasMany(NoteProbabiliteJournaliere::class,'id_emp','id');
    }
    
}
