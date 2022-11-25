<?php

namespace App\Models;
use App\Models\OperateurQualiteMesure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;
    protected $fillable = [
        'DesTesteur'
     ];
     public function operateur_qualite_mesure(){
        return $this->hasMany(OperateurQualiteMesure::class,'DesTesteur','DesTesteur');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
