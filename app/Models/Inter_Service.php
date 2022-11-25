<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inter_Service extends BaseModel
{
    use HasFactory;
    protected $table='inter__services';

    protected $fillable = [
        'id',
        'dt_debut_ex_serv',
        'dt_fin_ex_serv',
        'cout_par_utilisation',
        'prime_total_a_payer',
        'id_emp'
    ];
    public function missions()
    {
        return $this->belongsToMany(Mission::class,'prime__missions','id_inter_serv','id_mission')->withPivot('prime');
    }

    public function employes()
    {
        return $this->belongsTo(employe::class,'id_emp','id');
    
    }
    
    //public function missions()
    //{
    //    return $this->belongsToMany('App\Models\Mission')->using('App\Models\Prime_Mission');
    //}
}
