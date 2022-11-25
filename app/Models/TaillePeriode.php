<?php

namespace App\Models;
use App\Models\OrdreTravailTestValidation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaillePeriode extends Model
{
    use HasFactory;
    protected $fillable = ['id','TailleMinimale','TailleMaximale','PeriodeMinimale','PeriodeMaximale','IDOrdreTestValidation'];
    public function ordre_travail_test_validation()
    {
        return $this->belongsTo(OrdreTravailTestValidation::class, 'IDOrdreTestValidation','IDOTTV');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
