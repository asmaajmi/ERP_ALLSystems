<?php

namespace App\Models;

use App\Models\TestTaillePeriode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestTaillePeriodeNonValide extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'TailleMaxTeste',
        'PeriodeMinTeste',
        'Cause',
        'IDTestTaillePeriode',
      ];

    public function test_taille_periode()
    {
        return $this->belongsTo(TestTaillePeriode::class,'IDTestTaillePeriode');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
