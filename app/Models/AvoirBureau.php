<?php

namespace App\Models;

use App\Models\Bureau;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AvoirBureau extends BaseModel
{
    use HasFactory;
    protected $table='avoir_bureau';
    protected $fillable = [
        'id_serv',
        'id_bureau',  
        ];
}