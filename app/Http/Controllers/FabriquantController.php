<?php

namespace App\Http\Controllers;
use App\Models\Fabriquant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
class FabriquantController extends Controller
{
   //afficher liste des fabricants
    public function ListeFabriquants(){
        $fabriquants=Fabriquant::all();
        return view("Fabriquant.Liste_Des_Fabriquants",compact('fabriquants'));
    }
    //afficher le formulaire du l'ajout un fabricant
    public function AjoutUnFabriquant(){
        
        return view("Fabriquant.Ajout_Un_Fabriquant");
    }
      // supprimer un fabricant
      public function delete($fabriquant){
        try{
            Fabriquant::where('NomFabriquant',$fabriquant)->delete();
            Alert::success('Réussite', 'Fabricant supprimé avec succès');
            return redirect('/ListeFabriquants');
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors du suppression du fabricant");
            return back();
        }
    }
    // insertion de la fabriquant
    public function store(Request $request){
        try
        {
              $fabriquant=Fabriquant::firstOrCreate([

                'NomFabriquant'=>$request->input('NomFabriquant'),
                'AdresseFabriquant'=>$request->input('AdresseFabriquant'),
                'FaxFabricant'=>$request->input('FaxFabricant'),
                'EmailFabricant'=>$request->input('EmailFabricant'),
                'Telephone_1Fabriquant'=>$request->input('Telephone_1Fabriquant'),
                'Telephone_2Fabriquant'=>$request->input('Telephone_2Fabriquant') 
                ]);
                $fabriquants=Fabriquant::all();
                Alert::success('Réussite', 'Fabricant ajouté avec succès');
                return view('Fabriquant.Ajout_Un_Fabriquant',compact('fabriquants'));
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de l'ajout d'un fabricant");
            return back();
        }

    }
    //modification d'un fabriquant
    public function ModifierFabriquant($fabriquant)
    {
        $fabriquants=Fabriquant::all()->where('NomFabriquant',$fabriquant);
        return view('Fabriquant.Modifier_Un_Fabriquant',compact('fabriquants','fabriquant'));
    }
    public function update (Request $request, $fabriquant)
    {
        try
        {
                Fabriquant::where('NomFabriquant',$fabriquant)->update
                ([
                'NomFabriquant'=>$request->input('NomFabriquant'),
                'AdresseFabriquant'=>$request->input('AdresseFabriquant'),
                'FaxFabricant'=>$request->input('FaxFabricant'),
                'EmailFabricant'=>$request->input('EmailFabricant'),
                'Telephone_1Fabriquant'=>$request->input('Telephone_1Fabriquant'),
                'Telephone_2Fabriquant'=>$request->input('Telephone_2Fabriquant') 
            ]);
        $fabriquants=Fabriquant::all();
        Alert::success('Réussite', 'Fabricant modifié avec succès');
        return view('Fabriquant.Liste_Des_Fabriquants', compact("fabriquants"));
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de la modification du fabricant");
            return back();
            
        }
    }

}
