<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProbabilitePresenceAnnuelle extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'id',
        'annee',
        'valeur',
        'id_emp'
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_emp','id');

    }
}
