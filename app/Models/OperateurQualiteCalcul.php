<?php

namespace App\Models;
use App\Models\Employe;
use App\Models\CompteRendu;
use App\Models\ColonneMesure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OperateurQualiteCalcul extends Model
{
    use HasFactory;
    protected $fillable = [
        'id','IDEmploye'
     ];
    public function employe()
    {
        return $this->belongsTo(Employe::class, 'IDEmploye');
    }
    public function CompteRendus()
    {
        return $this->hasMany(CompteRendu::class,'IDOperateurCalcul');
    }
    public function ColonneMesure()
    {
        return $this->hasMany(ColonneMesure::class,'operateur');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }

}
