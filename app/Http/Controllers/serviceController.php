<?php

namespace App\Http\Controllers;

use App\Models\Bureau;
use App\Models\Employe;
use App\Models\Service;
use App\Models\AvoirBureau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use function GuzzleHttp\Promise\all;

class serviceController extends Controller
{
    public function servicelist(){
        $services=Service::all();
        $bureau=Bureau::orderBy("id","asc")->paginate(4);
        return view('crudservice',compact("services"));
    }
    public function serviceform(){
        $emp="directeur";
        $employes=Employe::select('id', 'nom_emp', 'prenom_emp')->where('role_emp',$emp)->get();
        return view('formservice',compact("employes"));
    }

   
    function createservice(Request $request){
        try{
            $service = Service::create([
                'des_serv'=>$request->input('des_serv'),
                'id_emp'=>$request->input('id_emp')
            ]);
            DB::unprepared('SET IDENTITY_INSERT bureaus ON;');
            foreach($request->numbureau as $key=>$numbureau)
            {
                $x=new Bureau();
                $x->id=$numbureau ;
                $x->tel1_bur= $request->tel1_bur[$key]; 
                $x->tel2_bur= $request->tel2_bur[$key];
                $x->save();
                $service->bureaus()->attach($x); 
            }
            DB::unprepared('SET IDENTITY_INSERT bureaus OFF;');
           
           
            if($service){
                Alert::success('Succés', 'Création effectuée aves succès !'); 
                $services=Service::all();
                $bureau=Bureau::orderBy("id","asc")->paginate(4);
                return view('crudservice',compact("services"));
                }   
       }
       catch (\Exception $e){
           return redirect()->back()
               ->with('error', 'Erreur lors de la creation  !');

       }
    }

    public function edit(Service $service){
        $id_ser=AvoirBureau::all();
        $bureau=Bureau::all();
        //$data=Service::select('des_serv')->where('id','=',$id_ser)->get();

        return view("formserviceedit",compact("bureau","service"));
    }

    function updateservice(Request $request,Service $service){
        
       
        DB::unprepared('SET IDENTITY_INSERT bureaus ON;');
        foreach($request->numbureau as $key=>$numbureau)
        {
             $id=$numbureau ;
             $tel1_bur= $request->tel1_bur[$key]; 
             $tel2_bur= $request->tel2_bur[$key];
             Bureau::where(['id' => $id])
             ->update(['tel1_bur' => $tel1_bur,'tel2_bur'=>$tel2_bur]);
      
        }
        DB::unprepared('SET IDENTITY_INSERT bureaus OFF;');
        $services=Service::all();
        return view('crudservice',compact("services"));
    }

    public function deletebureauservice(Bureau $bureaus){
        //$numbur=Bureau::select('id')->count();
        //if($numbur>1){
            $bureaus->delete();
        //}
        $services=Service::all();
        //$bureau=Bureau::orderBy("id","asc")->paginate(4);
        return view('crudservice',compact("services"));
   }
 
   public function BureauForm(Service $service){
    return view('formaddbureau',compact("service"));
    }

    public function createbureau(Request $request ,Service $service){
        try{
            
            DB::unprepared('SET IDENTITY_INSERT bureaus ON;');
            foreach($request->numbureau as $key=>$numbureau)
            {
                $x=new Bureau();
                $x->id=$numbureau ;
                $x->tel1_bur= $request->tel1_bur[$key]; 
                $x->tel2_bur= $request->tel2_bur[$key];
                $x->save();
                $service->bureaus()->attach($x); 
            }
            DB::unprepared('SET IDENTITY_INSERT bureaus OFF;');
           
            return redirect()->back()
            ->with('success', 'Création effectuée aves succès !');
       }
       catch (\Exception $e){
           return redirect()->back()
               ->with('error', 'Erreur lors de la creation  !');

       }
    }

    public function deleteservice(Service $service){
        $service->delete();
    
    $services=Service::all();
    return view('crudservice',compact("services"));
}

}
