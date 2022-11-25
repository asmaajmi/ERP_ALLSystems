<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OutilMesure;
use App\Models\TypeOutil;
use App\Models\Fabriquant;
use RealRashid\SweetAlert\Facades\Alert;


class OutilDeMesureController extends Controller
{
    //afficher liste des outils de mesure
      public function ListeDesOutils(){
        $type_outils =TypeOutil::all();
        $outils = OutilMesure::all();
        return view("Outil_De_Mesure.Liste_Des_Outils_De_Mesure",compact("type_outils","outils"));
    }
    // supprimer un outil de mesure
    public function delete($outil){
        try{
            OutilMesure::where('DesOutilMesure',$outil)->delete();
            Alert::success('Réussite', 'Outil supprimé avec succès');
            return redirect('/ListeDesOutilsDeMesure');
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors du suppression de l'outil");
            return back();
        }
    }
    //supprimer all

    //afficher le formulaire du l'ajout un outil de mesure
    public function AjoutUnOutilDeMesure(){
        $type_outils=TypeOutil::all();
        $fabriquants=Fabriquant::all();
        return view("Outil_De_Mesure.Ajout_Un_Outil_De_Mesure",compact('type_outils','fabriquants'));
    }
    //insertion d'un outil de mesure
    function store(Request $request)
    {   
        try{
            // insertion de la outil mesure
            $outil = OutilMesure::firstOrCreate([
                'DesOutilMesure'=>$request->input('DesOutilMesure'),
                'DesTypeOutil'=>$request->input('DesTypeOutil'),
                'NumFicheAchat'=>$request->input('NumFicheAchat'),
                'NomFabriquant'=>$request->input('NomFabriquant'),
                'Disponibilite'=>true,
               ]);
           
            //affichage
            $type_outils=TypeOutil::all();
            $fabriquants=Fabriquant::all();
            $outils=OutilMesure::all();
            Alert::success('Réussite', 'Outil ajouté avec succès');
            return view('Outil_De_Mesure.Ajout_Un_Outil_De_Mesure', compact("outils","type_outils","fabriquants"));
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de l'ajout de l'outil");
            return back();
            
        }
    }
    //modification d'un outil de mesure
    public function ModifierUnOutilDeMesure($outil)
    { 
        $fabriquants=Fabriquant::all();
        $type_outils=TypeOutil::all();
        $outilmesures=OutilMesure::all()->where('DesOutilMesure',$outil);
        return view('Outil_De_Mesure.Modifier_Un_Outil_De_Mesure',compact('outilmesures','outil','type_outils','fabriquants'));
    }
    public function update(Request $request, $outil)
     {
        try{
            // update de la outil mesure
            OutilMesure::where('DesOutilMesure', $outil)->update
             ([              
                'DesOutilMesure'=>$request->input('DesOutilMesure'),
                'DesTypeOutil'=>$request->input('DesTypeOutil'),
                'NumFicheAchat'=>$request->input('NumFicheAchat'),
                'NomFabriquant'=>$request->input('NomFabriquant'),
             ]);
            
            //affichage
            $outils=OutilMesure::all();
            Alert::success('Réussite', 'Outil modifié avec succès');
             return view('Outil_De_Mesure.Liste_Des_Outils_De_Mesure', compact("outils"));
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de la modification de l'outil");
            return back();
        }
     }
}
