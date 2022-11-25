<?php

namespace App\Models;

use App\Models\BonDeValidation;
use App\Models\TestTaillePeriodeValide;
use Illuminate\Database\Eloquent\Model;
use App\Models\TestTaillePeriodeNonValide;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestTaillePeriode extends Model
{
    use HasFactory;
    protected $fillable=[
      'id',
      'Validation',
      'IDBonValidation',
    ];
    public function bon_de_validation()
    {
        return $this->belongsTo(BonDeValidation::class,'IDBonValidation','IDBV');
    }
    public function test_taille_periode_non_valides()
    {
        return $this->hasMany(TestTaillePeriodeNonValide::class,'IDTestTaillePeriode');
    }
    public function test_taille_periode_valides()
    {
        return $this->hasMany(TestTaillePeriodeValide::class,'IDTestTaillePeriode');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
