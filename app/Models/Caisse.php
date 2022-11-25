<?php

namespace App\Models;


use App\Models\SuivieDesRebuts;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Caisse extends Model
{
    use HasFactory;
    protected $fillable=[
        'Ncaisse',
    ];
    public function SuivieDesRebuts()
    {
        return $this->hasMany(SuivieDesRebuts::class,'Ncaisse','Ncaisse');
    }
    public function getDateFormat(){
        return 'Y-d-m H:i:s.v';
    }
}
