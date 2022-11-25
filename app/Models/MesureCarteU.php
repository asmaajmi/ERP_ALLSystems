<?php

namespace App\Models;

use App\Models\CarteU;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MesureCarteU extends Model
{
    use HasFactory;
    protected $fillable=[
        'id',
        'TailleEchan',
        'C',
        'U',
        'IDCU',
        ];
        public function CarteU()
        {
            return $this->belongsTo(CarteU::class,'IDCU');
        }
        public function getDateFormat(){
          return 'Y-d-m H:i:s.v';
      }
}
