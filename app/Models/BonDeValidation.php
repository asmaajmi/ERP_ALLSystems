<?php

namespace App\Models;

use App\Models\TestNormalite;
use App\Models\TestCapabilite;
use App\Models\TestTaillePeriode;
use App\Models\BonDeValidationValide;
use Illuminate\Database\Eloquent\Model;
use App\Models\BonDeValidationNonValide;
use App\Models\OrdreTravailTestValidation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BonDeValidation extends Model
{
    use HasFactory;
    protected $fillable=[
      'IDBV',
      'DateValidation',
      'ValidationOrdreTravail',
      'TypeDuTest',
      'Etat',
      'ValidationBonValidation',
      'IDOrdreTravailTestValidation',
    ];
    
    public function ordre_travail_test_validation()
    {
        return $this->belongsTo(OrdreTravailTestValidation::class,'IDOrdreTravailTestValidation','IDOTTV');
    }
    public function bon_de_validation_valides()
    {
        return $this->hasMany(BonDeValidationValide::class,'IDBonValidation','IDBV');
    }
    public function bon_de_validation_non_valides()
    {
        return $this->hasMany(BonDeValidationNonValide::class,'IDBonValidation','IDBV');
    }
    public function test_capabilites()
    {
        return $this->hasMany(TestCapabilite::class,'IDBonValidation','IDBV');
    }
    public function test_normalites()
    {
        return $this->hasMany(TestNormalite::class,'IDBonValidation','IDBV');
    }
    public function test_taille_periodes()
    {
        return $this->hasMany(TestTaillePeriode::class,'IDBonValidation','IDBV');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
