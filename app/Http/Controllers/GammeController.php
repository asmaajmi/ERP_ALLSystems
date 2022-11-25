<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GammeController extends Controller
{
    public function gammeAffiche(){
        return view('game_de_fabrication');
    }
}
