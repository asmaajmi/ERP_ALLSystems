<?php

namespace App\Models;

use App\Models\BonDeValidation;
use Illuminate\Database\Eloquent\Model;
use App\Models\MethodeNonValideQualitative;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\MethodeNonValideQuantitativeVariablePhysique;

class BonDeValidationNonValide extends Model
{
    use HasFactory;
    protected $fillable=[
        'IDBVNV',
        'IDBonValidation',
    ];
    public function bon_de_validation()
    {
        return $this->belongsTo(BonDeValidation::class,'IDBonValidation','IDBV');
    }

    public function methode_non_valide_quantitative_variable_physiques()
    {
        return $this->hasMany(MethodeNonValideQuantitativeVariablePhysique::class,'IDBVNV','IDBVNV');
    }
    public function methode_non_valide_qualitatives()
    {
        return $this->hasMany(MethodeNonValideQualitative::class,'IDBVNV','IDBVNV');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
