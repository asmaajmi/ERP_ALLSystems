<?php

namespace App\Http\Controllers;

use App\Models\JourFerie;
use Illuminate\Http\Request;

class jourFerieController extends Controller
{


    public function JourFerieList(){
        $jours=JourFerie::orderBy("dt_debut_jourferie","asc")->paginate(5);
        return view("crudjourferie",compact('jours'));
    }



    public function JourFerieForm(){
        return view('formjourferie');
    }


    public function createJourFerie(Request $request){


        try {
        $jourferie = JourFerie::create([
        'des_jourferie'=>$request->input('des_jour'),
        'dt_debut_jourferie'=>$request->input('dt_debut'),
        'dt_fin_jourferie'=>$request->input('dt_fin')
         ]);
         return redirect()->back()
         ->with('success', 'créer aves succès !');
        }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');

        }     
    }

    public function editJourFerie(JourFerie $jourferie){
        
        return view("formjourferie_edit",compact("jourferie"));
    }

    public function updateJourFerie(Request $request,JourFerie $jourferie){
        
        $id=$jourferie->id;
        $des_jourferie = $request->input('des_jour');
        $dt_debut_jourferie = $request->input('dt_debut');
        $dt_fin_jourferie = $request->input('dt_fin');
        JourFerie::where(['id' => $id])
        ->update(['des_jourferie' => $des_jourferie,'dt_debut_jourferie'=>$dt_debut_jourferie,'dt_fin_jourferie'=>$dt_fin_jourferie]);

        $jours=JourFerie::all();
        return view("crudjourferie",compact('jours'));
        
      
    }

    public function deleteJourFerie(JourFerie $jourferie){
        $jourferie->delete();

        $jours=JourFerie::orderBy("dt_debut_jourferie","asc")->paginate(5);
        return view("crudjourferie",compact('jours'));
        
   }
}
