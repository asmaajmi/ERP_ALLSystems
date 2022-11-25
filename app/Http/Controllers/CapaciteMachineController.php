<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CapaciteMachineController extends Controller
{
    public function tableauCapaciteMachine(){
    
        return view('tableau_capacite_machine');
    }
}
