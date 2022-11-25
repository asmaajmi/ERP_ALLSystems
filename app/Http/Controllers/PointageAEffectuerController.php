<?php

namespace App\Http\Controllers;

use DateTime;
use DatePeriod;
use DateInterval;
use Carbon\Carbon;
use App\Models\Pause;
use App\Models\Employe;
use Carbon\CarbonPeriod;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Models\JourAEffectuer;
use App\Models\PointageAEffectuer;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\Console\Input\Input;

class PointageAEffectuerController extends Controller
{
    public function pointageAEffList(Request $request){
        $employes=Employe::all();
        return view('crudpointaeff',compact("employes"));
    }

    public function pointageAEffForm(){
        $employes=Employe::all();
        return view('formPointageAEff',compact("employes"));
    }

    public function create(Request $request){
        try{
        // c'est pour mettre la designation de jour en français
        setlocale(LC_ALL, 'fr_FR', 'fra_FRA');
        // fin
        $desp = $request->input('des_pointage');
        $dtdebut = $request->input('date_deb_periode');
        $dtfin = $request->input('date_fin_periode');
        $emp = $request->input('id_emp');
        $count = DB::table('pointage_a_effectuers')->count(DB::raw('id'));
       
        if($count>0){
        $select=PointageAEffectuer::where('designation_periode',$desp)
                                  ->where('date_debut_periode',$dtdebut)
                                  ->where('date_fin_periode',$dtfin)
                                  ->where('id_emp',$emp)->first();
                                      
        if($select === null){
        $pointage = PointageAEffectuer::create([
            'designation_periode'=>$desp,
            'date_debut_periode'=>$dtdebut,          
            'date_fin_periode'=>$dtfin,
            'annee'=>Carbon::createFromFormat('Y-m-d', $dtdebut)->format('Y'),
            'mois'=>Carbon::createFromFormat('Y-m-d', $dtdebut)->format('m'),
            'id_emp'=>$emp
        ]);
       
        $pointage->jour()->create([
            'designation_j' => "Lundi",
            'heure_entree_j'=>$request->input("heureentree1"),
            'heure_sortie_j'=>$request->input("heuresortie1")]);

            $pointage->jour()->create([
                'designation_j' => "Mardi",
                'heure_entree_j'=>$request->input("heureentree2"),
                'heure_sortie_j'=>$request->input("heuresortie2")]);

            $pointage->jour()->create([
                'designation_j' => "Mercredi",
                'heure_entree_j'=>$request->input("heureentree3"),
                'heure_sortie_j'=>$request->input("heuresortie3")]);
            
            $pointage->jour()->create([
                'designation_j' => "Jeudi",
                'heure_entree_j'=>$request->input("heureentree4"),
                'heure_sortie_j'=>$request->input("heuresortie4")]);
            
            $pointage->jour()->create([
                'designation_j' => "Vendredi",
                'heure_entree_j'=>$request->input("heureentree5"),
                'heure_sortie_j'=>$request->input("heuresortie5")]);

            $pointage->jour()->create([
                'designation_j' => "Samedi",
                'heure_entree_j'=>$request->input("heureentree6"),
                'heure_sortie_j'=>$request->input("heuresortie6")]);
           
            $pointage->jour()->create([
                'designation_j' => "Dimanche",
                'heure_entree_j'=>$request->input("heureentree7"),
                'heure_sortie_j'=>$request->input("heuresortie7")]);
        // le remplissage de table date_a_effcetuers pour le calcul de note de ponctualité
        $period = new DatePeriod(Carbon::parse(request('date_deb_periode')), CarbonInterval::day(), Carbon::parse(request('date_fin_periode'))->addDay(1));
        foreach ($period as $date) {
            $d = $date->format('Y-m-d');
                $pointage->dateAEff()->create([
                    'dt_a_eff'=>$d,
                    'annee'=>Carbon::createFromFormat('Y-m-d', $d)->format('Y'),
                    'mois'=>Carbon::createFromFormat('Y-m-d', $d)->format('m'),
                    'num_j'=>Carbon::createFromFormat('Y-m-d', $d)->format('d'),
                    'des_j'=>strftime('%A',strtotime($d))
                ]);
            }             
        // fin de remplissage
                
                Alert::success('Succés', 'Création effectuée aves succès !'); 
                $employes=Employe::all();
                return view('crudpointaeff',compact("employes"));}
               else{ 
                   Alert::error('Error', 'Cette ligne deja existe !');
                   return back();
              }
            }
            elseif($count == 0){
                $pointage = PointageAEffectuer::create([
                    'designation_periode'=>$desp,
                    'date_debut_periode'=>$dtdebut, 
                    'annee'=>Carbon::createFromFormat('Y-m-d', $dtdebut)->format('Y'),
                    'mois'=>Carbon::createFromFormat('Y-m-d', $dtdebut)->format('m'),         
                    'date_fin_periode'=>$dtfin,
                    'id_emp'=>$emp
                ]);
               
                $pointage->jour()->create([
                    'designation_j' => "Lundi",
                    'heure_entree_j'=>$request->input("heureentree1"),
                    'heure_sortie_j'=>$request->input("heuresortie1")]);
        
                    $pointage->jour()->create([
                        'designation_j' => "Mardi",
                        'heure_entree_j'=>$request->input("heureentree2"),
                        'heure_sortie_j'=>$request->input("heuresortie2")]);
        
                    $pointage->jour()->create([
                        'designation_j' => "Mercredi",
                        'heure_entree_j'=>$request->input("heureentree3"),
                        'heure_sortie_j'=>$request->input("heuresortie3")]);
                    
                    $pointage->jour()->create([
                        'designation_j' => "Jeudi",
                        'heure_entree_j'=>$request->input("heureentree4"),
                        'heure_sortie_j'=>$request->input("heuresortie4")]);
                    
                    $pointage->jour()->create([
                        'designation_j' => "Vendredi",
                        'heure_entree_j'=>$request->input("heureentree5"),
                        'heure_sortie_j'=>$request->input("heuresortie5")]);
        
                    $pointage->jour()->create([
                        'designation_j' => "Samedi",
                        'heure_entree_j'=>$request->input("heureentree6"),
                        'heure_sortie_j'=>$request->input("heuresortie6")]);
                   
                    $pointage->jour()->create([
                        'designation_j' => "Dimanche",
                        'heure_entree_j'=>$request->input("heureentree7"),
                        'heure_sortie_j'=>$request->input("heuresortie7")]);

                    // le remplissage de table date_a_effcetuers pour le calcul de note de ponctualité
                $period = new DatePeriod(Carbon::parse(request('date_deb_periode')), CarbonInterval::day(), Carbon::parse(request('date_fin_periode'))->addDay(1));
                    foreach ($period as $date) {
                        $d = $date->format('Y-m-d');
                        $pointage->dateAEff()->create([
                            'dt_a_eff'=>$d,
                            'annee'=>Carbon::createFromFormat('Y-m-d', $d)->format('Y'),
                            'mois'=>Carbon::createFromFormat('Y-m-d', $d)->format('m'),
                            'num_j'=>Carbon::createFromFormat('Y-m-d', $d)->format('d'),
                            'des_j'=>strftime('%A',strtotime($d))
                        ]);
                    }     
                    // fin de remplissage

                if($pointage){
                Alert::success('Succés', 'Création effectuée aves succès !'); 
                $employes=Employe::all();
                return view('crudpointaeff',compact("employes"));}
            }                                                      
    }
                catch (\Exception $e){
                Alert::error('Error', 'Erreur lors de la création !');
                return back();}
}
    public function finddes(Request $request){

		
        //if our chosen id and products table prod_cat_id col match the get first 100 data 
      
          //$request->id here is the id of our chosen option id
          $data=PointageAEffectuer::select('designation_periode')->where('id_emp',$request->idemp)
                                                                 ->get();
                                                                 
          return response()->json($data);//then sent this data to ajax success
      }

      public function finddtdeb(Request $request){

		
        //if our chosen id and products table prod_cat_id col match the get first 100 data 
      
          //$request->id here is the id of our chosen option id
          $data=PointageAEffectuer::select('annee', 'id')
          ->where('designation_periode',$request->des)
          ->get();
                                                                 
          return response()->json($data);//then sent this data to ajax success
      }


      public function finddtfin(Request $request){

		
        //if our chosen id and products table prod_cat_id col match the get first 100 data 
      
          //$request->id here is the id of our chosen option id
          $data=PointageAEffectuer::select('date_fin_periode')->where('id',$request->datedeb)                                                      
                                                              ->get();
                                                                 
          return response()->json($data);//then sent this data to ajax success
      }


      public function findligne(Request $request){

		
        //if our chosen id and products table prod_cat_id col match the get first 100 data 
      
          //$request->id here is the id of our chosen option id
          $data=JourAEffectuer::select('designation_j', 'heure_entree_j', 'heure_sortie_j','id')->where('num_seq_pa',$request->idpoint) 
                                                                                           ->whereNotNull('heure_entree_j')
                                                                                           ->whereNotNull('heure_sortie_j')      
                                                                                           ->get();
                                                                 
          return response()->json($data);//then sent this data to ajax success
      }

public function findjours(Request $request){
        $data = JourAEffectuer::select('designation_j','id')->where('num_seq_pa', $request->idpoint)
        ->whereNotNull('heure_entree_j')
        ->whereNotNull('heure_sortie_j')->get() ; 
        return response()->json($data);}

public function findpauses(Request $request){
        $data = Pause::select('designation_pause','heure_deb_pause','heure_fin_pause','id')->where('num_seq_j', $request->jour_pause)
        ->get() ; 
        return response()->json($data);}

public function delete(JourAEffectuer $jour){
    $jour->delete();}
}