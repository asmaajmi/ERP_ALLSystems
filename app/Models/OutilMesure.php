<?php

namespace App\Models;
use App\Models\Fabriquant;
use App\Models\TypeOutil;
use App\Models\BonSortieOutil;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutilMesure extends Model
{
    use HasFactory;
   
    protected $fillable = [
        'DesOutilMesure', 'NumFicheAchat', 'DesTypeOutil', 'NomFabriquant','Disponibilite'
    ];
    public function fabriquant()
    {
        return $this->belongsTo(Fabriquant::class, 'NomFabriquant','NomFabriquant');
    }
    public function type_outil()
    {
        return $this->belongsTo(TypeOutil::class, 'DesTypeOutil', 'DesTypeOutil');
    }
    public function bon_sortie_outils()
    {
        return $this->hasMany(BonSortieOutil::class,'IDOutil','DesOutilMesure');
    }   

    public function bon_de_retour()
    {
        return $this->hasMany(BonSortieOutil::class,'IDOutil','DesOutilMesure');
    }   
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
