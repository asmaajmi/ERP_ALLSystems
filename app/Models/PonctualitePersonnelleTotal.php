<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PonctualitePersonnelleTotal extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'id',
        'total',
        'mention',
        'id_emp'
    ];
}
