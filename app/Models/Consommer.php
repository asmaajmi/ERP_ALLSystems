<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consommer extends BaseModel
{
    protected $table='consommers';
    protected $fillable = [
        'id',
        'quantiteoutil',
        'uniteoutil',
        'quantiteproduit',
        'uniteproduit',
        'id_machine',
        'ref_outil',
        'id_produit'];
}
