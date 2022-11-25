<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bureau extends BaseModel
{
    use HasFactory;
    protected $table='bureaus';
    protected $fillable = [
        'id',
        'tel1_bur',
        'tel2_bur',  
        ];
    public function services()
    {
        return $this->belongsToMany(Service::class,'avoir_bureau','id_serv','id_bureau');
    }
}
