<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Employe;
use Illuminate\Http\Request;
use App\Models\PointageEffectue;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PointageEffectueController extends Controller
{
    public function Pointageefflist(){
        $pointages = PointageEffectue::orderBy("datepe", "desc");
        return view('crudpointeff',compact("pointages"));
    }
    public function Pointageeffform(){
        $employes = Employe::all();
        return view('formpointageeff',compact("employes"));
    }

    function create(Request $request){
        try{
            $datepeff=$request->input("datepe");
            setlocale(LC_ALL, 'fr_FR', 'fra_FRA');
        $pointage = PointageEffectue::create([
            'datepe'=>$datepeff,
            'heure_entree'=>$request->input("heureentree"),
            'heure_sortie'=>$request->input("heuresortie"),
            'annee'=>Carbon::createFromFormat('Y-m-d', $datepeff)->format('Y'),
            'mois'=>Carbon::createFromFormat('Y-m-d', $datepeff)->format('m'),
            'num_j'=>Carbon::createFromFormat('Y-m-d', $datepeff)->format('d'),
            'des_j'=>strftime('%A',strtotime($datepeff)),
            'id_emp'=>$request->input("id_emp")
        ]);
        if($pointage){
            Alert::success('Succés', 'création effectuée aves succès !'); 
            $pointages = PointageEffectue::orderBy("datepe", "desc")->paginate(5);
            return view('crudpointeff',compact("pointages"));
        }
        }
        catch (\Exception $e){
       
            Alert::error('Erreur', 'Erreur lors de la création  !');
                    return back();   
            }   
    }

        public function delete(PointageEffectue $pointageeff){
            $pointageeff->delete();              
            $pointages = PointageEffectue::orderBy("datepe", "desc")->paginate(5);
            return view('crudpointeff',compact("pointages"));
        }

        public function edit(PointageEffectue $pointageeff){
            $employes = Employe::all();
            return view("editPointageeff", compact("pointageeff", "employes"));
        }

        public function update(Request $request, PointageEffectue $pointageeff){
            try{
              $pointageeff->update([
                  'datepe'=>$request->datepe,
                  'heure_entree'=>$request->heureentree,
                  'heure_sortie'=>$request->heuresortie        
              ]);
              if($pointageeff){
                Alert::success('Succés', 'Modification effectuée aves succès !'); 
                $pointages = PointageEffectue::orderBy("datepe", "desc")->paginate(5);
                return view('crudpointeff',compact("pointages"));
            }
            }
            catch (\Exception $e){    
                Alert::error('Erreur', 'Erreur lors de la modification  !');
                        return back();} 
            }
}
