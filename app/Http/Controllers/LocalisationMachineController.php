<?php

namespace App\Http\Controllers;

use App\Models\Atelier;
use App\Models\Machine;
use Illuminate\Http\Request;
use App\Models\EmplacementMachine;
use Illuminate\Support\Facades\DB;

class LocalisationMachineController extends Controller
{
    public function LocMachineList(){
        $machines=Machine::all();

        return view('crudLocalisationMachine',compact('machines'));
    }

    public function localisationMachineForm(){
        $machines = Machine::all();
       return view("formLocalisationMachine", compact("machines"));
    }

    
    public function FindEmplacement(Request $request){
       
        $data = DB::table('local_emps')
        ->join('machines', 'local_emps.id_machine', '=', 'machines.DesMachine', 'left')
        ->where('local_emps.id_machine', '=', $request->id)
        ->select('local_emps.id_emplacement','local_emps.id_machine','local_emps.des_emp_fk')->get();

        return response()->json($data);//then sent this data to ajax success
	}

    public function FindCrud(Request $request){
       
            //$request->id here is the id of our chosen option id

            $data=Atelier::select('id','des_atelier','adr_atelier','id_emplacement')
            ->where('id_emplacement', '=',$request->id)
            ->get();
       
            
            return response()->json($data);
        
	}


    public function CreateLocMachine(Request $request){


        try {
        $locmachine = Atelier::create([
        'des_atelier'=>$request->input('des_atelier'),
        'adr_atelier'=>$request->input('adr_atelier'),
        'id_emplacement'=>$request->input('emp_machine')
         ]);
         return redirect()->back()
         ->with('success', 'Création effectuée avec succès !');
        }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');

        }     
    }

    public function EditAtelier(Atelier $atelier){
        
        $view = view("formLocalisationMachineEdit",compact('atelier'))->render();

        return response()->json(['html'=>$view]);
    }

    function UpdateAtelier(Request $request,Atelier $atelier){
        try{
        $id=$atelier->id;
        $des_atelier = $request->input('des_atelier');
        $adr_atelier = $request->input('adr_atelier');
       

        Atelier::where(['id'=>$id])->update(['des_atelier' => $des_atelier,'adr_atelier'=>$adr_atelier ]);
      
        return redirect()->route('heureaeff.list')
        ->with('success', 'Modification effectuée avec succès !');
        }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');

        }

    }
    public function DeleteAtelier(Atelier $atelier){
        $atelier->delete();

        $machines=Machine::all();

        return view('crudLocalisationMachine',compact('machines'));
   }

}
