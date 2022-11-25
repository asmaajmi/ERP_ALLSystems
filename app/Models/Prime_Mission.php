<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Prime_Mission extends BaseModel
{
    use HasFactory;
    protected $table='prime__missions';

    protected $fillable = [
        'des_mission',
        'id_inter_serv',
        'prime'
    ];

    
}
