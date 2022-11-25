<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmplacementMachine extends BaseModel
{
    use HasFactory;
    protected $table = 'emplacement_machines';

    protected $fillable = [
        'id',
        'des_emp',
        'x_emp',
        'y_emp',
        'z_emp'
    ];

    public function Machines()
    {
        return $this->belongsToMany(Machine::class,'local_emps','id_emplacement','id_machine')->withPivot('date_emp','des_emp_fk','x_emp','y_emp','z_emp');
    }
}
