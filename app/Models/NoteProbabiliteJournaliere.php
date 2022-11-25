<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteProbabiliteJournaliere extends BaseModel
{
    protected $fillable = [
    'id',
    'annee',
    'mois',
    'jour',
    'numj',
    'c1',
    'c2',
    'c3',
    'note',
    'mention',
    'id_emp'];

    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id', 'id_emp');

    }
}
