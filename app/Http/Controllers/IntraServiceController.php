<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Service;
use App\Models\IntraService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class IntraServiceController extends Controller
{
    public function Intraservicelist(){
        $intraservs = IntraService::all();
        $services = Service::all();
        $employes = Employe::all();
        return view('crudIntraService', compact("intraservs", "services", "employes"));
    }
    public function Intraserviceform(){
        $emp="employe";
        $employes=Employe::select('id','nom_emp','prenom_emp')->where('role_emp',$emp)->get();
        $services=Service::all();
        return view('formIntraService',compact('employes','services'));
    }

    public function findoperateur(Request $request){

		
        //if our chosen id and products table prod_cat_id col match the get first 100 data 
      
          //$request->id here is the id of our chosen option id
          $data=Employe::select('nom_emp','prenom_emp', 'id')
          ->where('id','!=', $request->idempop)
          ->where('role_emp', '=', 'employe')
          ->get();
                                                                 
          return response()->json($data);//then sent this data to ajax success
      }

      public function edit(IntraService $intraservice)
    {
        $services=Service::all();
        $emp="employe";
        $employes=Employe::select('id','nom_emp','prenom_emp')->where('role_emp',$emp)->get();
        return view("editIntraService", compact("services", "employes", "intraservice"));
    }

    function create(Request $request){       
        try{
            $intraservice = IntraService::create([
                'id_emp_op'=>$request->input('id_op'),
                'id_emp_sup'=>$request->input('id_sup'),
                'id_serv'=>$request->input('id_serv'),
                'prime_sup'=>$request->input('prime'),
                'dte_deb_ex_ser'=>$request->input('datedeb'),
                'dte_fin_ex_ser'=>$request->input('datefin'),
                'hr_deb_ex_ser'=>$request->input('hrdebut'),
                'hr_fin_ex_ser'=>$request->input('hrfin')
        
            ]);
            if($intraservice){
                Alert::success('Succés', 'Création effectuée aves succès !'); 
                $intraservs = IntraService::all();
        $services = Service::all();
        $employes = Employe::all();
        return view('crudIntraService', compact("intraservs", "services", "employes"));
                }    
                }      
                catch (\Exception $e){    
                Alert::error('Erreur', 'Erreur lors de la Création  !');
                return back();}   
}


public function update(Request $request, IntraService $intraservice){
  
    try{
      $intraservice->update([
    'id_emp_op'=>$request->id_op,
      'id_emp_sup'=>$request->id_sup,
      'id_serv'=>$request->id_serv,
      'prime_sup'=>$request->prime,
      'dte_deb_ex_ser'=>$request->datedeb,
      'dte_fin_ex_ser'=>$request->datefin,
      'hr_deb_ex_ser'=>$request->hrdebut,
      'hr_fin_ex_ser'=>$request->hrfin
    ]);
    if($intraservice){
        Alert::success('Succés', 'Modification effectuée aves succès !'); 
        $intraservs = IntraService::all();
        $services = Service::all();
        $employes = Employe::all();
        return view('crudIntraService', compact("intraservs", "services", "employes"));}
    }
        catch (\Exception $e){    
            Alert::error('Erreur', 'Erreur lors de la Modification  !');
            return back();}  
}
    


    public function delete(IntraService $intraservice){
        $intraservice->delete();      
        $intraservs = IntraService::all();
        $services = Service::all();
        $employes = Employe::all();
        return view('crudIntraService', compact("intraservs", "services", "employes"));
}

}