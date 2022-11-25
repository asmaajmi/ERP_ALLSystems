<?php

namespace App\Models;
use App\Models\ProduitConstruisable;
use App\Models\ProduitAchetable;
use App\Models\OrdreTravailTestValidation;
use App\Models\OrdreDeTravailDeMesure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable = ['DesProduit','TypeProduit'];
   
    public function produit_construisables()
    {
        return $this->hasMany(ProduitConstruisable::class,'DesProduit','DesProduit');
    }
    public function produit_achetables()
    {
        return $this->hasMany(ProduitAchetable::class,'DesProduit','DesProduit');
    }
    public function ordre_travail_test_validations()
    {
        return $this->hasMany(OrdreTravailTestValidation::class,'DesProduit','DesProduit');
    }
    public function ordre_de_travail_de_mesures()
    {
        return $this->hasMany(OrdreDeTravailDeMesure::class,'DesProduit','DesProduit');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
