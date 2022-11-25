<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeureSuppAeffectuer extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_emp',
        'dt_heure_supp',
        'hr_debut',
        'hr_fin',
        'prix',
        'validation'
    ];

    public function employe()
{
    return $this->belongsTo(employe::class,'id_emp','id');

}

}
