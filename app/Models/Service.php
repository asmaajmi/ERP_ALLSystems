<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends BaseModel
{
    use HasFactory;
    protected $table = 'services';

    protected $fillable = [
        'id',
        'des_serv',
        'id_emp',  
        ];
    public function employe()
    {
        return $this->belongsTo(employe::class);
    }
    public function employes()
    {
        return $this->belongsToMany(Employe::class,'travaillers','id_serv','id_emp')
                    ->withPivot('date_debut_tr','date_fin_tr');
    }
    public function bureaus()
    {
        return $this->belongsToMany(Bureau::class,'avoir_bureau','id_serv','id_bureau');
    }
 
    public function intraservice()
    {
        return $this->hasMany(IntraService::class,'id_serv','id');
    }
}
