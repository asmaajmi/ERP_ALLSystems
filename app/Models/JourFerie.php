<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JourFerie extends BaseModel
{
    use HasFactory;
    protected $table='jour_feries';

    protected $fillable = [
        'id',
        'dt_debut_jourferie',
        'dt_fin_jourferie',
        'des_jourferie'
    ];

}
