<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntraService extends Model
{
    protected $table = 'intra_services';
    protected $fillable = [
        'id',
        'dte_deb_ex_ser',
        'dte_fin_ex_ser',
        'hr_deb_ex_ser',
        'hr_fin_ex_ser',
        'prime_sup',
        'id_serv',
        'id_emp_op',
        'id_emp_sup'
    ];

    public function employe()
    {
        return $this->belongsTo(Employe::class);

    }

    public function service()
    {
        return $this->belongsTo(Service::class);

    }
}
