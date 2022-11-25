<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstituePar extends Model
{
    use HasFactory;
    protected $table='constituer_pars';

    protected $fillable = [
        'id',
        'quantite',
        'unite',
        'id_prodachetable',
        'id_prodconstruisable',
        'id_nomenclature'

    ];
}
