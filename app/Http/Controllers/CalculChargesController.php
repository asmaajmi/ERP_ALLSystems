<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculChargesController extends Controller
{
    public function calculChargeProduit(){
        return view('calcul_de_charge_produit');
    }

    public function calculChargeMachine(){
        return view('calcul_de_charge_machine');
    }
}
