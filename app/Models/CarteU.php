<?php

namespace App\Models;

use App\Models\MesureCarteU;
use App\Models\CarteDeControle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarteU extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'IDCC',
        'Ubar',
    ];
    public function CarteControle()
    {
        return $this->belongsTo(CarteDeControle::class, 'IDCC');
    }
    public function MesureCarteUs()
    {
        return $this->hasMany(MesureCarteU::class,'IDCU');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
