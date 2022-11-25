<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Mission;
use Illuminate\Http\Request;
use App\Models\Inter_Service;
use App\Models\Prime_Mission;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Printer;
use SebastianBergmann\Environment\Console;

class InterServiceController extends Controller
{
    public function Interservicelist(){
        $inter_services=Inter_Service::all();
        $missions=Mission::all();
        $prime=Prime_Mission::all();
        return view('crudInter_ExtraService',compact('inter_services','missions','prime'));
    }

    public function Interserviceform(){
        $emp="employe";
        $employes=Employe::select('id','nom_emp','prenom_emp')->where('role_emp',$emp)->get();
        //$employes=Employe::all();
        return view('formInter_ExtraService',compact('employes'));
    }

    function createInterservice(Request $request){
        try{
            $dt_debut=$request->input('dt_debut_inter_service');
            $dt_fin=$request->input('dt_fin_inter_service');
            $cout=$request->input('cout_inter_service');
            $idemp=$request->input('id_emp');
            $interservice = Inter_Service::create([
                'dt_debut_ex_serv'=>$dt_debut,
                'dt_fin_ex_serv'=>$dt_fin,
                'cout_par_utilisation'=>$cout,
                'id_emp'=>$idemp
            ]);
            $id_serv=Inter_Service::select('id');
            $prime_tot=0;

            foreach($request->mission as $key=>$mission)
            {   $prime_miss= $request->prime[$key];
                $x=new Mission();
                $x->des_mission=$mission;
                $x->save();
                $interservice->missions()->attach($x,['prime'=>$prime_miss]);
                $prime_tot=$prime_tot+$prime_miss;
                DB::table('inter__services')->where('id_emp',$idemp)
                                                        ->where('dt_debut_ex_serv',$dt_debut)
                                                        ->where('dt_fin_ex_serv',$dt_fin)
                                                        ->where('cout_par_utilisation',$cout)
                                                        ->update(['prime_total_a_payer' => $prime_tot]);
       
            }
                                 
            return redirect()->back()
            ->with('success', 'Création effectuée avec succès !'); 
        
        }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');
 
        }
    }

    public function Interserviceedit(Inter_Service $interservice){

        $emp="employe";

        $missions=Mission::all();

        $employes=Employe::select('id','nom_emp','prenom_emp')->where('id',$interservice->id)->get();


        $primes = DB::table('prime__missions')
        ->join('missions', 'prime__missions.id_mission', '=', 'missions.id', 'left')
        ->where('prime__missions.id_inter_serv', '=', $interservice->id)
        ->select('prime__missions.id_mission', 'prime__missions.prime')->get();


        return view('formInter_ExtraServiceEdit',compact('employes','interservice','primes','missions'));
    }

    function updateinterservice(Request $request,Inter_Service $interservice){

        try
        {
            $id_interserv=$interservice->id;
            $dt_debut=$request->input('dt_debut_inter_service');
            $dt_fin=$request->input('dt_fin_inter_service');
            $cout=$request->input('cout_inter_service');

            Inter_Service::where('id',$id_interserv)
            ->update(['dt_debut_ex_serv'=>$dt_debut,'dt_fin_ex_serv'=>$dt_fin,'cout_par_utilisation'=>$cout]);

            $prime_tot=0;

            foreach($request->mission as $key=>$mission)
                {   $prime_miss= $request->prime[$key];
                    $mission=$mission;
                    DB::table('prime__missions')->where('id_mission',$mission)
                                                ->update(['prime' => $prime_miss]);
                                
                    $prime_tot=$prime_tot+$prime_miss;
                    DB::table('inter__services')->where('dt_debut_ex_serv',$dt_debut)
                                                ->where('dt_fin_ex_serv',$dt_fin)
                                                ->where('cout_par_utilisation',$cout)
                                                ->update(['prime_total_a_payer' => $prime_tot]);
                                                                            

                
                }
                return redirect()->route('Interservice.list')
                ->with('success', 'Modification effectuée avec succès !'); 
            
        }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la Modification  !');
 
        }
    

    }

    public function deletemission(Mission $missions,Inter_service $inter_Service)
    {
        $prime_t=Inter_Service::select('prime_total_a_payer')->where('id',$inter_Service->id)->get();
        foreach($prime_t as $prime_tot)
        {
            $prime_tot=$prime_tot->prime_total_a_payer;
        }
        $prime_mission=Prime_Mission::select('prime')->where('id_mission',$missions->id)->get();
        foreach($prime_mission as $prime_miss)
        {
            $prime_miss=$prime_miss->prime;
        }
        $prime_tot=$prime_tot-$prime_miss;
        DB::table('inter__services')->update(['prime_total_a_payer' => $prime_tot]);

        $missions->delete();
        
        $inter_services=Inter_Service::all();
        $missions=Mission::all();
        $prime=Prime_Mission::all();
        return view('crudInter_ExtraService',compact('inter_services','missions','prime'));
    }


   public function deleteinterservice(Inter_Service $interserv)
   {
    $interserv->delete();
  
    $inter_services=Inter_Service::all();
        $missions=Mission::all();
        $prime=Prime_Mission::all();
        return view('crudInter_ExtraService',compact('inter_services','missions','prime'));
    }

    
    public function AddMissionform(Inter_Service $interservice){
        
        return view('formAddMission',compact('interservice'));
    }

    public function MissionCreate(Request $request,Inter_Service $interservice)
    {
        try
        {
        $prime_t=Inter_Service::select('prime_total_a_payer')->where('id',$interservice->id)->get();
        foreach($prime_t as $prime_tot)
        {
            $prime_tot=$prime_tot->prime_total_a_payer;
        }
        foreach($request->mission as $key=>$mission)
        {   $prime_miss= $request->prime[$key];
            $x=new Mission();
            $x->des_mission=$mission;
            $x->save();
            $interservice->missions()->attach($x,['prime'=>$prime_miss]);
            $prime_tot=$prime_tot+$prime_miss;
            DB::table('inter__services')->update(['prime_total_a_payer' => $prime_tot]);

           
        }
        return redirect()->back()
        ->with('success', 'Création effectuée avec succès !');
    }
    catch (\Exception $e){
        return redirect()->back()
            ->with('error', 'Erreur lors de la Modification  !');

    }

    }

    

}
