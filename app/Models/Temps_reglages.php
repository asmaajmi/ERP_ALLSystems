<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temps_reglages extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'id',
        'id_machine',
        'id_produit_const1',
        'id_produit_const2',
        'temps_reglage'
    ];
}
