<?php

namespace App\Models;
use App\Models\OutilFabrication;
use App\Models\ProduitConstruisable;
use App\Models\OrdreDeTravailDeMesure;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrdreTravailTestValidation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Machine extends Model
{
    use HasFactory;
    protected $fillable = [
        'DesMachine',
        'nom_machine',
        'MTBF',
        'MTTR',
        'PrixAchat',
        'DateAchat',
        'Capacite',
        'Description',
        ];
    public function ordre_travail_test_validations()
    {
        return $this->hasMany(OrdreTravailTestValidation::class,'IDMachine','DesMachine');
    }
    public function ordre_de_travail_de_mesures()
    {
        return $this->hasMany(OrdreDeTravailDeMesure::class,'IDMachine','DesMachine');
    }
    public function produit_construisables()
    {
        return $this->belongsToMany(ProduitConstruisable::class,'produits_construisables_machines', 'IDMachine', 'IDProduitConstruisable');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
    function outilfabrication(){
        return $this->belongsToMany(OutilFabrication::class,'consommers','id_machine','ref_outil')
                    ->withPivot('quantiteoutil','uniteoutil', 'quantiteproduit','uniteproduit');
       }
    
       function produit(){
          return $this->belongsToMany(ProduitConstruisable::class,'consommers','id_machine','id_produit')
                      ->withPivot('quantiteoutil','uniteoutil', 'quantiteproduit','uniteproduit');
         }
}
