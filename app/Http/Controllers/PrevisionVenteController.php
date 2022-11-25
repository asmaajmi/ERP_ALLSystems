<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrevisionVenteController extends Controller
{
    public function tableauPrevision(){
    
        return view('tableau_prevision_vente');
    }

    public function affichagePrevision(){
    
        return view('crud_prevision_vente');
    }



    public function calculBesoin(){
    
        return view('calcul_de_besoin');
    }
}
