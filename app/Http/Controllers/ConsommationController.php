<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Consommer;
use Illuminate\Http\Request;
use App\Models\OutilFabrication;
use App\Models\ProduitAchetable;
use Illuminate\Support\Facades\DB;
use App\Models\ProduitConstruisable;
use RealRashid\SweetAlert\Facades\Alert;
use SebastianBergmann\Environment\Console;

class ConsommationController extends Controller
{
    public function consForm(){
        $machines = Machine::all();
        $produits = ProduitConstruisable::all();
        $outils = OutilFabrication::all();
        return view("formConsommation", compact("machines", "produits", "outils"));
    }

    public function consList(){
        $machines = Machine::all();
        $produits = ProduitConstruisable::all();
        $outils = OutilFabrication::all();
        $consommers = Consommer::all();
        return view("crudConsommation", compact("machines", "produits", "outils","consommers"));
    }

    function create(Request $request){      
        try{
            foreach($request->nomoutil as $key=>$nomoutil){
                $cons = DB::table('Consommers')->insert([       
                    ['ref_outil'=>$nomoutil,
                    'id_machine'=>$request->machine_id,
                    'id_produit'=>$request->nomproduit,
                    'quantiteproduit'=>$request->qteprod,
                    'uniteproduit'=>$request->uniteprod,
                    'quantiteoutil'=>$request->qte[$key],
                    'uniteoutil'=>$request->unite[$key]]
                ]);}

        if($cons){
            Alert::success('Succés', 'Création effectuée aves succès !'); 
            $machines = Machine::all();
            $produits = ProduitConstruisable::all();
            $outils = OutilFabrication::all();
            $consommers = Consommer::all();
            return view("crudConsommation", compact("machines", "produits", "outils","consommers"));
        }
    }   
    
    catch (\Exception $e){    
        Alert::error('Erreur', 'Erreur lors de la Création  !');
        return back();}
    }



    public function delete(Consommer $consommer){
        $consommer->delete();      
        $machines = Machine::all();
        $produits = ProduitConstruisable::all();
        $outils = OutilFabrication::all();
        $consommers = Consommer::all();
        return view("crudConsommation", compact("machines", "produits", "outils","consommers"));
    }

}