<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PonctJourMoy extends BaseModel
{
    protected $fillable = [
        'id',
        'annee',
        'mois',
        'des_jour',
        'valeur',
        'id_emp'
    ];
}