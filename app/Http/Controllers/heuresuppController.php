<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\HeureSuppEff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HeureSuppAeffectuer;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;
use League\CommonMark\Block\Element\Document;

class heuresuppController extends Controller
{


    //fonction qui retourne la liste des heures supplementaires a effectuer

    public function Heuresuppaefflist(){
        
        $heureaeffs=HeureSuppAeffectuer::orderBy("dt_heure_supp","asc")->paginate(5);
        return view('crudheuresuppaeff',compact("heureaeffs"));
    }



    //fonction qui retourne la liste des heures supplementaires  effectués

    public function Heuresuppefflist(Request $request){
        $heureeffs=HeureSuppEff::orderBy("dt_heure_supp","asc")->paginate(4);
        return view('crudheuresuppeff',compact('heureeffs'));
    }


    //le fonction qui retourne le formulaire pour les heures supplémentaires a effectuer 
    public function Heuresuppaeffform(){
        $employes=Employe::all();
        return view('formheuresuppaeff',compact("employes"));
    }


    //le fonction qui retourne le formulaire pour les heures supplémentaires effectués

    public function HeureSuppEffForm(){
        $employes=Employe::all();       
         return view('formheuresuppeff',compact("employes"));

    }


    // la fonction qui retourne date des heures supp a effectuer pour un employe choisi

    public function finddateheure(Request $request){
        $valide="Validé";

        //$request->id here is the id of our chosen option id
        $data=HeureSuppAeffectuer::select('dt_heure_supp')->where('id_emp',$request->id)
        ->where('validation',$valide)
        ->get();
        return response()->json($data);//then sent this data to ajax success
	}


    // la fonction qui retourne prix heure fin et heure debut pour un jour ou bien date choisi 

    public function findprixfordatex(Request $request){

        $data=HeureSuppAeffectuer::select('prix','hr_fin','hr_debut')->where('dt_heure_supp',$request->dt)->get();
        return response()->json($data);//then sent this data to ajax success
	}

    //fonction qui va creer les donnees saisies a la formulaire heures supplementaires effectués dans la base avec les alerts

    public function createheuresuppeff(Request $request){
       
       try{
        $id_emp=$request->input('id_emp');
        $dt_heure=$request->input('dtheure');
        $select=HeureSuppEff::where('id_emp',$id_emp)->where('dt_heure_supp',$dt_heure)
                                                     ->first();
                                      
        if($select ===null){

               $heureeff = HeureSuppEff::create([
                'dt_heure_supp'=>$request->input('dtheure'),
                'prix'=>$request->input('prix'),
                'validation'=>'Validé',
                'id_emp'=>$request->input('id_emp'),
                'hr_debut'=>$request->input('hr_debut'),
                'hr_fin'=>$request->input('hr_fin')]);
                
               
                
                    return redirect()->back()
                    ->with('success', 'Création effectuée aves succès !'); }

        else{ 
            return redirect()->route('heureeff.list')
            ->with('error', 'cette ligne deja existe!');
       }
       }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');

        }
      
    }

    //fonction qui va creer les donnees saisies a la formulaire heures supplementaires a effectuer dans la base avec les alerts

    public function createheuresuppaeff(Request $request){
        //$employeid = Employe::where('nom_emp', '=', $request->input('id_emp'));
        try {
        $heureaeff = HeureSuppAeffectuer::create([
        'id_emp'=>$request->input('id_emp'),
        'dt_heure_supp'=>$request->input('dt_heure_a_eff'),
        'hr_debut'=>$request->input('heuredebut'),
        'hr_fin'=>$request->input('heurefin'),
        'prix'=>$request->input('prix')
         ]);
         return redirect()->route('heureaeff.list')
         ->with('success', 'Création effectuée avec succès !');
        }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');

        }
    }

    // fonction qui retourne formulaire de modification pour les heures supplementaires a effectuer

    public function edit(HeureSuppAeffectuer $heureaeff){
        $employes=Employe::all();
        
        return view("formheuresuppaeffedit",compact("heureaeff","employes"));
    }




    public function editvalidation(HeureSuppAeffectuer $heureaeff){
        return view("validation_update",compact("heureaeff"));
    }


    public function updatevalidation(Request $request)
    {   try{
        $id=$request->input('id');
        $val=$request->input('validation');
        HeureSuppAeffectuer::where(['id'=>$id])->update(['validation' => $val]);

        return redirect()->route('heureaeff.list')
         ->with('success', 'Validation effectuée avec succès !');
       
        }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');

        }

    }

    // fonction qui va faire le mise a jour des valeurs dans la base lors de modification 
    // pour les heures supplementaires a effectuer

    function updateheureaeff(Request $request,HeureSuppAeffectuer $heureaeff){
        try{
        $id=$heureaeff->id;
        $id_emp = $request->input('id_emp');
        $dt_heure_supp = $request->input('dt_heure_a_eff');
        $hr_debut = $request->input('heuredebut');
        $hr_fin = $request->input('heurefin');
        $prix = $request->input('prix');

        HeureSuppAeffectuer::where(['id'=>$id])->update(['id_emp' => $id_emp,'dt_heure_supp'=>$dt_heure_supp,
        'hr_debut'=>$hr_debut,'hr_fin'=>$hr_fin,'prix'=>$prix]);
      
        return redirect()->route('heureaeff.list')
        ->with('success', 'Modification effectuée avec succès !');
        }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');

        }

    }


    //fonction qui va supprimer l heure supp a effectuer 
    
    public function deleteheureaeff(HeureSuppAeffectuer $heureaeff){
        $heureaeff->delete();
        $heureaeffs=HeureSuppAeffectuer::orderBy("dt_heure_supp","asc")->paginate(5);
        return view('crudheuresuppaeff',compact("heureaeffs"));
   }

    //fonction qui va supprimer l heure supp effectué 

//   public function deleteheureeff(HeureSuppEff $heureeff){
//    $heureeff->delete();
//    $heureeffs=HeureSuppEff::orderBy("dt_heure_supp","asc")->paginate(4);
//        return view('crudheuresuppeff',compact('heureeffs'));
//    }

}