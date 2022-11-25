<?php

namespace App\Models;

use App\Models\MesureCarteP;
use App\Models\CarteDeControle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CarteP extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'IDCC',
        'Pbar',
    ];
    public function CarteControle()
    {
        return $this->belongsTo(CarteDeControle::class, 'IDCC');
    }
    public function MesureCartePs()
    {
        return $this->hasMany(MesureCarteP::class,'IDCP');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
