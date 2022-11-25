<?php

namespace App\Models;
use App\Models\Employe;
use App\Models\OrdreTravailTestValidation;
use App\Models\BonSortieOutil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsableQualite extends Model
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
        return $this->hasMany(OrdreTravailTestValidation::class);
    }
    public function bon_sortie_outils()
    {
        return $this->hasMany(BonSortieOutil::class ,'IDResponsable');
    }
    public function bon_de_retour()
    {
        return $this->hasMany(BonSortieOutil::class ,'IDResponsable');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
