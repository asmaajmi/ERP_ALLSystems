<?php

namespace App\Models;
use App\Models\Employe;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdreTravailTestValidation;
use App\Models\OrdreDeTravailDeMesure;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DirecteurQualite extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','IDEmploye'
     ];
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'IDEmploye');
    }
    public function ordre_travail_test_validations()
    {
        return $this->hasMany(OrdreTravailTestValidation::class,'IDDirecteur');
    }
    public function ordre_de_travail_de_mesures()
    {
        return $this->hasMany(OrdreDeTravailDeMesure::class,'IDDirecteur');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
