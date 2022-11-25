<?php

namespace App\Models;

use App\Models\MethodeValide;
use App\Models\BonDeValidation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BonDeValidationValide extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable=[
        'IDBVV',
        'IDBonValidation',
    ];
    public function bon_de_validation()
    {
        return $this->belongsTo(BonDeValidation::class,'IDBonValidation','IDBV');
    }
    public function methode_valides()
    {
        return $this->hasMany(MethodeValide::class,'IDBVV','IDBVV');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
