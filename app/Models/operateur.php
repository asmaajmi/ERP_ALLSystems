<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class operateur extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','IDEmploye'
     ];
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'IDEmploye');
    }
}
