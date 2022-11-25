<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PonctualitePersMensuelle extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'id',
        'annee',
        'mois',
        'valeur',
        'mention',
        'id_emp'
    ];
}
