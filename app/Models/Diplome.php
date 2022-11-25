<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplome extends BaseModel
{
    use HasFactory;
    protected $table = 'diplomes';
    protected $fillable = [
        'id',
        'niveau',
        'ecole',
        'dt_obtention',
        'id_emp'
    ];
    
    public function employe()
    {
        return $this->belongsTo(Employe::class);

    }
}
