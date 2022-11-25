<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotePonctualite extends BaseModel
{
    protected $table = 'note_ponctualites';
    protected $fillable = [
        'id',
        'dte_note',
        'des_note',  
        'cause_note',
        'valeur_note',
        'id_emp'];
    
    public function employe()
    {
        return $this->belongsTo(Employe::class);

    }
}