<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeureSuppEff extends BaseModel
{
    use HasFactory;
    public $primaryKey = 'id';
    protected $fillable = [
        'id',
        'dt_heure_supp',
        'prix',
        'validation',
        'id_emp',
        'hr_debut',
        'hr_fin'
    ];

    public function employe()
    {
        return $this->belongsTo(employe::class,'id_emp','id');
    
    }
}
