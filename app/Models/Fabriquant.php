<?php

namespace App\Models;
use App\Models\OutilMesure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fabriquant extends Model
{
    use HasFactory;
    protected $fillable = ['NomFabriquant','AdresseFabriquant','EmailFabricant','FaxFabricant','Telephone_1Fabriquant','Telephone_2Fabriquant'];
    public function outil_mesures()
    {
        return $this->hasMany(OutilMesure::class,"NomFabriquant","NomFabriquant");
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
