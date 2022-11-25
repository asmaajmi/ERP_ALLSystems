<?php

namespace App\Models;

use App\Models\BonDeValidation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestNormalite extends Model
{
    use HasFactory;
    protected $fillable=[
      'id',
      'NormaliteMesure',
      'Validation',
      'IDBonValidation',
    ];
    public function bon_de_validation()
    {
        return $this->belongsTo(BonDeValidation::class,'IDBonValidation','IDBV');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
