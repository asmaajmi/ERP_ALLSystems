<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PonctualitePersonnelleJournaliere extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'id',
        'annee',
        'mois',
        'jour',
        'des_jour',
        'date_jour',
        'valeur',
        'mention',
        'id_emp'
    ];
}
