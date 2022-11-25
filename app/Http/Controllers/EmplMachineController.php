<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;
use App\Models\EmplacementMachine;
use Illuminate\Support\Facades\DB;

class EmplMachineController extends Controller
{
    public function EmpMachineList(){
        $machines=Machine::all();
        $emp_machines=EmplacementMachine::all();
        return view('crudEmplacementMachine',compact('machines','emp_machines'));
    }

    public function EmpMachineForm(){
        $machines=Machine::all();
        return view('formEmplacementMachine',compact('machines'));
    }

    function EmpMachineCreate (Request $request){
        try{

            $des_emp_fk=$request->input('emp_machine');
            $DesMachine=$request->input('id_machine');
            $dt_emp=$request->input('dt_emp_machine');
            $x_emp=$request->input('longueur');
            $y_emp=$request->input('largeur');
            $z_emp=$request->input('hauteur');
            $Emplacement=EmplacementMachine::create([
                'des_emp'=>$des_emp_fk,
                'x_emp'=>$x_emp,
                'y_emp'=>$y_emp,
                'z_emp'=>$z_emp

            ]);
          
      $datasave = [
        'date_emp'          =>$dt_emp,    
        'des_emp_fk'        =>$des_emp_fk,
        'id_machine'        =>$DesMachine,
        'id_emplacement'    =>$Emplacement->id,
        'x_emp'             =>$x_emp,
        'y_emp'             =>$y_emp,
        'z_emp'             =>$z_emp,
    ];   
    DB::table('local_emps')->updateOrInsert($datasave);

            // $machine=Machine::select('DesMachine')->where('DesMachine',$DesMachine)->get();
            // $Emplacement->Machines()->attach($machine,['date_emp'=>$dt_emp,'des_emp_fk'=>$des_emp_fk,'x_emp'=>$x_emp,'y_emp'=>$y_emp,'z_emp'=>$z_emp]);

           
            return redirect()->back()
            ->with('success', 'Création effectuée aves succès !');
       }
       catch (\Exception $e){
           return redirect()->back()
               ->with('error', 'Erreur lors de la creation  !');

       }
    }

    public function findcrud(Request $request){
        //$request->id here is the id of our chosen option id
        $Emplacement=EmplacementMachine::all();
        $data1=EmplacementMachine::select('id','des_emp','x_emp','y_emp','z_emp')->get();
        //$data2=Machine::select('id')->where('id',)->get();
        $data2 = DB::table('local_emps')
        ->join('machines', 'local_emps.id_machine', '=', 'machines.DesMachine', 'left')
        ->where('local_emps.id_machine', '=',$request->idmachine)
        ->select('local_emps.id_emplacement','local_emps.id_machine','local_emps.des_emp_fk','local_emps.x_emp','local_emps.y_emp','local_emps.z_emp','local_emps.date_emp')->get();
        $data=[
            'data1' => $data1,
            'data2' => $data2
        ];
        return response()->json($data);
	}
    
    public function deleteEmplacement(EmplacementMachine $emplacement){
        $machines=Machine::all();
        $emplacement->delete();
        return view('crudEmplacementMachine',compact('machines'));
    }

    public function EditEmplacement(EmplacementMachine $emplacement){
        $machines=Machine::all();
        $data = DB::table('local_emps')
        ->join('emplacement_machines', 'local_emps.id_emplacement', '=', 'emplacement_machines.id', 'left')
        ->where('local_emps.id_emplacement', '=', $emplacement->id)
        ->select('local_emps.id_emplacement','local_emps.id_machine','local_emps.date_emp')->get();
        //return response()->view("formemplacementMachine",compact("machines"));
        $view = view("formemplacementMachineEdit",compact('machines','emplacement','data'))->render();

        return response()->json(['html'=>$view]);
    }

    public function UpdateEmplacementMachine(Request $request,EmplacementMachine $emplacement){
        try{

        $des_emp=$request->input('emp_machine');
        //$id_machine=$request->input('id_machine');
        $dt_emp=$request->input('dt_emp_machine');
        $x_emp=$request->input('longueur');
        $y_emp=$request->input('largeur');
        $z_emp=$request->input('hauteur');
        $id=$emplacement->id;
        DB::table('local_emps')->where(['id_emplacement'=>$id])
                               ->update(['date_emp'=>$dt_emp,'des_emp_fk'=>$des_emp,
                               'x_emp'=>$x_emp,'y_emp'=>$y_emp,'z_emp'=>$z_emp]);

        EmplacementMachine::where(['id'=>$id])->update(['des_emp' =>$des_emp,'x_emp'=>$x_emp,
        'y_emp'=>$y_emp,'z_emp'=>$z_emp]);
          
        return redirect()->back()
        ->with('success', 'Modification effectuée aves succès !');
        }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');

        }
        
    }
    
}
