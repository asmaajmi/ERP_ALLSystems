<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\CongePlanifie;
use App\Models\JourAEffectuer;
use App\Models\CongeNonPlanifie;
use App\Models\PointageEffectue;
use App\Models\PointageAEffectuer;
use Illuminate\Support\Facades\DB;
use App\Models\ProbabiliteMensuelle;
use App\Models\ProbabiliteCongeTotal;
use App\Models\ProbabiliteCongeAnnuelle;
use App\Models\ProbabilitePresenceTotal;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ProbabiliteCongeMensuelle;
use App\Models\ProbabilitePresenceAnnuelle;
use App\Models\ProbabilitePresenceMensuelle;

class ProbabiliteController extends Controller
{
    public function ProbabiliteForm(){
        $services=Service::all();
        $annees=PointageEffectue::select('annee')->distinct()->get();
        return view('Probabilite',compact("services","annees"));
    }

    public function CalculerProbMensuelle(Request $request){

        // try{
        $type=$request->input('type_probabilite');
        $annee=$request->input('annee_mensuelle');
        $mois=$request->input('mois_mensuelle');
        $id_employe=$request->input('id_employe');


        $jourseff=PointageEffectue::select('datepe','id','id_emp','annee','mois')
                                     ->where('id_emp','=',$id_employe)
                                     ->where('annee','=',$annee)
                                     ->where('mois','=',$mois)
                                     ->count();
      

        $pointageaeff=PointageAEffectuer::select('id')
                    ->where('id_emp',$id_employe)
                    ->where('annee','=',$annee)
                    ->where('mois','=',$mois)
                    ->get();
                    
        
        //echo("nbree des jours eff  ");
        //echo($jourseff);
        //echo("<br>");
    
        //foreach ($pointageaeff as $pointA)
        //{
        //    $joursaeff=JourAEffectuer::select('id','heure_sortie_j','heure_entree_j')
        //    ->where('num_seq_pa',$pointA->id)->where('heure_sortie_j','!=',null)
        //    ->where('heure_entree_j','!=',null)->count();
        //}
        //echo("nbree des jours a eff  ");
        //echo($joursaeff);
        //echo("<br>");

        $congeplanifie=CongePlanifie::select('date_debut_conge','date_fin_conge','mois','annee','mois_fin','nbre_jours_payés','nbre_jours_nonpayés')
                                    ->where('id_emp','=',$id_employe)
                                    ->where('annee','=',$annee)
                                    ->where('mois','=',$mois)
                                    ->get();

        
        $congenonplanifie=CongeNonPlanifie::select('date_debut_conge','date_fin_conge','mois','annee','nbre_jours_payés','nbre_jours_nonpayés')
                                    ->where('id_emp','=',$id_employe)
                                    ->where('annee','=',$annee)
                                    ->where('mois','=',$mois)
                                    ->get();
        
        function dateDifference($x , $y , $differenceFormat = '%a' )
        {

        $datetime1 = date_create($x);
        $datetime2 = date_create($y);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);

        }


        $nbre_jours_conges=0;
        $nbre=0;
        $nbre_jours=0;
       
        $nbre_jours_conges_np=0;
        $nbre_np=0;
        $nbre_jours_np=0;

        $x=DB::table('conge_planifies')
        ->select('jour_conge_autre_mois')
        ->where('id_emp',$id_employe)
        ->where('annee',$annee)
        ->where('mois_fin',$mois)
        ->where('mois','!=',$mois)
        ->get();
        
        foreach($x as $y)
            {
                $nbre_jours_conges+=$y->jour_conge_autre_mois;
            }
        
        foreach($congeplanifie as $item)
        {   
            $dt_deb_conge=$item->date_debut_conge;
            $dt_fin_conge=$item->date_fin_conge;
            $jours=$item->nbre_jours_nonpayés+$item->nbre_jours_payés;
            $mois_fin=Carbon::createFromFormat('Y-m-d', $dt_fin_conge)->format('m');
       
            if($item->mois == $mois_fin)
            {   
               
                $nbre_jours_conges+=$jours;

            }

            if($item->mois != $mois_fin)
            {   
                $lastDayofMonth = Carbon::createFromFormat('Y-m-d', $item->date_debut_conge)->endOfMonth()->toDateString();
                $lastDay = Carbon::createFromFormat('Y-m-d', $item->date_debut_conge)->endOfMonth()->format('d');
                $DayofMonth = Carbon::createFromFormat('Y-m-d', $item->date_debut_conge)->format('d');
                $nbre=$lastDay-$DayofMonth;
                $nbre_jours+=dateDifference($lastDayofMonth , $dt_fin_conge , $differenceFormat = '%a' );
                $nbre_jours_conges+=$nbre;
                DB::table('conge_planifies')
                ->where('id_emp',$id_employe)
                ->where('annee',$annee)
                ->where('mois',$mois)
                ->where('mois_fin','!=',$mois)
                ->update(['jour_conge_autre_mois'=>$nbre_jours]);

        

            }
            
        }
        
        $x=DB::table('conge_non_planifies')
        ->select('jour_conge_autre_mois')
        ->where('id_emp',$id_employe)
        ->where('annee',$annee)
        ->where('mois_fin',$mois)
        ->where('mois','!=',$mois)
        ->get();
      
        foreach($x as $y)
            {
                $nbre_jours_conges_np+=$y->jour_conge_autre_mois;
            }

        foreach($congenonplanifie as $item)
        {   
            $dt_deb_conge=$item->date_debut_conge;
            $dt_fin_conge=$item->date_fin_conge;
            $jours_np=$item->nbre_jours_nonpayés+$item->nbre_jours_payés;
            $mois_fin_np=Carbon::createFromFormat('Y-m-d', $dt_fin_conge)->format('m');
            if($item->mois == $mois_fin_np)
            {   
               
                $nbre_jours_conges_np+=$jours_np;

            }

            if($item->mois != $mois_fin_np)
            {   
                $lastDayofMonth = Carbon::createFromFormat('Y-m-d', $item->date_debut_conge)->endOfMonth()->toDateString();
                $lastDay = Carbon::createFromFormat('Y-m-d', $item->date_debut_conge)->endOfMonth()->format('d');
                $DayofMonth = Carbon::createFromFormat('Y-m-d', $item->date_debut_conge)->format('d');
                $nbre_np=$lastDay-$DayofMonth;
                $nbre_jours_np+=dateDifference($lastDayofMonth , $dt_fin_conge , $differenceFormat = '%a' );
                $nbre_jours_conges_np+=$nbre_np;
                DB::table('conge_non_planifies')
                ->where('id_emp',$id_employe)
                ->where('annee',$annee)
                ->where('mois',$mois)
                ->where('mois_fin','!=',$mois)
                ->update(['jour_conge_autre_mois'=>$nbre_jours_np]);

        

            }
        

        }
   
       
            
        if($type =="Présence"){

            $nbreProbPresMensuellePourEmpX=ProbabilitePresenceMensuelle::select('id')
                                            ->where('id_emp',$id_employe)
                                            ->where('mois',$mois)
                                            ->where('annee',$annee)
                                            ->count();

            $somme=0;
            $somme+=$jourseff/($jourseff+($nbre_jours_conges+$nbre_jours_conges_np));

            if($nbreProbPresMensuellePourEmpX != 0)
            {
                $ProbPresenceMensuelle = ProbabilitePresenceMensuelle::where('id_emp',$id_employe)
                ->where('mois',$mois)
                ->where('annee',$annee)
                ->update(['valeur'=>$somme]);
            }
            else
            {
                $ProbPresenceMensuelle = ProbabilitePresenceMensuelle::create([
                    'annee'=>$annee,
                    'mois'=>$mois,
                    'id_emp'=>$id_employe,
                    'valeur'=>$somme
                ]);

            }
           
            Alert::success('Succés', 'Calcul effectuée avec succès !'); 
            $services=Service::all();
            $annees=PointageEffectue::select('annee')->distinct()->get();
            return view('Probabilite',compact("services","annees"));
        }

        if($type =="Congé"){
           
            $nbreProbCongeMensuellePourEmpX=ProbabiliteCongeMensuelle::select('id')
                                            ->where('id_emp',$id_employe)
                                            ->where('mois',$mois)
                                            ->where('annee',$annee)
                                            ->count(); 


            $somme1=0;
            $somme1+=$nbre_jours_conges/($jourseff+($nbre_jours_conges+$nbre_jours_conges_np));

            if($nbreProbCongeMensuellePourEmpX != 0)
            {
                $ProbCongeMensuelle = ProbabiliteCongeMensuelle::where('id_emp',$id_employe)
                ->where('mois',$mois)
                ->where('annee',$annee)
                ->update(['valeur'=>$somme1]);
            }
            else
            {
                $ProbCongeMensuelle = ProbabiliteCongeMensuelle::create([
                    'annee'=>$annee,
                    'mois'=>$mois,
                    'id_emp'=>$id_employe,
                    'valeur'=>$somme1
                ]);

            }
            
            Alert::success('Succés', 'Calcul effectuée avec succès !'); 
            $services=Service::all();
            $annees=PointageEffectue::select('annee')->distinct()->get();
            return view('Probabilite',compact("services","annees"));
        
           
        }
    // }
    // catch (\Exception $e){
       
    //     Alert::error('Erreur', 'Erreur lors de la création  !');
    //             return back();   }
    }

    public function CalculerProbAnnuelle(Request $request){
        try{

            $type=$request->input('type_probabilite_ann');
            $annee=$request->input('Annee_annuelle');
            $id_employe=$request->input('id_employe_ann');


            $probPresenceMensuelle=ProbabilitePresenceMensuelle::select('id_emp','valeur','mois')
            ->where('annee',$annee)
            ->where('id_emp',$id_employe)
            ->get();
            
            $NbremoisTravail=ProbabilitePresenceMensuelle::select('id_emp','annee','mois')
            ->where('annee',$annee)
            ->where('id_emp',$id_employe)
            ->count();
        
            $probCongeMensuelle=ProbabiliteCongeMensuelle::select('id_emp','valeur','mois')
            ->where('annee',$annee)
            ->where('id_emp',$id_employe)
            ->get();
            
            $NbremoisTravailConge=ProbabiliteCongeMensuelle::select('id_emp','annee','mois')
            ->where('annee',$annee)
            ->where('id_emp',$id_employe)
            ->count();

            $nbre_valeurs_prob_presence=0;
            
            $probPresenceAnnuelle=0;
        
            foreach($probPresenceMensuelle as $item)
            {   
            
                $nbre_valeurs_prob_presence+=$item->valeur;
            
            }
            
            if($NbremoisTravail == 0)
            {
                $probPresenceAnnuelle=$nbre_valeurs_prob_presence;
            }
            else
            {
                $probPresenceAnnuelle=$nbre_valeurs_prob_presence/$NbremoisTravail;
            }

                
            $nbre_valeurs_prob_conge=0;
            
            $probCongeAnnuelle=0;
        
            foreach($probCongeMensuelle as $item)
            {   
            
                $nbre_valeurs_prob_conge+=$item->valeur;
            
            }
            if($NbremoisTravailConge == 0)
            {
                $probCongeAnnuelle=$nbre_valeurs_prob_conge;
            }
            else
            {       
                $probCongeAnnuelle=$nbre_valeurs_prob_conge/$NbremoisTravailConge;
            }
            if($type =="Présence"){

                $nbreProbPresAnnuellePourEmpX=ProbabilitePresenceAnnuelle::select('id')
                                                ->where('id_emp',$id_employe)
                                                ->where('annee',$annee)
                                                ->count();


                if($nbreProbPresAnnuellePourEmpX != 0)
                {
                    $ProbPresenceAnn = ProbabilitePresenceAnnuelle::where('id_emp',$id_employe)
                    ->where('annee',$annee)
                    ->update(['valeur'=>$probPresenceAnnuelle]);
                }
                else
                {
                    $ProbPresenceAnn= ProbabilitePresenceAnnuelle::create([
                        'annee'=>$annee,
                        'id_emp'=>$id_employe,
                        'valeur'=>$probPresenceAnnuelle
                    ]);

                }
                Alert::success('Succés', 'Calcul effectuée avec succès !'); 
                $services=Service::all();
                $annees=PointageEffectue::select('annee')->distinct()->get();
                return view('Probabilite',compact("services","annees"));
            
            }

            if($type =="Congé"){
            
                $nbreProbCongeAnnuellePourEmpX=ProbabiliteCongeAnnuelle::select('id')
                                                ->where('id_emp',$id_employe)
                                                ->where('annee',$annee)
                                                ->count(); 


                

                if($nbreProbCongeAnnuellePourEmpX != 0)
                {
                    $ProbCongeAnn = ProbabiliteCongeAnnuelle::where('id_emp',$id_employe)
                    ->where('annee',$annee)
                    ->update(['valeur'=>$probCongeAnnuelle]);
                }
                else
                {
                    $ProbCongeAnn = ProbabiliteCongeAnnuelle::create([
                        'annee'=>$annee,
                        'id_emp'=>$id_employe,
                        'valeur'=>$probCongeAnnuelle
                    ]);

                }
                
                Alert::success('Succés', 'Calcul effectuée avec succès !'); 
                $services=Service::all();
                $annees=PointageEffectue::select('annee')->distinct()->get();
                return view('Probabilite',compact("services","annees"));
        
           
            }
        
        }
        catch (\Exception $e)
        {
       
            Alert::error('Erreur', 'Erreur lors de la création  !');
                    return back();   
        }
    
    }

    public function CalculerProbTotal(Request $request){
        try{

            $type=$request->input('type_probabilite_tot');
            $id_employe=$request->input('id_employe_tot');


            $probPresenceAnnuelle=ProbabilitePresenceAnnuelle::select('id_emp','valeur','annee')
            ->where('id_emp',$id_employe)
            ->get();
            
            $NbreanneeTravail=ProbabilitePresenceAnnuelle::select('id_emp','annee','annee')
            ->where('id_emp',$id_employe)
            ->count();
        
            $probCongeAnnuelle=ProbabiliteCongeAnnuelle::select('id_emp','valeur','annee')
            ->where('id_emp',$id_employe)
            ->get();
            
            $NbreanneeTravailConge=ProbabiliteCongeAnnuelle::select('id_emp','annee','annee')
            ->where('id_emp',$id_employe)
            ->count();

            $nbre_valeurs_prob_presence=0;
            
            $probPresenceTotal=0;
        
            foreach($probPresenceAnnuelle as $item)
            {   
            
                $nbre_valeurs_prob_presence+=$item->valeur;
            
            }
            
            if($NbreanneeTravail == 0)
            {
                $probPresenceTotal=$nbre_valeurs_prob_presence;
            }
            else
            {
                $probPresenceTotal=$nbre_valeurs_prob_presence/$NbreanneeTravail;
            }

                
            $nbre_valeurs_prob_conge=0;
            
            $probCongeTotal=0;
        
            foreach($probCongeAnnuelle as $item)
            {   
            
                $nbre_valeurs_prob_conge+=$item->valeur;
            
            }
            if($NbreanneeTravailConge == 0)
            {
                $probCongeTotal=$nbre_valeurs_prob_conge;
            }
            else
            {       
                $probCongeTotal=$nbre_valeurs_prob_conge/$NbreanneeTravailConge;
            }
            if($type =="Présence"){

                $nbreProbPresTotalePourEmpX=ProbabilitePresenceTotal::select('id')
                                                ->where('id_emp',$id_employe)
                                                ->count();


                if($nbreProbPresTotalePourEmpX != 0)
                {
                    $ProbPresenceTot = ProbabilitePresenceTotal::where('id_emp',$id_employe)
                    ->update(['Total'=>$probPresenceTotal]);
                }
                else
                {
                    $ProbPresenceTot= ProbabilitePresenceTotal::create([
                        'id_emp'=>$id_employe,
                        'Total'=>$probPresenceTotal
                    ]);

                }
                Alert::success('Succés', 'Calcul effectuée avec succès !'); 
                $services=Service::all();
                $annees=PointageEffectue::select('annee')->distinct()->get();
                return view('Probabilite',compact("services","annees"));
            
            }

            if($type =="Congé"){
            
                $nbreProbCongeTotalPourEmpX=ProbabiliteCongeTotal::select('id')
                                                ->where('id_emp',$id_employe)
                                                ->count(); 


                

                if($nbreProbCongeTotalPourEmpX != 0)
                {
                    $ProbCongeTotal = ProbabiliteCongeTotal::where('id_emp',$id_employe)
                    ->update(['Total'=>$probCongeTotal]);
                }
                else
                {
                    $ProbCongeTotal = ProbabiliteCongeTotal::create([
                        'id_emp'=>$id_employe,
                        'Total'=>$probCongeTotal
                    ]);

                }
                
                Alert::success('Succés', 'Calcul effectuée avec succès !'); 
                $services=Service::all();
                $annees=PointageEffectue::select('annee')->distinct()->get();
                return view('Probabilite',compact("services","annees"));
        
           
            }
        
        }
        catch (\Exception $e)
        {
       
            Alert::error('Erreur', 'Erreur lors de la création  !');
                    return back();   
        }
    
    }

    public function ProbPresenceCongeMensuelleAffiche(Request $request)
    {
       $probPresence=ProbabilitePresenceMensuelle::all();
       $probconge=ProbabiliteCongeMensuelle::all();
        return view("affichageProbMens",compact("probPresence","probconge"));
        
    }

    public function ProbPresenceCongeAnnuelleAffiche(Request $request)
    {
       $probPresence=ProbabilitePresenceAnnuelle::all();
       $probconge=ProbabiliteCongeAnnuelle::all();
        return view("affichageProbAnnuelle",compact("probPresence","probconge"));
        
    }

    public function ProbPresenceCongeTotalAffiche(Request $request)
    {
       $probPresence=ProbabilitePresenceTotal::all();
       $probconge=ProbabiliteCongeTotal::all();
        return view("affichageProbTotal",compact("probPresence","probconge"));
        
    }

   

}
