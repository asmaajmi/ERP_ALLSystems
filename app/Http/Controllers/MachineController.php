<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Machine;
use Illuminate\Http\Request;
use App\Models\OutilFabrication;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MachineController extends Controller
{
    public function machineList(){
        $machines = Machine::all();
        return view("crudMachine", compact("machines"));
    }

    public function machineForm(){       
        return view('machine');
    }

    function create(Request $request){
        try{
        
        $machine = Machine::firstOrCreate([
            'DesMachine'=>$request->input('id_mach'),
            'nom_machine'=>$request->input('nomMachine'),
            'PrixAchat'=>$request->input('prixachat'),
            'DateAchat'=>$request->input('dtachat'),
            'Capacite'=>$request->input('capacite'),
            'MTTR'=>$request->input('mttr'),
            'MTBF'=>$request->input('mtbf'),
            'Description'=>$request->input('description')
        ]);
        $machines=Machine::all();
      
    
                Alert::success('Succés', 'Création effectuée aves succès !'); 
                
                return view("crudMachine", compact("machines")); 
    }
    catch (\Exception $e){
        return redirect()->back()
            ->with('error', 'Erreur lors de la creation  !');
        }
}
public function edit( $machine)
{   $machines=Machine::all()->where('DesMachine',$machine);
    return view("editMachine",compact("machine",'machines')) ;
}
 function update(Request $request, $machine){
     try{
        Machine::where('DesMachine',$machine)->update([

            'DesMachine'=>$request->input('id_mach'),
            'nom_machine'=>$request->input('nom_mach'),
            'PrixAchat'=>$request->input('prixachat'),
            'DateAchat'=>$request->input('dtachat'),
            'Capacite'=>$request->input('capacite'),
            'MTTR'=>$request->input('mttr'),
            'MTBF'=>$request->input('mtbf'),
            'Description'=>$request->input('description')
        ]);
            Alert::success('Succés', 'Modification effectuée aves succès !'); 
          $machines = Machine::all();
       return view("crudMachine", compact("machines")); 
        }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la modification  !');
        }

}
public function delete($machine){
    try{
        Machine::where('DesMachine',$machine)->delete();
        Alert::success('Réussite', 'Machine supprimé avec succès');
        $machines = Machine::all();
        return view("crudMachine", compact("machines"));
    }
    catch(\Exception $e)
    {
        Alert::error('Erreur', "Erreur lors du suppression du Machine");
        return back();
    }
}

 public function afficherMachinePDF($machine){
    $Machine = Machine::where('DesMachine',$machine)->first();  
    $date= Carbon::now();
    view()->share('machine', $Machine);
    view()->share('date', $date);
    $pdf=PDF::loadView('pdf_machine');
    return $pdf->stream('Machine.pdf');
 }

 }
