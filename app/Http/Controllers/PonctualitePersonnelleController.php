<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Employe;
use App\Models\Service;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\DateAEffectuer;
use App\Models\DifferenceJour;
use App\Models\JourAEffectuer;
use App\Models\PointageEffectue;
use App\Models\PointageAEffectuer;
use App\Models\PonctJourMoy;
use Illuminate\Support\Facades\DB;
use App\Models\PonctualitePersMensuelle;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\PonctualitePersonnelleTotal;
use App\Models\PonctualitePersonnelleAnnuelle;
use App\Models\PonctualitePersonnelleJournaliere;

class PonctualitePersonnelleController extends Controller
{
    public function PonctualitePersonnelleForm(){
        $services=Service::all();
        $annees=DateAEffectuer::select('annee')->distinct()->get();
        return view('PonctualitePersonnelle',compact("services","annees"));
    }
    public function FindEmploye(Request $request){
        //$request->id here is the id of our chosen option id

        $directeur = DB::table('services')
        ->join('employes', 'services.id_emp', '=', 'employes.id', 'left')
        ->where('services.id', '=', $request->id)
        ->select('employes.nom_emp', 'employes.prenom_emp', 'employes.id')->get();


        $employes = DB::table('travaillers')
        ->join('services', 'travaillers.id_serv', '=', 'services.id')
        ->join('employes','travaillers.id_emp', '=', 'employes.id')
        ->where('travaillers.id_serv', '=', $request->id)
        ->select('employes.id','employes.nom_emp', 'employes.prenom_emp')->get();
        $data=[
            'data1' => $directeur,
            'data2' => $employes
        ];
        return response()->json($data);
	}

    public function PonctualitePersonnelleMensuelleCrud(Request $request){
        $ponctMens = PonctualitePersMensuelle::all();  
        $employes = Employe::all();                     
        return view("PonctualitePersonnelleMensuelleCrud", compact("employes", "ponctMens"));
    }
    
    public function ponctualitePersChart(){
        $employes = Employe::all();      
        return view("chartsPonctualitePersMens", compact("employes"));
    }

    public function findAnne(Request $request){     
        $data = PonctualitePersMensuelle::select('annee')->where('id_emp', $request->idemp)
                                                         ->distinct()
                                                         ->get() ;
        return response()->json($data);
       
    }

    public function findAnneJourn(Request $request){     
        $data = PonctualitePersonnelleJournaliere::select('annee')->where('id_emp', $request->idemp)
                                                         ->distinct()
                                                         ->get() ;
        return response()->json($data);
       
    }


    public function findChart(Request $request)
    {   
        $val=PonctualitePersMensuelle::select("valeur as val")
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)      
        ->pluck('val');

    
        $months=PonctualitePersMensuelle::select(DB::raw("mois as month"))
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->groupBy(DB::raw("mois"),DB::raw("annee"))
        ->pluck('month');

        $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index=>$month)
        {
            $data[$month-1]=$val[$index];
        }

        return response()->json($data);

    }







    public function findChartJourLundi(Request $request)
    {   
        $countexist = PonctJourMoy::count('id');
        if($countexist !=0){
           PonctJourMoy::query()->delete();
        }

        $val1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Lundi')   
                                                     ->where('mois', 1)
                                                     ->sum('valeur');
        $count1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Lundi')   
                                                       ->where('mois', 1)
                                                       ->count('id');
        if($count1 == 0) {
            $moy1 = 0;
        }
        else{                                 
        $moy1= $val1/$count1;}


        $val2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Lundi')   
                                                     ->where('mois', 2)
                                                     ->sum('valeur');
        $count2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Lundi')   
                                                       ->where('mois', 2)
                                                       ->count('id');
        if($count2 == 0) {
        $moy2 = 0;}
        else{ 
        $moy2= $val2/$count2;}


        $val3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Lundi')   
                                                     ->where('mois', 3)
                                                     ->sum('valeur');
        $count3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Lundi')   
                                                       ->where('mois', 3)
                                                       ->count('id');
        if($count3 == 0)
        {$moy3 = 0;}
        else{
        $moy3= $val3/$count3;}


        $val4 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Lundi')   
                                                     ->where('mois', 4)
                                                     ->sum('valeur');
        $count4  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Lundi')   
                                                        ->where('mois', 4)
                                                        ->count('id');
        if($count4 == 0){
            $moy4 = 0;
        }
        else{
        $moy4 = $val4 /$count4 ;}
        

        $val5 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Lundi')   
                                                     ->where('mois', 5)
                                                     ->sum('valeur');
        $count5  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Lundi')   
                                                        ->where('mois', 5)     
                                                        ->count('id');
        if($count5 == 0){
            $moy5 = 0;
        }     
        else{                                      
        $moy5 = $val5 / $count5 ;}


        $val6 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Lundi')   
                                                     ->where('mois', 6)
                                                     ->sum('valeur');
        $count6  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Lundi')   
                                                        ->where('mois', 6)
                                                        ->count('id');
        if( $count6  == 0){
            $moy6 = 0;
        }
        else{
        $moy6 = $val6 / $count6 ; }


        $val7 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Lundi')   
                                                     ->where('mois', 7)
                                                     ->sum('valeur');
        $count7  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Lundi')   
                                                        ->where('mois', 7)
                                                        ->count('id');
        if($count7 == 0){
            $moy7 = 0;
        }  
        else{                                         
        $moy7 = $val7 / $count7 ;}


        $val8 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Lundi')   
                                                     ->where('mois', 8)
                                                     ->sum('valeur');
        $count8  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Lundi')   
                                                        ->where('mois', 8)
                                                        ->count('id');
        if( $count8  == 0)      {
            $moy8 = 0;
        }       
        else{                                  
        $moy8 = $val8 / $count8 ;}


        $val9= PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Lundi')   
                                                     ->where('mois', 9)
                                                     ->sum('valeur');
        $count9  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Lundi')   
                                                        ->where('mois', 9)
                                                        ->count('id');
        if($count9  == 0){
            $moy9 = 0;
        } 
        else{                                          
        $moy9= $val9 / $count9 ;}


        $val10 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Lundi')   
                                                     ->where('mois', 10)
                                                     ->sum('valeur');
        $count10  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Lundi')   
                                                        ->where('mois', 10)
                                                        ->count('id');
        if($count10 == 0){
            $moy10 = 0;
        }    
        else{                                   
        $moy10= $val10 / $count10 ;}


        $val11 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Lundi')   
                                                     ->where('mois', 11)
                                                     ->sum('valeur');
        $count11  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Lundi')   
                                                        ->where('mois', 11)
                                                        ->count('id');
        if($count11 == 0){
        $moy11 = 0;}    
        else{                                                
        $moy11= $val11 / $count11 ;}


        $val12 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                      ->where('id_emp',$request->id_emp)   
                                                      ->where('des_jour', 'Lundi')   
                                                      ->where('mois', 12)
                                                      ->sum('valeur');
        $count12  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                         ->where('id_emp',$request->id_emp)   
                                                         ->where('des_jour', 'Lundi')   
                                                         ->where('mois', 12)
                                                         ->count('id');
        if($count12 == 0){
        $moy12 = 0;}    
        else{                                                   
        $moy12 = $val12 / $count12 ;}

       
        $month1 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 1,
            'des_jour' => 'Lundi',
            'valeur' => $moy1,
            'id_emp' =>$request->id_emp,
        ]);

        $month2 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 2,
            'des_jour' => 'Lundi',
            'valeur' => $moy2,
            'id_emp' =>$request->id_emp,
        ]);

        $month3 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 3,
            'des_jour' => 'Lundi',
            'valeur' => $moy3,
            'id_emp' =>$request->id_emp,
        ]);

        $month4 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 4,
            'des_jour' => 'Lundi',
            'valeur' => $moy4,
            'id_emp' =>$request->id_emp,
        ]);

        $month5 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 5,
            'des_jour' => 'Lundi',
            'valeur' => $moy5,
            'id_emp' =>$request->id_emp,
        ]);

        $month6 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 6,
            'des_jour' => 'Lundi',
            'valeur' => $moy6,
            'id_emp' =>$request->id_emp,
        ]);

        $month7 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 7,
            'des_jour' => 'Lundi',
            'valeur' => $moy7,
            'id_emp' =>$request->id_emp,
        ]);

        $month8 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 8,
            'des_jour' => 'Lundi',
            'valeur' => $moy8,
            'id_emp' =>$request->id_emp,
        ]);

        $month9 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 9,
            'des_jour' => 'Lundi',
            'valeur' => $moy9,
            'id_emp' =>$request->id_emp,
        ]);
        

        $month10 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 10,
            'des_jour' => 'Lundi',
            'valeur' => $moy10,
            'id_emp' =>$request->id_emp,
        ]);

        $month11 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 11,
            'des_jour' => 'Lundi',
            'valeur' => $moy11,
            'id_emp' =>$request->id_emp,
        ]);

        $month12 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 12,
            'des_jour' => 'Lundi',
            'valeur' => $moy12,
            'id_emp' =>$request->id_emp,
        ]);
        

        $val=PonctJourMoy::select("valeur as val")
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Lundi')   
        ->pluck('val');

    
        $months=PonctJourMoy::select(DB::raw("mois as month"))
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Lundi')
        ->groupBy(DB::raw("mois"),DB::raw("annee"))
        ->pluck('month');

        $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index=>$month)
        {
            $data[$month-1]=$val[$index];
        }

        return response()->json($data);
        
    }






    public function findChartJourMardi(Request $request)
    {   
        $countexist = PonctJourMoy::count('id');
        if($countexist !=0){
           PonctJourMoy::query()->delete();
        }

        $val1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mardi')   
                                                     ->where('mois', 1)
                                                     ->sum('valeur');
        $count1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Mardi')   
                                                       ->where('mois', 1)
                                                       ->count('id');
        if($count1 == 0) {
            $moy1 = 0;
        }
        else{                                 
        $moy1= $val1/$count1;}


        $val2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mardi')   
                                                     ->where('mois', 2)
                                                     ->sum('valeur');
        $count2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Mardi')   
                                                       ->where('mois', 2)
                                                       ->count('id');
        if($count2 == 0) {
        $moy2 = 0;}
        else{ 
        $moy2= $val2/$count2;}


        $val3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mardi')   
                                                     ->where('mois', 3)
                                                     ->sum('valeur');
        $count3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Mardi')   
                                                       ->where('mois', 3)
                                                       ->count('id');
        if($count3 == 0)
        {$moy3 = 0;}
        else{
        $moy3= $val3/$count3;}


        $val4 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mardi')   
                                                     ->where('mois', 4)
                                                     ->sum('valeur');
        $count4  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mardi')   
                                                        ->where('mois', 4)
                                                        ->count('id');
        if($count4 == 0){
            $moy4 = 0;
        }
        else{
        $moy4 = $val4 /$count4 ;}
        

        $val5 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mardi')   
                                                     ->where('mois', 5)
                                                     ->sum('valeur');
        $count5  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mardi')   
                                                        ->where('mois', 5)     
                                                        ->count('id');
        if($count5 == 0){
            $moy5 = 0;
        }     
        else{                                      
        $moy5 = $val5 / $count5 ;}


        $val6 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mardi')   
                                                     ->where('mois', 6)
                                                     ->sum('valeur');
        $count6  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mardi')   
                                                        ->where('mois', 6)
                                                        ->count('id');
        if( $count6  == 0){
            $moy6 = 0;
        }
        else{
        $moy6 = $val6 / $count6 ; }


        $val7 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mardi')   
                                                     ->where('mois', 7)
                                                     ->sum('valeur');
        $count7  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mardi')   
                                                        ->where('mois', 7)
                                                        ->count('id');
        if($count7 == 0){
            $moy7 = 0;
        }  
        else{                                         
        $moy7 = $val7 / $count7 ;}


        $val8 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mardi')   
                                                     ->where('mois', 8)
                                                     ->sum('valeur');
        $count8  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mardi')   
                                                        ->where('mois', 8)
                                                        ->count('id');
        if( $count8  == 0)      {
            $moy8 = 0;
        }       
        else{                                  
        $moy8 = $val8 / $count8 ;}


        $val9= PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mardi')   
                                                     ->where('mois', 9)
                                                     ->sum('valeur');
        $count9  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mardi')   
                                                        ->where('mois', 9)
                                                        ->count('id');
        if($count9  == 0){
            $moy9 = 0;
        } 
        else{                                          
        $moy9= $val9 / $count9 ;}


        $val10 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mardi')   
                                                     ->where('mois', 10)
                                                     ->sum('valeur');
        $count10  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mardi')   
                                                        ->where('mois', 10)
                                                        ->count('id');
        if($count10 == 0){
            $moy10 = 0;
        }    
        else{                                   
        $moy10= $val10 / $count10 ;}


        $val11 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mardi')   
                                                     ->where('mois', 11)
                                                     ->sum('valeur');
        $count11  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mardi')   
                                                        ->where('mois', 11)
                                                        ->count('id');
        if($count11 == 0){
        $moy11 = 0;}    
        else{                                                
        $moy11= $val11 / $count11 ;}


        $val12 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                      ->where('id_emp',$request->id_emp)   
                                                      ->where('des_jour', 'Mardi')   
                                                      ->where('mois', 12)
                                                      ->sum('valeur');
        $count12  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                         ->where('id_emp',$request->id_emp)   
                                                         ->where('des_jour', 'Mardi')   
                                                         ->where('mois', 12)
                                                         ->count('id');
        if($count12 == 0){
        $moy12 = 0;}    
        else{                                                   
        $moy12 = $val12 / $count12 ;}

       
        $month1 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 1,
            'des_jour' => 'Mardi',
            'valeur' => $moy1,
            'id_emp' =>$request->id_emp,
        ]);

        $month2 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 2,
            'des_jour' => 'Mardi',
            'valeur' => $moy2,
            'id_emp' =>$request->id_emp,
        ]);

        $month3 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 3,
            'des_jour' => 'Mardi',
            'valeur' => $moy3,
            'id_emp' =>$request->id_emp,
        ]);

        $month4 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 4,
            'des_jour' => 'Mardi',
            'valeur' => $moy4,
            'id_emp' =>$request->id_emp,
        ]);

        $month5 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 5,
            'des_jour' => 'Mardi',
            'valeur' => $moy5,
            'id_emp' =>$request->id_emp,
        ]);

        $month6 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 6,
            'des_jour' => 'Mardi',
            'valeur' => $moy6,
            'id_emp' =>$request->id_emp,
        ]);

        $month7 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 7,
            'des_jour' => 'Mardi',
            'valeur' => $moy7,
            'id_emp' =>$request->id_emp,
        ]);

        $month8 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 8,
            'des_jour' => 'Mardi',
            'valeur' => $moy8,
            'id_emp' =>$request->id_emp,
        ]);

        $month9 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 9,
            'des_jour' => 'Mardi',
            'valeur' => $moy9,
            'id_emp' =>$request->id_emp,
        ]);
        

        $month10 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 10,
            'des_jour' => 'Mardi',
            'valeur' => $moy10,
            'id_emp' =>$request->id_emp,
        ]);

        $month11 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 11,
            'des_jour' => 'Mardi',
            'valeur' => $moy11,
            'id_emp' =>$request->id_emp,
        ]);

        $month12 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 12,
            'des_jour' => 'Mardi',
            'valeur' => $moy12,
            'id_emp' =>$request->id_emp,
        ]);
        

        $val=PonctJourMoy::select("valeur as val")
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Mardi')   
        ->pluck('val');

    
        $months=PonctJourMoy::select(DB::raw("mois as month"))
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Mardi')
        ->groupBy(DB::raw("mois"),DB::raw("annee"))
        ->pluck('month');

        $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index=>$month)
        {
            $data[$month-1]=$val[$index];
        }

        return response()->json($data);
        
    }






    public function findChartJourMercredi(Request $request)
    {   
        $countexist = PonctJourMoy::count('id');
        if($countexist !=0){
           PonctJourMoy::query()->delete();
        }

        $val1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mercredi')   
                                                     ->where('mois', 1)
                                                     ->sum('valeur');
        $count1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Mercredi')   
                                                       ->where('mois', 1)
                                                       ->count('id');
        if($count1 == 0) {
            $moy1 = 0;
        }
        else{                                 
        $moy1= $val1/$count1;}


        $val2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mercredi')   
                                                     ->where('mois', 2)
                                                     ->sum('valeur');
        $count2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Mercredi')   
                                                       ->where('mois', 2)
                                                       ->count('id');
        if($count2 == 0) {
        $moy2 = 0;}
        else{ 
        $moy2= $val2/$count2;}


        $val3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mercredi')   
                                                     ->where('mois', 3)
                                                     ->sum('valeur');
        $count3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Mercredi')   
                                                       ->where('mois', 3)
                                                       ->count('id');
        if($count3 == 0)
        {$moy3 = 0;}
        else{
        $moy3= $val3/$count3;}


        $val4 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mercredi')   
                                                     ->where('mois', 4)
                                                     ->sum('valeur');
        $count4  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mercredi')   
                                                        ->where('mois', 4)
                                                        ->count('id');
        if($count4 == 0){
            $moy4 = 0;
        }
        else{
        $moy4 = $val4 /$count4 ;}
        

        $val5 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mercredi')   
                                                     ->where('mois', 5)
                                                     ->sum('valeur');
        $count5  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mercredi')   
                                                        ->where('mois', 5)     
                                                        ->count('id');
        if($count5 == 0){
            $moy5 = 0;
        }     
        else{                                      
        $moy5 = $val5 / $count5 ;}


        $val6 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mercredi')   
                                                     ->where('mois', 6)
                                                     ->sum('valeur');
        $count6  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mercredi')   
                                                        ->where('mois', 6)
                                                        ->count('id');
        if( $count6  == 0){
            $moy6 = 0;
        }
        else{
        $moy6 = $val6 / $count6 ; }


        $val7 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mercredi')   
                                                     ->where('mois', 7)
                                                     ->sum('valeur');
        $count7  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mercredi')   
                                                        ->where('mois', 7)
                                                        ->count('id');
        if($count7 == 0){
            $moy7 = 0;
        }  
        else{                                         
        $moy7 = $val7 / $count7 ;}


        $val8 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mercredi')   
                                                     ->where('mois', 8)
                                                     ->sum('valeur');
        $count8  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mercredi')   
                                                        ->where('mois', 8)
                                                        ->count('id');
        if( $count8  == 0)      {
            $moy8 = 0;
        }       
        else{                                  
        $moy8 = $val8 / $count8 ;}


        $val9= PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mercredi')   
                                                     ->where('mois', 9)
                                                     ->sum('valeur');
        $count9  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mercredi')   
                                                        ->where('mois', 9)
                                                        ->count('id');
        if($count9  == 0){
            $moy9 = 0;
        } 
        else{                                          
        $moy9= $val9 / $count9 ;}


        $val10 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mercredi')   
                                                     ->where('mois', 10)
                                                     ->sum('valeur');
        $count10  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mercredi')   
                                                        ->where('mois', 10)
                                                        ->count('id');
        if($count10 == 0){
            $moy10 = 0;
        }    
        else{                                   
        $moy10= $val10 / $count10 ;}


        $val11 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Mercredi')   
                                                     ->where('mois', 11)
                                                     ->sum('valeur');
        $count11  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Mercredi')   
                                                        ->where('mois', 11)
                                                        ->count('id');
        if($count11 == 0){
        $moy11 = 0;}    
        else{                                                
        $moy11= $val11 / $count11 ;}


        $val12 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                      ->where('id_emp',$request->id_emp)   
                                                      ->where('des_jour', 'Mercredi')   
                                                      ->where('mois', 12)
                                                      ->sum('valeur');
        $count12  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                         ->where('id_emp',$request->id_emp)   
                                                         ->where('des_jour', 'Mercredi')   
                                                         ->where('mois', 12)
                                                         ->count('id');
        if($count12 == 0){
        $moy12 = 0;}    
        else{                                                   
        $moy12 = $val12 / $count12 ;}

       
        $month1 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 1,
            'des_jour' => 'Mercredi',
            'valeur' => $moy1,
            'id_emp' =>$request->id_emp,
        ]);

        $month2 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 2,
            'des_jour' => 'Mercredi',
            'valeur' => $moy2,
            'id_emp' =>$request->id_emp,
        ]);

        $month3 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 3,
            'des_jour' => 'Mercredi',
            'valeur' => $moy3,
            'id_emp' =>$request->id_emp,
        ]);

        $month4 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 4,
            'des_jour' => 'Mercredi',
            'valeur' => $moy4,
            'id_emp' =>$request->id_emp,
        ]);

        $month5 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 5,
            'des_jour' => 'Mercredi',
            'valeur' => $moy5,
            'id_emp' =>$request->id_emp,
        ]);

        $month6 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 6,
            'des_jour' => 'Mercredi',
            'valeur' => $moy6,
            'id_emp' =>$request->id_emp,
        ]);

        $month7 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 7,
            'des_jour' => 'Mercredi',
            'valeur' => $moy7,
            'id_emp' =>$request->id_emp,
        ]);

        $month8 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 8,
            'des_jour' => 'Mercredi',
            'valeur' => $moy8,
            'id_emp' =>$request->id_emp,
        ]);

        $month9 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 9,
            'des_jour' => 'Mercredi',
            'valeur' => $moy9,
            'id_emp' =>$request->id_emp,
        ]);
        

        $month10 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 10,
            'des_jour' => 'Mercredi',
            'valeur' => $moy10,
            'id_emp' =>$request->id_emp,
        ]);

        $month11 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 11,
            'des_jour' => 'Mercredi',
            'valeur' => $moy11,
            'id_emp' =>$request->id_emp,
        ]);

        $month12 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 12,
            'des_jour' => 'Mercredi',
            'valeur' => $moy12,
            'id_emp' =>$request->id_emp,
        ]);
        

        $val=PonctJourMoy::select("valeur as val")
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Mercredi')   
        ->pluck('val');

    
        $months=PonctJourMoy::select(DB::raw("mois as month"))
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Mercredi')
        ->groupBy(DB::raw("mois"),DB::raw("annee"))
        ->pluck('month');

        $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index=>$month)
        {
            $data[$month-1]=$val[$index];
        }

        return response()->json($data);
        
    }





    public function findChartJourJeudi(Request $request)
    {   
        $countexist = PonctJourMoy::count('id');
        if($countexist !=0){
           PonctJourMoy::query()->delete();
        }

        $val1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Jeudi')   
                                                     ->where('mois', 1)
                                                     ->sum('valeur');
        $count1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Jeudi')   
                                                       ->where('mois', 1)
                                                       ->count('id');
        if($count1 == 0) {
            $moy1 = 0;
        }
        else{                                 
        $moy1= $val1/$count1;}


        $val2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Jeudi')   
                                                     ->where('mois', 2)
                                                     ->sum('valeur');
        $count2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Jeudi')   
                                                       ->where('mois', 2)
                                                       ->count('id');
        if($count2 == 0) {
        $moy2 = 0;}
        else{ 
        $moy2= $val2/$count2;}


        $val3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Jeudi')   
                                                     ->where('mois', 3)
                                                     ->sum('valeur');
        $count3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Jeudi')   
                                                       ->where('mois', 3)
                                                       ->count('id');
        if($count3 == 0)
        {$moy3 = 0;}
        else{
        $moy3= $val3/$count3;}


        $val4 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Jeudi')   
                                                     ->where('mois', 4)
                                                     ->sum('valeur');
        $count4  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Jeudi')   
                                                        ->where('mois', 4)
                                                        ->count('id');
        if($count4 == 0){
            $moy4 = 0;
        }
        else{
        $moy4 = $val4 /$count4 ;}
        

        $val5 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Jeudi')   
                                                     ->where('mois', 5)
                                                     ->sum('valeur');
        $count5  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Jeudi')   
                                                        ->where('mois', 5)     
                                                        ->count('id');
        if($count5 == 0){
            $moy5 = 0;
        }     
        else{                                      
        $moy5 = $val5 / $count5 ;}


        $val6 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Jeudi')   
                                                     ->where('mois', 6)
                                                     ->sum('valeur');
        $count6  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Jeudi')   
                                                        ->where('mois', 6)
                                                        ->count('id');
        if( $count6  == 0){
            $moy6 = 0;
        }
        else{
        $moy6 = $val6 / $count6 ; }


        $val7 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Jeudi')   
                                                     ->where('mois', 7)
                                                     ->sum('valeur');
        $count7  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Jeudi')   
                                                        ->where('mois', 7)
                                                        ->count('id');
        if($count7 == 0){
            $moy7 = 0;
        }  
        else{                                         
        $moy7 = $val7 / $count7 ;}


        $val8 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Jeudi')   
                                                     ->where('mois', 8)
                                                     ->sum('valeur');
        $count8  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Jeudi')   
                                                        ->where('mois', 8)
                                                        ->count('id');
        if( $count8  == 0)      {
            $moy8 = 0;
        }       
        else{                                  
        $moy8 = $val8 / $count8 ;}


        $val9= PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Jeudi')   
                                                     ->where('mois', 9)
                                                     ->sum('valeur');
        $count9  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Jeudi')   
                                                        ->where('mois', 9)
                                                        ->count('id');
        if($count9  == 0){
            $moy9 = 0;
        } 
        else{                                          
        $moy9= $val9 / $count9 ;}


        $val10 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Jeudi')   
                                                     ->where('mois', 10)
                                                     ->sum('valeur');
        $count10  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Jeudi')   
                                                        ->where('mois', 10)
                                                        ->count('id');
        if($count10 == 0){
            $moy10 = 0;
        }    
        else{                                   
        $moy10= $val10 / $count10 ;}


        $val11 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Jeudi')   
                                                     ->where('mois', 11)
                                                     ->sum('valeur');
        $count11  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Jeudi')   
                                                        ->where('mois', 11)
                                                        ->count('id');
        if($count11 == 0){
        $moy11 = 0;}    
        else{                                                
        $moy11= $val11 / $count11 ;}


        $val12 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                      ->where('id_emp',$request->id_emp)   
                                                      ->where('des_jour', 'Jeudi')   
                                                      ->where('mois', 12)
                                                      ->sum('valeur');
        $count12  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                         ->where('id_emp',$request->id_emp)   
                                                         ->where('des_jour', 'Jeudi')   
                                                         ->where('mois', 12)
                                                         ->count('id');
        if($count12 == 0){
        $moy12 = 0;}    
        else{                                                   
        $moy12 = $val12 / $count12 ;}

       
        $month1 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 1,
            'des_jour' => 'Jeudi',
            'valeur' => $moy1,
            'id_emp' =>$request->id_emp,
        ]);

        $month2 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 2,
            'des_jour' => 'Jeudi',
            'valeur' => $moy2,
            'id_emp' =>$request->id_emp,
        ]);

        $month3 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 3,
            'des_jour' => 'Jeudi',
            'valeur' => $moy3,
            'id_emp' =>$request->id_emp,
        ]);

        $month4 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 4,
            'des_jour' => 'Jeudi',
            'valeur' => $moy4,
            'id_emp' =>$request->id_emp,
        ]);

        $month5 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 5,
            'des_jour' => 'Jeudi',
            'valeur' => $moy5,
            'id_emp' =>$request->id_emp,
        ]);

        $month6 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 6,
            'des_jour' => 'Jeudi',
            'valeur' => $moy6,
            'id_emp' =>$request->id_emp,
        ]);

        $month7 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 7,
            'des_jour' => 'Jeudi',
            'valeur' => $moy7,
            'id_emp' =>$request->id_emp,
        ]);

        $month8 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 8,
            'des_jour' => 'Jeudi',
            'valeur' => $moy8,
            'id_emp' =>$request->id_emp,
        ]);

        $month9 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 9,
            'des_jour' => 'Jeudi',
            'valeur' => $moy9,
            'id_emp' =>$request->id_emp,
        ]);
        

        $month10 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 10,
            'des_jour' => 'Jeudi',
            'valeur' => $moy10,
            'id_emp' =>$request->id_emp,
        ]);

        $month11 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 11,
            'des_jour' => 'Jeudi',
            'valeur' => $moy11,
            'id_emp' =>$request->id_emp,
        ]);

        $month12 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 12,
            'des_jour' => 'Jeudi',
            'valeur' => $moy12,
            'id_emp' =>$request->id_emp,
        ]);
        

        $val=PonctJourMoy::select("valeur as val")
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Jeudi')   
        ->pluck('val');

    
        $months=PonctJourMoy::select(DB::raw("mois as month"))
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Jeudi')
        ->groupBy(DB::raw("mois"),DB::raw("annee"))
        ->pluck('month');

        $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index=>$month)
        {
            $data[$month-1]=$val[$index];
        }

        return response()->json($data);
        
    }




    public function findChartJourVend(Request $request)
    {   
        $countexist = PonctJourMoy::count('id');
        if($countexist !=0){
           PonctJourMoy::query()->delete();
        }

        $valVend1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Vendredi')   
                                                     ->where('mois', 1)
                                                     ->sum('valeur');
        $countVend1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Vendredi')   
                                                       ->where('mois', 1)
                                                       ->count('id');
        if($countVend1 == 0) {
            $moyVendredi1 = 0;
        }
        else{                                 
        $moyVendredi1= $valVend1/$countVend1;}


        $valVend2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Vendredi')   
                                                     ->where('mois', 2)
                                                     ->sum('valeur');
        $countVend2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Vendredi')   
                                                       ->where('mois', 2)
                                                       ->count('id');
        if($countVend2 == 0) {
        $moyVendredi2 = 0;}
        else{ 
        $moyVendredi2= $valVend2/$countVend2;}


        $valVend3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Vendredi')   
                                                     ->where('mois', 3)
                                                     ->sum('valeur');
        $countVend3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Vendredi')   
                                                       ->where('mois', 3)
                                                       ->count('id');
        if($countVend3 == 0)
        {$moyVendredi3 = 0;}
        else{
        $moyVendredi3= $valVend3/$countVend3;}


        $valVend4 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Vendredi')   
                                                     ->where('mois', 4)
                                                     ->sum('valeur');
        $countVend4  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Vendredi')   
                                                        ->where('mois', 4)
                                                        ->count('id');
        if($countVend4 == 0){
            $moyVendredi4 = 0;
        }
        else{
        $moyVendredi4 = $valVend4 /$countVend4 ;}
        

        $valVend5 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Vendredi')   
                                                     ->where('mois', 5)
                                                     ->sum('valeur');
        $countVend5  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Vendredi')   
                                                        ->where('mois', 5)     
                                                        ->count('id');
        if($countVend5 == 0){
            $moyVendredi5 = 0;
        }     
        else{                                      
        $moyVendredi5 = $valVend5 / $countVend5 ;}


        $valVend6 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Vendredi')   
                                                     ->where('mois', 6)
                                                     ->sum('valeur');
        $countVend6  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Vendredi')   
                                                        ->where('mois', 6)
                                                        ->count('id');
        if( $countVend6  == 0){
            $moyVendredi6 = 0;
        }
        else{
        $moyVendredi6 = $valVend6 / $countVend6 ; }


        $valVend7 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Vendredi')   
                                                     ->where('mois', 7)
                                                     ->sum('valeur');
        $countVend7  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Vendredi')   
                                                        ->where('mois', 7)
                                                        ->count('id');
        if($countVend7 == 0){
            $moyVendredi7 = 0;
        }  
        else{                                         
        $moyVendredi7 = $valVend7 / $countVend7 ;}


        $valVend8 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Vendredi')   
                                                     ->where('mois', 8)
                                                     ->sum('valeur');
        $countVend8  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Vendredi')   
                                                        ->where('mois', 8)
                                                        ->count('id');
        if( $countVend8  == 0)      {
            $moyVendredi8 = 0;
        }       
        else{                                  
        $moyVendredi8 = $valVend8 / $countVend8 ;}


        $valVend9= PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Vendredi')   
                                                     ->where('mois', 9)
                                                     ->sum('valeur');
        $countVend9  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Vendredi')   
                                                        ->where('mois', 9)
                                                        ->count('id');
        if($countVend9  == 0){
            $moyVendredi9 = 0;
        } 
        else{                                          
        $moyVendredi9= $valVend9 / $countVend9 ;}


        $valVend10 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Vendredi')   
                                                     ->where('mois', 10)
                                                     ->sum('valeur');
        $countVend10  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Vendredi')   
                                                        ->where('mois', 10)
                                                        ->count('id');
        if($countVend10 == 0){
            $moyVendredi10 = 0;
        }    
        else{                                   
        $moyVendredi10= $valVend10 / $countVend10 ;}


        $valVend11 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Vendredi')   
                                                     ->where('mois', 11)
                                                     ->sum('valeur');
        $countVend11  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Vendredi')   
                                                        ->where('mois', 11)
                                                        ->count('id');
        if($countVend11 == 0){
        $moyVendredi11 = 0;}    
        else{                                                
        $moyVendredi11= $valVend11 / $countVend11 ;}


        $valVend12 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                      ->where('id_emp',$request->id_emp)   
                                                      ->where('des_jour', 'Vendredi')   
                                                      ->where('mois', 12)
                                                      ->sum('valeur');
        $countVend12  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                         ->where('id_emp',$request->id_emp)   
                                                         ->where('des_jour', 'Vendredi')   
                                                         ->where('mois', 12)
                                                         ->count('id');
        if($countVend12 == 0){
        $moyVendredi12 = 0;}    
        else{                                                   
        $moyVendredi12 = $valVend12 / $countVend12 ;}

       
        $month1 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 1,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi1,
            'id_emp' =>$request->id_emp,
        ]);

        $month2 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 2,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi2,
            'id_emp' =>$request->id_emp,
        ]);

        $month3 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 3,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi3,
            'id_emp' =>$request->id_emp,
        ]);

        $month4 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 4,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi4,
            'id_emp' =>$request->id_emp,
        ]);

        $month5 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 5,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi5,
            'id_emp' =>$request->id_emp,
        ]);

        $month6 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 6,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi6,
            'id_emp' =>$request->id_emp,
        ]);

        $month7 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 7,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi7,
            'id_emp' =>$request->id_emp,
        ]);

        $month8 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 8,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi8,
            'id_emp' =>$request->id_emp,
        ]);

        $month9 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 9,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi9,
            'id_emp' =>$request->id_emp,
        ]);
        

        $month10 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 10,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi10,
            'id_emp' =>$request->id_emp,
        ]);

        $month11 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 11,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi11,
            'id_emp' =>$request->id_emp,
        ]);

        $month12 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 12,
            'des_jour' => 'Vendredi',
            'valeur' => $moyVendredi12,
            'id_emp' =>$request->id_emp,
        ]);
        

        $val=PonctJourMoy::select("valeur as val")
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Vendredi')   
        ->pluck('val');

    
        $months=PonctJourMoy::select(DB::raw("mois as month"))
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Vendredi')
        ->groupBy(DB::raw("mois"),DB::raw("annee"))
        ->pluck('month');

        $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index=>$month)
        {
            $data[$month-1]=$val[$index];
        }

        return response()->json($data);
        
    }







    public function findChartJourSamedi(Request $request)
    {   
        $countexist = PonctJourMoy::count('id');
        if($countexist !=0){
           PonctJourMoy::query()->delete();
        }

        $val1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Samedi')   
                                                     ->where('mois', 1)
                                                     ->sum('valeur');
        $count1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Samedi')   
                                                       ->where('mois', 1)
                                                       ->count('id');
        if($count1 == 0) {
            $moy1 = 0;
        }
        else{                                 
        $moy1= $val1/$count1;}


        $val2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Samedi')   
                                                     ->where('mois', 2)
                                                     ->sum('valeur');
        $count2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Samedi')   
                                                       ->where('mois', 2)
                                                       ->count('id');
        if($count2 == 0) {
        $moy2 = 0;}
        else{ 
        $moy2= $val2/$count2;}


        $val3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Samedi')   
                                                     ->where('mois', 3)
                                                     ->sum('valeur');
        $count3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Samedi')   
                                                       ->where('mois', 3)
                                                       ->count('id');
        if($count3 == 0)
        {$moy3 = 0;}
        else{
        $moy3= $val3/$count3;}


        $val4 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Samedi')   
                                                     ->where('mois', 4)
                                                     ->sum('valeur');
        $count4  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Samedi')   
                                                        ->where('mois', 4)
                                                        ->count('id');
        if($count4 == 0){
            $moy4 = 0;
        }
        else{
        $moy4 = $val4 /$count4 ;}
        

        $val5 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Samedi')   
                                                     ->where('mois', 5)
                                                     ->sum('valeur');
        $count5  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Samedi')   
                                                        ->where('mois', 5)     
                                                        ->count('id');
        if($count5 == 0){
            $moy5 = 0;
        }     
        else{                                      
        $moy5 = $val5 / $count5 ;}


        $val6 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Samedi')   
                                                     ->where('mois', 6)
                                                     ->sum('valeur');
        $count6  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Samedi')   
                                                        ->where('mois', 6)
                                                        ->count('id');
        if( $count6  == 0){
            $moy6 = 0;
        }
        else{
        $moy6 = $val6 / $count6 ; }


        $val7 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Samedi')   
                                                     ->where('mois', 7)
                                                     ->sum('valeur');
        $count7  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Samedi')   
                                                        ->where('mois', 7)
                                                        ->count('id');
        if($count7 == 0){
            $moy7 = 0;
        }  
        else{                                         
        $moy7 = $val7 / $count7 ;}


        $val8 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Samedi')   
                                                     ->where('mois', 8)
                                                     ->sum('valeur');
        $count8  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Samedi')   
                                                        ->where('mois', 8)
                                                        ->count('id');
        if( $count8  == 0)      {
            $moy8 = 0;
        }       
        else{                                  
        $moy8 = $val8 / $count8 ;}


        $val9= PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Samedi')   
                                                     ->where('mois', 9)
                                                     ->sum('valeur');
        $count9  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Samedi')   
                                                        ->where('mois', 9)
                                                        ->count('id');
        if($count9  == 0){
            $moy9 = 0;
        } 
        else{                                          
        $moy9= $val9 / $count9 ;}


        $val10 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Samedi')   
                                                     ->where('mois', 10)
                                                     ->sum('valeur');
        $count10  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Samedi')   
                                                        ->where('mois', 10)
                                                        ->count('id');
        if($count10 == 0){
            $moy10 = 0;
        }    
        else{                                   
        $moy10= $val10 / $count10 ;}


        $val11 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Samedi')   
                                                     ->where('mois', 11)
                                                     ->sum('valeur');
        $count11  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Samedi')   
                                                        ->where('mois', 11)
                                                        ->count('id');
        if($count11 == 0){
        $moy11 = 0;}    
        else{                                                
        $moy11= $val11 / $count11 ;}


        $val12 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                      ->where('id_emp',$request->id_emp)   
                                                      ->where('des_jour', 'Samedi')   
                                                      ->where('mois', 12)
                                                      ->sum('valeur');
        $count12  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                         ->where('id_emp',$request->id_emp)   
                                                         ->where('des_jour', 'Samedi')   
                                                         ->where('mois', 12)
                                                         ->count('id');
        if($count12 == 0){
        $moy12 = 0;}    
        else{                                                   
        $moy12 = $val12 / $count12 ;}

       
        $month1 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 1,
            'des_jour' => 'Samedi',
            'valeur' => $moy1,
            'id_emp' =>$request->id_emp,
        ]);

        $month2 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 2,
            'des_jour' => 'Samedi',
            'valeur' => $moy2,
            'id_emp' =>$request->id_emp,
        ]);

        $month3 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 3,
            'des_jour' => 'Samedi',
            'valeur' => $moy3,
            'id_emp' =>$request->id_emp,
        ]);

        $month4 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 4,
            'des_jour' => 'Samedi',
            'valeur' => $moy4,
            'id_emp' =>$request->id_emp,
        ]);

        $month5 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 5,
            'des_jour' => 'Samedi',
            'valeur' => $moy5,
            'id_emp' =>$request->id_emp,
        ]);

        $month6 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 6,
            'des_jour' => 'Samedi',
            'valeur' => $moy6,
            'id_emp' =>$request->id_emp,
        ]);

        $month7 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 7,
            'des_jour' => 'Samedi',
            'valeur' => $moy7,
            'id_emp' =>$request->id_emp,
        ]);

        $month8 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 8,
            'des_jour' => 'Samedi',
            'valeur' => $moy8,
            'id_emp' =>$request->id_emp,
        ]);

        $month9 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 9,
            'des_jour' => 'Samedi',
            'valeur' => $moy9,
            'id_emp' =>$request->id_emp,
        ]);
        

        $month10 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 10,
            'des_jour' => 'Samedi',
            'valeur' => $moy10,
            'id_emp' =>$request->id_emp,
        ]);

        $month11 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 11,
            'des_jour' => 'Samedi',
            'valeur' => $moy11,
            'id_emp' =>$request->id_emp,
        ]);

        $month12 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 12,
            'des_jour' => 'Samedi',
            'valeur' => $moy12,
            'id_emp' =>$request->id_emp,
        ]);
        

        $val=PonctJourMoy::select("valeur as val")
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Samedi')   
        ->pluck('val');

    
        $months=PonctJourMoy::select(DB::raw("mois as month"))
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Samedi')
        ->groupBy(DB::raw("mois"),DB::raw("annee"))
        ->pluck('month');

        $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index=>$month)
        {
            $data[$month-1]=$val[$index];
        }

        return response()->json($data);
        
    }


    


    public function findChartJourDimanche(Request $request)
    {   
        $countexist = PonctJourMoy::count('id');
        if($countexist !=0){
           PonctJourMoy::query()->delete();
        }

        $val1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Dimanche')   
                                                     ->where('mois', 1)
                                                     ->sum('valeur');
        $count1 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Dimanche')   
                                                       ->where('mois', 1)
                                                       ->count('id');
        if($count1 == 0) {
            $moy1 = 0;
        }
        else{                                 
        $moy1= $val1/$count1;}


        $val2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Dimanche')   
                                                     ->where('mois', 2)
                                                     ->sum('valeur');
        $count2 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Dimanche')   
                                                       ->where('mois', 2)
                                                       ->count('id');
        if($count2 == 0) {
        $moy2 = 0;}
        else{ 
        $moy2= $val2/$count2;}


        $val3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Dimanche')   
                                                     ->where('mois', 3)
                                                     ->sum('valeur');
        $count3 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                       ->where('id_emp',$request->id_emp)   
                                                       ->where('des_jour', 'Dimanche')   
                                                       ->where('mois', 3)
                                                       ->count('id');
        if($count3 == 0)
        {$moy3 = 0;}
        else{
        $moy3= $val3/$count3;}


        $val4 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Dimanche')   
                                                     ->where('mois', 4)
                                                     ->sum('valeur');
        $count4  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Dimanche')   
                                                        ->where('mois', 4)
                                                        ->count('id');
        if($count4 == 0){
            $moy4 = 0;
        }
        else{
        $moy4 = $val4 /$count4 ;}
        

        $val5 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Dimanche')   
                                                     ->where('mois', 5)
                                                     ->sum('valeur');
        $count5  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Dimanche')   
                                                        ->where('mois', 5)     
                                                        ->count('id');
        if($count5 == 0){
            $moy5 = 0;
        }     
        else{                                      
        $moy5 = $val5 / $count5 ;}


        $val6 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Dimanche')   
                                                     ->where('mois', 6)
                                                     ->sum('valeur');
        $count6  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Dimanche')   
                                                        ->where('mois', 6)
                                                        ->count('id');
        if( $count6  == 0){
            $moy6 = 0;
        }
        else{
        $moy6 = $val6 / $count6 ; }


        $val7 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Dimanche')   
                                                     ->where('mois', 7)
                                                     ->sum('valeur');
        $count7  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Dimanche')   
                                                        ->where('mois', 7)
                                                        ->count('id');
        if($count7 == 0){
            $moy7 = 0;
        }  
        else{                                         
        $moy7 = $val7 / $count7 ;}


        $val8 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Dimanche')   
                                                     ->where('mois', 8)
                                                     ->sum('valeur');
        $count8  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Dimanche')   
                                                        ->where('mois', 8)
                                                        ->count('id');
        if( $count8  == 0)      {
            $moy8 = 0;
        }       
        else{                                  
        $moy8 = $val8 / $count8 ;}


        $val9= PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Dimanche')   
                                                     ->where('mois', 9)
                                                     ->sum('valeur');
        $count9  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Dimanche')   
                                                        ->where('mois', 9)
                                                        ->count('id');
        if($count9  == 0){
            $moy9 = 0;
        } 
        else{                                          
        $moy9= $val9 / $count9 ;}


        $val10 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Dimanche')   
                                                     ->where('mois', 10)
                                                     ->sum('valeur');
        $count10  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Dimanche')   
                                                        ->where('mois', 10)
                                                        ->count('id');
        if($count10 == 0){
            $moy10 = 0;
        }    
        else{                                   
        $moy10= $val10 / $count10 ;}


        $val11 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                     ->where('id_emp',$request->id_emp)   
                                                     ->where('des_jour', 'Dimanche')   
                                                     ->where('mois', 11)
                                                     ->sum('valeur');
        $count11  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                        ->where('id_emp',$request->id_emp)   
                                                        ->where('des_jour', 'Dimanche')   
                                                        ->where('mois', 11)
                                                        ->count('id');
        if($count11 == 0){
        $moy11 = 0;}    
        else{                                                
        $moy11= $val11 / $count11 ;}


        $val12 = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                      ->where('id_emp',$request->id_emp)   
                                                      ->where('des_jour', 'Dimanche')   
                                                      ->where('mois', 12)
                                                      ->sum('valeur');
        $count12  = PonctualitePersonnelleJournaliere::where('annee',$request->annee)
                                                         ->where('id_emp',$request->id_emp)   
                                                         ->where('des_jour', 'Dimanche')   
                                                         ->where('mois', 12)
                                                         ->count('id');
        if($count12 == 0){
        $moy12 = 0;}    
        else{                                                   
        $moy12 = $val12 / $count12 ;}

       
        $month1 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 1,
            'des_jour' => 'Dimanche',
            'valeur' => $moy1,
            'id_emp' =>$request->id_emp,
        ]);

        $month2 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 2,
            'des_jour' => 'Dimanche',
            'valeur' => $moy2,
            'id_emp' =>$request->id_emp,
        ]);

        $month3 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 3,
            'des_jour' => 'Dimanche',
            'valeur' => $moy3,
            'id_emp' =>$request->id_emp,
        ]);

        $month4 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 4,
            'des_jour' => 'Dimanche',
            'valeur' => $moy4,
            'id_emp' =>$request->id_emp,
        ]);

        $month5 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 5,
            'des_jour' => 'Dimanche',
            'valeur' => $moy5,
            'id_emp' =>$request->id_emp,
        ]);

        $month6 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 6,
            'des_jour' => 'Dimanche',
            'valeur' => $moy6,
            'id_emp' =>$request->id_emp,
        ]);

        $month7 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 7,
            'des_jour' => 'Dimanche',
            'valeur' => $moy7,
            'id_emp' =>$request->id_emp,
        ]);

        $month8 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 8,
            'des_jour' => 'Dimanche',
            'valeur' => $moy8,
            'id_emp' =>$request->id_emp,
        ]);

        $month9 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 9,
            'des_jour' => 'Dimanche',
            'valeur' => $moy9,
            'id_emp' =>$request->id_emp,
        ]);
        

        $month10 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 10,
            'des_jour' => 'Dimanche',
            'valeur' => $moy10,
            'id_emp' =>$request->id_emp,
        ]);

        $month11 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 11,
            'des_jour' => 'Dimanche',
            'valeur' => $moy11,
            'id_emp' =>$request->id_emp,
        ]);

        $month12 = PonctJourMoy::create([
            'annee'=>$request->annee,
            'mois' => 12,
            'des_jour' => 'Dimanche',
            'valeur' => $moy12,
            'id_emp' =>$request->id_emp,
        ]);
        

        $val=PonctJourMoy::select("valeur as val")
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Dimanche')   
        ->pluck('val');

    
        $months=PonctJourMoy::select(DB::raw("mois as month"))
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->where('des_jour', 'Dimanche')
        ->groupBy(DB::raw("mois"),DB::raw("annee"))
        ->pluck('month');

        $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index=>$month)
        {
            $data[$month-1]=$val[$index];
        }

        return response()->json($data);
        
    }







    public function PonctualitePersonnelleAnnuelleCrud(Request $request){
        $ponctAnn = PonctualitePersonnelleAnnuelle::all();  
        $employes = Employe::all();                     
        return view("PonctualitePersonnelleAnnuelleCrud", compact("employes", "ponctAnn"));
    }
    
    public function PonctualitePersonnelleTotalCrud(Request $request){
        $ponctTot = PonctualitePersonnelleTotal::all();  
        $employes = Employe::all();                     
        return view("PonctualitePersonnelleTotalCrud", compact("employes", "ponctTot"));
    }

    public function PonctualitePersonnelleJournaliereCrud(Request $request){
        $ponctJour = PonctualitePersonnelleJournaliere::all();  
        $employes = Employe::all();                     
        return view("PonctualitePersonnelleJournaliereCrud", compact("employes", "ponctJour"));
    }
}