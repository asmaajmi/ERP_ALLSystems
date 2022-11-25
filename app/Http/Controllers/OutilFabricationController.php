<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OutilFabrication;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OutilFabricationController extends Controller
{
    public function outilForm(){
        return view('formOutilFabrication');
    }

    public function outilListe(){
        $outils = OutilFabrication::orderBy('nom')->paginate(5);
        return view('crudOutilFabrication', compact("outils"));
    }

    function create(Request $request){      
        try{
            DB::unprepared('SET IDENTITY_INSERT outil_fabrications ON;');
            $outil = OutilFabrication::create([
                'id'=>$request->input('idoutilfabrication'),
                'nom'=>$request->input('nomoutilfabrication')
            ]);
            DB::unprepared('SET IDENTITY_INSERT outil_fabrications OFF;');

            if($outil){
                Alert::success('Succés', 'Création effectuée aves succès !'); 
                $outils = OutilFabrication::orderBy('nom')->paginate(5);
                return view('crudOutilFabrication', compact("outils"));
        }}
        catch (\Exception $e){    
            Alert::error('Erreur', 'Erreur lors de la Création  !');
            return back();}  
}

function delete(OutilFabrication $outil){
    $outil->delete();
    $outils = OutilFabrication::orderBy('nom')->paginate(5);
    return view('crudOutilFabrication', compact("outils"));
}
}