<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CongePlanifie extends BaseModel
{
    use HasFactory;
    protected $table='conge_planifies';
    protected $fillable = [
        'id',
        'id_emp',
        'date_debut_conge',
        'date_fin_conge',
        'designation_conge',
        'payement_conge',
        'validation_conge',
        'nbre_jours_nonpayés',
        'nbre_jours_payés',
        'annee',
        'mois_fin',
        'mois'

    ];
    public function employes()
    {
        return $this->belongsTo(employe::class,'id');
    
    }
}
