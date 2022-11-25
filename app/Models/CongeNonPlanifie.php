<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongeNonPlanifie extends BaseModel
{
    use HasFactory;
    protected $table='conge_non_planifies';
    protected $fillable = [
        'id',
        'id_emp',
        'date_debut_conge',
        'date_fin_conge',
        'designation_conge',
        'payement_conge',
        'nbre_jours_nonpayés',
        'nbre_jours_payés',
        'annee',
        'mois',
        'mois_fin'

    ];

    public function employes()
    {
        return $this->belongsTo(employe::class,'id');
    
    }
}
