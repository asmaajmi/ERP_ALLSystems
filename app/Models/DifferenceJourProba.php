<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DifferenceJourProba extends BaseModel
{
    use HasFactory;
    protected $fillable = [
    'id',
    'nbj_desJour',
    'diffhr_desJour',
    'diffmin_desJour',
    'id_pointaeff'];
}
