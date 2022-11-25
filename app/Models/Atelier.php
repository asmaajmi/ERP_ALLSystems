<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atelier extends BaseModel
{
    use HasFactory;
    protected $table = 'ateliers';

    protected $fillable = [
        'id',
        'des_atelier',
        'adr_atelier',
        'id_emplacement'
    ];

    
    public function Emplacements()
    {
    return $this->belongsTo(EmplacementMachine::class,'id_emplacement','id');
    }

}
