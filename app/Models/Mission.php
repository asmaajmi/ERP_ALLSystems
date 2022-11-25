<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends BaseModel
{
    use HasFactory;
    protected $table='missions';

    protected $fillable = [
        'id_mission'
    ];

    public function Interservices()
    {
        return $this->belongsToMany(Inter_Service::class,'prime__missions','id_inter_serv','id_mission')->withPivot('prime');
    }
}
