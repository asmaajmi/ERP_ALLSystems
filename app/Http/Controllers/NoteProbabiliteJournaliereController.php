<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\DateAEffectuer;
use App\Models\DifferenceJour;
use App\Models\JourAEffectuer;
use App\Models\PointageEffectue;
use App\Models\PointageAEffectuer;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\DifferenceJourProba;
use App\Models\NoteProbabiliteJournaliere;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ProbabilitePresenceMensuelle;
use App\Models\PonctualitePersonnelleJournaliere;

class NoteProbabiliteJournaliereController extends Controller{
    public function calculerNoteProbJournaliere(Request $request){
        $c1 = $request->input('c1');
        $c2 = $request->input('c2');
        $c3 = $request->input('c3');
        $annee=$request->input('annee_probJour');       
        $mois=$request->input('mois_probJour'); 
        $jourdes = $request->input('desj_probJour');
        $id_employe=$request->input('id_employe_jour');

        if($id_employe == null){
            Alert::error('Erreur', "La sélection d'un employé est obligatoire");
            return back();}


        if($c1 == null && $c2 == null && $c3==null){
            Alert::error('Erreur', "La sélection de C1, C2 et C3 est obligatoire");
            return back();}

        else if($c1 == null){
            Alert::error('Erreur', "La sélection de C1 est obligatoire");
            return back();}

        else if($c2 == null){
            Alert::error('Erreur', "La sélection de C2 est obligatoire");
            return back();}

        else if($c3 == null){
            Alert::error('Erreur', "La sélection de C3 est obligatoire");
            return back();}

        else if($annee == null && $mois == null && $jourdes == null){
            Alert::error('Erreur', "La sélection d'année et du mois et du jour est obligatoire");
            return back();}

        else if($annee == null && $mois == null){
            Alert::error('Erreur', "La sélection d'année et du mois est obligatoire");
            return back();}

        else if($annee == null && $jourdes == null){
            Alert::error('Erreur', "La sélection d'année et du jour est obligatoire");
            return back();}

        else if($mois == null && $jourdes == null){
            Alert::error('Erreur', "La sélection du mois et du jour est obligatoire");
            return back();}

        else if($annee == null){
            Alert::error('Erreur', "La sélection d'année est obligatoire");
            return back();}

        else if($mois == null){
            Alert::error('Erreur', "La sélection du mois est obligatoire");
            return back();}

        else if($jourdes == null){
            Alert::error('Erreur', "La sélection du jour est obligatoire");
            return back();}



        // verifier si la note est calcule déjà si c'est le cas en efface la ligne qui existe dans la table déjà
        $count = DB::table('note_probabilite_journalieres')->where('id_emp',$id_employe)
                                                           ->where('annee',$annee)
                                                           ->where('mois',$mois)
                                                           ->where('jour',$jourdes)
        ->count(DB::raw('id'));

        if($count>0){
        NoteProbabiliteJournaliere::where('id_emp',$id_employe)
                                    ->where('annee',$annee)
                                    ->where('mois',$mois)
                                    ->where('jour',$jourdes)
                                    ->delete();}
        // fin de verification







    // Début de calcul pour ponctualité journaliere
        $countd= PointageAEffectuer::where('id_emp', $id_employe)
        ->count();

        echo($countd);
        echo('<br>');


        if($countd != 0){
            $dateselect= DB::table('date_a_effectuers')
                ->join('pointage_a_effectuers', 'date_a_effectuers.id_pointaeff', '=', 'pointage_a_effectuers.id')
                ->where('pointage_a_effectuers.id_emp', '=', $id_employe)
                ->where('date_a_effectuers.annee','=',$annee)
                ->where('date_a_effectuers.mois','=',$mois)
                ->where('date_a_effectuers.des_j','=',$jourdes)
                ->select('date_a_effectuers.id_pointaeff')
                ->distinct()
                ->get();

            $datenb = $dateselect->count();
            echo($datenb);
        echo('<br>');
        if($datenb == 0){
                $valeurPonctJour = 0;}
        else{
            $pointageeff=PointageEffectue::select('heure_entree','heure_sortie','id','id_emp','annee','mois','num_j','des_j')
                                         ->where('id_emp','=',$id_employe)
                                         ->where('annee','=',$annee)
                                         ->where('mois','=',$mois)
                                         ->where('des_j',$jourdes)
                                         ->get();

            echo($pointageeff);
            echo('<br>');
            $nbrehreff=0;
            $minuteeff=0;
            foreach($pointageeff as $item){
            $heuredeb = $item->heure_entree;
            $heuresort = $item->heure_sortie;
                                             
            $start_time = $heuredeb;
            $end_time = $heuresort;
                             
            $time1 = new DateTime($start_time);
            $time2 = new DateTime($end_time);
            $interval = $time1->diff($time2);
                             
            $hour = $interval->format('%h');
            $nbrehreff+=$hour;
                                          
            $min = $interval->format('%i');
            $minuteeff+=$min;}
                             
            while($minuteeff>=60){
                $minuteeff=$minuteeff-60;
                $nbrehreff=$nbrehreff+1;}
            $minuteeff = $minuteeff * 0.01;
            $nbrehreff = $nbrehreff + $minuteeff;
            
            $dates= DB::table('date_a_effectuers')
            ->join('pointage_a_effectuers', 'date_a_effectuers.id_pointaeff', '=', 'pointage_a_effectuers.id')
            ->where('pointage_a_effectuers.id_emp', '=', $id_employe)
            ->where('date_a_effectuers.annee','=',$annee)
            ->where('date_a_effectuers.mois','=',$mois)
            ->where('date_a_effectuers.des_j','=',$jourdes)
            ->select('date_a_effectuers.id_pointaeff')
            ->distinct()
            ->get();

            echo($dates);
            echo('<br>');
            foreach ($dates as $datepointaeff){
               // pour le jour 
            $jouraeff=JourAEffectuer::select('heure_sortie_j','heure_entree_j')
            ->where('num_seq_pa',$datepointaeff->id_pointaeff)
            ->where('designation_j','=',$jourdes)
            ->whereNotNull('heure_sortie_j')
            ->whereNotNull('heure_entree_j')->get();

            if($jouraeff->isEmpty()){
                $valeurPonctJour = 0;
            }

            else{
            foreach($jouraeff as $jour){
            $hrentree = $jour->heure_entree_j;
            $hrsortie = $jour->heure_sortie_j;

            $start_time = $hrentree;
            $end_time= $hrsortie;

            $time1 = new DateTime($start_time);
            $time2 = new DateTime($end_time);
            $interval = $time1->diff($time2);

            $diff = $interval;

            $hour = $diff->format('%h');
            $min = $diff->format('%i');
        }

   
     //  fin de jour 
    $countjour = DateAEffectuer::where('des_j','=', $jourdes)
                                       ->where('annee','=',$annee)
                                       ->where('mois','=',$mois)
                                       ->where('id_pointaeff','=',$datepointaeff->id_pointaeff)
                                       ->count(DB::raw('des_j'));
       


    $diffjrs = DifferenceJourProba::create([
        'nbj_desJour'=>$countjour,
        'diffhr_desJour'=>$hour,
        'diffmin_desJour'=>$min,
        'id_pointaeff'=>$datepointaeff->id_pointaeff
    ]);

    $nbrehr=0;
    $minute=0;

    $nbjhrmns = DifferenceJourProba::all();
    foreach($nbjhrmns as $nbjhrmn){
            $nbrj = $nbjhrmn->nbj_desJour;
            $nbrhourj = $nbjhrmn->diffhr_desJour;
            $nbrminj = $nbjhrmn->diffmin_desJour;

            $nbrehr+= $nbrhourj * $nbrj;
            $minute+= $nbrminj * $nbrj;}
               
    $nbrehrtotalaeff = $nbrehr;
    $minutetotalaeff = $minute;

    while($minutetotalaeff>=60){
        $minutetotalaeff=$minutetotalaeff-60;
        $nbrehrtotalaeff=$nbrehrtotalaeff+1;}
    
    $minutetotalaeff = $minutetotalaeff*0.01;
    $nbrehrtotalaeff = $nbrehrtotalaeff + $minutetotalaeff;
    echo($nbrehrtotalaeff);
    echo('<br>');
    $formuledenote=($nbrehrtotalaeff-$nbrehreff)/$nbrehrtotalaeff;
    $valeurPonctJour = 1- $formuledenote;
    DB::table('difference_jour_probas')->delete();
    }}    
        }
    }

    else{
        $valeurPonctJour = 0;
    }

    echo( $valeurPonctJour);
    echo('<br>');
 
// Fin de calcul pour ponctualité journaliere










//Début de calcul pour probabilité de présence
    $countProbPres = ProbabilitePresenceMensuelle::where('annee', $annee)
                                                 ->where('mois', $mois)
                                                 ->where('id_emp', $id_employe)
                                                 ->count();
    if($countProbPres == 0){
        Alert::error('Erreur', "Impossible d'effectuer le calcul ! : Vous-devez calculer d'abord la note de présence mensuelle");
        return back();
      
    }
    else{
        $valeursProbPres = ProbabilitePresenceMensuelle::select('valeur')->where('annee', $annee)
                                                                        ->where('mois', $mois)
                                                                        ->where('id_emp', $id_employe)
                                                                        ->get();    
                
            $valeurPP = 0;
            foreach($valeursProbPres as $valeurProbPres){
            $valPPers= $valeurProbPres->valeur;                                                    
            $valeurPP+= $valPPers;}
                                                                               
            $valeurProbaMens = $valeurPP;
                                                                        
    }
        echo($valeurProbaMens);
        echo('<br>');
    
    
//Fin de calcul pour probabilité de présence





//Début de calcul pour pontualité pers mensuelle
$countd= PointageAEffectuer::where('id_emp', $id_employe)
                                   ->count();
        if($countd != 0){

            $datesselect= DB::table('date_a_effectuers')
                ->join('pointage_a_effectuers', 'date_a_effectuers.id_pointaeff', '=', 'pointage_a_effectuers.id')
                ->where('pointage_a_effectuers.id_emp', '=', $id_employe)
                ->where('date_a_effectuers.annee','=',$annee)
                ->where('date_a_effectuers.mois','=',$mois)
                ->select('date_a_effectuers.id_pointaeff')
                ->distinct()
                ->get();
        
            $datenb = $datesselect->count();

            if($datenb == 0){
                $valeurPonctMens = 0;
                }   
            else{

        $pointageeff=PointageEffectue::select('heure_entree','heure_sortie','id','id_emp','annee','mois')
                                     ->where('id_emp','=',$id_employe)
                                     ->where('annee','=',$annee)
                                     ->where('mois','=',$mois)
                                     ->get();

        echo($pointageeff);
        echo('<br>');
        $nbrehreff=0;
        $minuteeff=0;
        foreach($pointageeff as $item){
                $heuredeb=$item->heure_entree;
                $heuresort=$item->heure_sortie;
                
                $start_time = $heuredeb;
                $end_time = $heuresort;

                $time1 = new DateTime($start_time);
                $time2 = new DateTime($end_time);
                $interval = $time1->diff($time2);

                $hour = $interval->format('%h');
                $nbrehreff+=$hour;
             
                $min = $interval->format('%i');
                $minuteeff+=$min;}

                 while($minuteeff>=60){
                    $minuteeff=$minuteeff-60;
                    $nbrehreff=$nbrehreff+1;
                }
        $minuteeff = $minuteeff * 0.01;
        $nbrehreff = $nbrehreff + $minuteeff;

            $dates= DB::table('date_a_effectuers')
            ->join('pointage_a_effectuers', 'date_a_effectuers.id_pointaeff', '=', 'pointage_a_effectuers.id')
            ->where('pointage_a_effectuers.id_emp', '=', $id_employe)
            ->where('date_a_effectuers.annee','=',$annee)
            ->where('date_a_effectuers.mois','=',$mois)
            ->select('date_a_effectuers.id_pointaeff')
            ->distinct()
            ->get();
            
        echo($dates);
        echo('<br>');
        foreach ($dates as $datepointaeff){

        // pour le jour lundi
            $jourlundi=JourAEffectuer::select('heure_sortie_j','heure_entree_j')
            ->where('num_seq_pa',$datepointaeff->id_pointaeff)
            ->where('designation_j','=', 'Lundi')
            ->whereNotNull('heure_sortie_j')
            ->whereNotNull('heure_entree_j')->get();

            if($jourlundi->isEmpty()){
                 $hourlundi = 0;
                 $minlundi = 0;
            }

            else{
            foreach($jourlundi as $jrlundi){
            $hrentreelundi = $jrlundi->heure_entree_j;
            $hrsortielundi = $jrlundi->heure_sortie_j;

            $start_timelundi = $hrentreelundi;
            $end_timelundi = $hrsortielundi;

            $time1lundi = new DateTime($start_timelundi);
            $time2lundi = new DateTime($end_timelundi);
            $intervallundi = $time1lundi->diff($time2lundi);

            $difflundi = $intervallundi;

            $hourlundi = $difflundi->format('%h');
            $minlundi = $difflundi->format('%i');
        }}

            $countlundi = DateAEffectuer::where('des_j','=', 'lundi')
                                        ->where('annee','=',$annee)
                                        ->where('mois','=',$mois)
                                        ->where('id_pointaeff','=',$datepointaeff->id_pointaeff)
                                        -> count(DB::raw('des_j'));         
        //  fin de jour lundi


        // pour le jour mardi
        $jourmardi=JourAEffectuer::select('heure_sortie_j','heure_entree_j')
        ->where('num_seq_pa',$datepointaeff->id_pointaeff)
        ->where('designation_j','=', 'Mardi')
        ->whereNotNull('heure_sortie_j')
        ->whereNotNull('heure_entree_j')->get();

        if($jourmardi->isEmpty()){
            $hourmardi = 0;
            $minmardi = 0;
        }

        else{
        foreach($jourmardi as $jrmardi){
        $hrentreemardi = $jrmardi->heure_entree_j;
        $hrsortiemardi = $jrmardi->heure_sortie_j;

        $start_timemardi = $hrentreemardi;
        $end_timemardi = $hrsortiemardi;

        $time1mardi = new DateTime($start_timemardi);
        $time2mardi = new DateTime($end_timemardi);
        $intervalmardi = $time1mardi->diff($time2mardi);

        $diffmardi = $intervalmardi;
        $hourmardi = $diffmardi->format('%h');
        $minmardi = $diffmardi->format('%i');}}

        $countmardi = DateAEffectuer::where('des_j','=', 'mardi')
                                    ->where('annee','=',$annee)
                                    ->where('mois','=',$mois)
                                    ->where('id_pointaeff','=',$datepointaeff->id_pointaeff)
                                    ->count(DB::raw('des_j'));

       //  fin de jour mardi


        // pour le jour mercredi
        $jourmercredi=JourAEffectuer::select('heure_sortie_j','heure_entree_j')
        ->where('num_seq_pa',$datepointaeff->id_pointaeff)
        ->where('designation_j','=', 'Mercredi')
        ->whereNotNull('heure_sortie_j')
        ->whereNotNull('heure_entree_j')->get();

        if($jourmercredi->isEmpty()){
            $hourmercredi = 0;
            $minmercredi = 0;
        }

        else{
        foreach($jourmercredi as $jrmercredi){
        $hrentremercredi = $jrmercredi->heure_entree_j;
        $hrsortiemercredi = $jrmercredi->heure_sortie_j;

        $start_timemercredi = $hrentremercredi;
        $end_timemercredi = $hrsortiemercredi;

        $time1mercredi = new DateTime($start_timemercredi);
        $time2mercredi = new DateTime($end_timemercredi);
        $intervalmercredi = $time1mercredi->diff($time2mercredi);

        $diffmercredi = $intervalmercredi;
        $hourmercredi = $diffmercredi->format('%h');
        $minmercredi = $diffmercredi->format('%i');
    }}

        $countmercredi = DateAEffectuer::where('des_j','=', 'mercredi')
                                       ->where('annee','=',$annee)
                                       ->where('mois','=',$mois)
                                       ->where('id_pointaeff','=',$datepointaeff->id_pointaeff)
                                       ->count(DB::raw('des_j'));

    //  fin de jour mercredi


        // pour le jour jeudi
        $jourjeudi=JourAEffectuer::select('heure_sortie_j','heure_entree_j')
        ->where('num_seq_pa',$datepointaeff->id_pointaeff)
        ->where('designation_j','=', 'Jeudi')
        ->whereNotNull('heure_sortie_j')
        ->whereNotNull('heure_entree_j')->get();

        if($jourjeudi->isEmpty()){
            $$hourjeudi = 0;
            $minjeudi = 0;
        }

        else{
        foreach($jourjeudi as $jrjeudi){
        $hrentrejeudi = $jrjeudi->heure_entree_j;
        $hrsortiejeudi = $jrjeudi->heure_sortie_j;

        $start_timejeudi = $hrentrejeudi;
        $end_timejeudi = $hrsortiejeudi;

        $time1jeudi = new DateTime($start_timejeudi);
        $time2jeudi = new DateTime($end_timejeudi);
        $intervaljeudi = $time1jeudi->diff($time2jeudi);

        $diffjeudi = $intervaljeudi;
        $hourjeudi = $diffjeudi->format('%h');
        $minjeudi = $diffjeudi->format('%i');
    }}

        $countjeudi = DateAEffectuer::where('des_j','=', 'jeudi')
                                    ->where('annee','=',$annee)
                                    ->where('mois','=',$mois)
                                    ->where('id_pointaeff','=',$datepointaeff->id_pointaeff)
                                    ->count(DB::raw('des_j'));

    //  fin de jour jeudi


        // pour le jour vendredi
        $jourvendredi=JourAEffectuer::select('heure_sortie_j','heure_entree_j')
        ->where('num_seq_pa',$datepointaeff->id_pointaeff)
        ->where('designation_j','=', 'Vendredi')
        ->whereNotNull('heure_sortie_j')
        ->whereNotNull('heure_entree_j')->get();

        if($jourvendredi->isEmpty()){
            $hourvendredi = 0;
            $minvendredi = 0;
        }

        else{
        foreach($jourvendredi as $jrvendredi){
        $hrentrevendredi = $jrvendredi->heure_entree_j;
        $hrsortievendredi= $jrvendredi->heure_sortie_j;

        $start_timevendredi = $hrentrevendredi;
        $end_timevendredi = $hrsortievendredi;

        $time1vendredi = new DateTime($start_timevendredi);
        $time2vendredi = new DateTime($end_timevendredi);
        $intervalvendredi = $time1vendredi->diff($time2vendredi);

        $diffvendredi = $intervalvendredi;
        $hourvendredi = $diffvendredi->format('%h');
        $minvendredi = $diffvendredi->format('%i');
    }}

        $countvendredi = DateAEffectuer::where('des_j','=', 'vendredi')
                                        ->where('annee','=',$annee)
                                        ->where('mois','=',$mois)
                                        ->where('id_pointaeff','=',$datepointaeff->id_pointaeff)
                                        ->count(DB::raw('des_j'));

    //  fin de jour vendredi

    // pour le jour samedi
        $joursamedi=JourAEffectuer::select('heure_sortie_j','heure_entree_j')
        ->where('num_seq_pa',$datepointaeff->id_pointaeff)
        ->where('designation_j','=', 'Samedi')
        ->whereNotNull('heure_sortie_j')
        ->whereNotNull('heure_entree_j')->get();

        if($joursamedi->isEmpty()){
            $hoursamedi = 0;
            $minsamedi = 0;
        }

        else{
        foreach($joursamedi as $jrsamedi){
        $hrentresamedi = $jrsamedi->heure_entree_j;
        $hrsortiesamedi= $jrsamedi->heure_sortie_j;

        $start_timesamedi = $hrentresamedi;
        $end_timesamedi = $hrsortiesamedi;

        $time1samedi = new DateTime($start_timesamedi);
        $time2samedi = new DateTime($end_timesamedi);
        $intervalsamedi = $time1samedi->diff($time2samedi);

        $diffsamedi = $intervalsamedi;
        $hoursamedi = $diffsamedi->format('%h');
        $minsamedi = $diffsamedi->format('%i');
    }}

        $countsamedi = DateAEffectuer::where('des_j','=', 'samedi')
                                     ->where('annee','=',$annee)
                                     ->where('mois','=',$mois)
                                     ->where('id_pointaeff','=',$datepointaeff->id_pointaeff)
                                     ->count(DB::raw('des_j'));

    //  fin de jour samedi

    // pour le jour dimanche
        $jourdimanche=JourAEffectuer::select('heure_sortie_j','heure_entree_j')
        ->where('num_seq_pa',$datepointaeff->id_pointaeff)
        ->where('designation_j','=', 'Dimanche')
        ->whereNotNull('heure_sortie_j')
        ->whereNotNull('heure_entree_j')->get();

        if($jourdimanche->isEmpty()){
            $hourdimanche = 0;
            $mindimanche = 0;
        }

        else{
        foreach($jourdimanche as $jrdimanche){
        $hrentredimanche = $jrdimanche->heure_entree_j;
        $hrsortiedimanche= $jrdimanche->heure_sortie_j;

        $start_timedimanche = $hrentredimanche;
        $end_timedimanche = $hrsortiedimanche;

        $time1dimanche = new DateTime($start_timedimanche);
        $time2dimanche = new DateTime($end_timedimanche);
        $intervaldimanche = $time1dimanche->diff($time2dimanche);

        $diffdimanche = $intervaldimanche;
        $hourdimanche = $diffdimanche->format('%h');
        $mindimanche = $diffdimanche->format('%i');
    }}

        $countdimanche = DateAEffectuer::where('des_j','=', 'dimanche')
                                       ->where('annee','=',$annee)
                                       ->where('mois','=',$mois)
                                       ->where('id_pointaeff','=',$datepointaeff->id_pointaeff)
                                       ->count(DB::raw('des_j'));
    //  fin de jour dimanche

            $diffjours = DifferenceJour::create([
                'nbj_lundi'=> $countlundi,
                'diffhr_lundi'=>$hourlundi,
                'diffmin_lundi'=>$minlundi,
               
                'nbj_mardi'=>$countmardi,
                'diffhr_mardi'=>$hourmardi,
                'diffmin_mardi'=>$minmardi,
              
                'nbj_mercredi'=>$countmercredi,
                'diffhr_mercredi'=>$hourmercredi,
                'diffmin_mercredi'=>$minmercredi,
               
                'nbj_jeudi'=>$countjeudi,
                'diffhr_jeudi'=>$hourjeudi,
                'diffmin_jeudi'=>$minjeudi,
             
                'nbj_vendredi'=>$countvendredi,
                'diffhr_vendredi'=>$hourvendredi,
                'diffmin_vendredi'=>$minvendredi,
            
                'nbj_samedi'=>$countsamedi,
                'diffhr_samedi'=>$hoursamedi,
                'diffmin_samedi'=>$minsamedi,
              
                'nbj_dimanche'=>$countdimanche,
                'diffhr_dimanche'=>$hourdimanche,
                'diffmin_dimanche'=>$mindimanche,

                'id_pointaeff'=>$datepointaeff->id_pointaeff]);

            }

        $nbrehrlundi=0;
        $minutelundi=0;

        $nbrehrmardi=0;
        $minutemardi=0;

        $nbrehrmercredi=0;
        $minutemercredi=0;

        $nbrehrjeudi=0;
        $minutejeudi=0;

        $nbrehrvendredi=0;
        $minutevendredi=0;

        $nbrehrsamedi=0;
        $minutesamedi=0;

        $nbrehrdimanche=0;
        $minutedimanche=0;

        $nbjdiffs = DifferenceJour::all();
        foreach($nbjdiffs as $nbjdiff){
            $nbrlundi = $nbjdiff->nbj_lundi;
            $nbrhourlundi = $nbjdiff->diffhr_lundi;
            $nbrminlundi = $nbjdiff->diffmin_lundi;

            $nbrehrlundi+= $nbrhourlundi * $nbrlundi;
            $minutelundi+= $nbrminlundi * $nbrlundi;



            $nbrmardi = $nbjdiff->nbj_mardi;
            $nbrhourmardi = $nbjdiff->diffhr_mardi;
            $nbrminmardi = $nbjdiff->diffmin_mardi;

            $nbrehrmardi+= $nbrhourmardi * $nbrmardi;
            $minutemardi+= $nbrminmardi * $nbrmardi;



            $nbrmercredi = $nbjdiff->nbj_mercredi;
            $nbrhourmercredi = $nbjdiff->diffhr_mercredi;
            $nbrminmercredi = $nbjdiff->diffmin_mercredi;

            $nbrehrmercredi+= $nbrhourmercredi * $nbrmercredi;
            $minutemercredi+= $nbrminmercredi * $nbrmercredi;



            $nbrjeudi = $nbjdiff->nbj_jeudi;
            $nbrhourjeudi = $nbjdiff->diffhr_jeudi;
            $nbrminjeudi = $nbjdiff->diffmin_jeudi;

            $nbrehrjeudi+= $nbrhourjeudi * $nbrjeudi;
            $minutejeudi+= $nbrminjeudi * $nbrjeudi;



            $nbrvendredi = $nbjdiff->nbj_vendredi;
            $nbrhourvendredi = $nbjdiff->diffhr_vendredi;
            $nbrminvendredi = $nbjdiff->diffmin_vendredi;

            $nbrehrvendredi+= $nbrhourvendredi * $nbrvendredi;
            $minutevendredi+= $nbrminvendredi * $nbrvendredi;



            $nbrsamedi = $nbjdiff->nbj_samedi;
            $nbrhoursamedi = $nbjdiff->diffhr_samedi;
            $nbrminsamedi = $nbjdiff->diffmin_samedi;

            $nbrehrsamedi+= $nbrhoursamedi * $nbrsamedi;
            $minutesamedi+= $nbrminsamedi * $nbrsamedi;



            $nbrdimanche = $nbjdiff->nbj_dimanche;
            $nbrhourdimanche = $nbjdiff->diffhr_dimanche;
            $nbrmindimanche = $nbjdiff->diffmin_dimanche;

            $nbrehrdimanche+= $nbrhourdimanche * $nbrdimanche;
            $minutedimanche+= $nbrmindimanche * $nbrdimanche;
        }

        $nbrehrtotalaeff = $nbrehrlundi+$nbrehrmardi+$nbrehrmercredi+$nbrehrjeudi+$nbrehrvendredi+$nbrehrsamedi+$nbrehrdimanche;
        $minutetotalaeff = $minutelundi+$minutemardi+$minutemercredi+$minutejeudi+$minutevendredi+$minutesamedi+$minutedimanche;
        
        while($minutetotalaeff>=60){
                        $minutetotalaeff=$minutetotalaeff-60;
                        $nbrehrtotalaeff=$nbrehrtotalaeff+1;}
        
        $minutetotalaeff = $minutetotalaeff*0.01;
        $nbrehrtotalaeff = $nbrehrtotalaeff + $minutetotalaeff;

        $formuledenoteponctmens=($nbrehrtotalaeff-$nbrehreff)/$nbrehrtotalaeff;
        $valeurPonctMens = 1- $formuledenoteponctmens;

            DB::table('difference_jours')->delete();
       
        
    }

}
        else{
            $valeurPonctMens = 0;
        }

        echo($valeurPonctMens);
        echo('<br>');

//Fin de calcul pour pontualité pers mensuelle



// *******Calcul de valeur de probabilite journaliere*******
$somc = $c1 + $c2 + $c3;
$somv = $c1*$valeurPonctJour + $c2*$valeurPonctMens + $c3*$valeurProbaMens;
$valeurProbJournaliere = $somv/$somc;


$int1 = $c1*0.95 + $c2*0.95 + $c3*0.9016;
$x1 = $int1/$somc;

$int2 = $c1*0.9 + $c2*0.9 + $c3*0.874;
$x2 = $int2/$somc;

$int3 = $c1*0.85 + $c2*0.85 + $c3*0.846;
$x3 = $int3/$somc;

$int4 = $c1*0.8 + $c2*0.8 + $c3*0.819/$somc;
$x4 = $int4/$somc;

if($valeurProbJournaliere<=1 && $valeurProbJournaliere>=$x1)
        {
            $mention = "Excellent";
        }
else if($valeurProbJournaliere<$x1 && $valeurProbJournaliere>=$x2)
        {
            $mention = "Bon";
        }
else if($valeurProbJournaliere<$x2 && $valeurProbJournaliere>=$x3)
        {
            $mention = "Moyen";
        }
else if($valeurProbJournaliere<$x3 && $valeurProbJournaliere>=$x4)
        {
            $mention = "Faible";
        }
else if($valeurProbJournaliere<$x4)
        {
            $mention = "Mediocre";
        }



        echo('<br>');

echo($valeurProbJournaliere);
        echo('<br>');


echo($x1);
echo('<br>');

echo($x2);
echo('<br>');

echo($x3);
echo('<br>');

echo($x4);
echo('<br>');
if($jourdes == 'lundi'){
    $note_probabilite_journaliere =  NoteProbabiliteJournaliere::create([
        'annee'=>$annee,
        'mois'=>$mois,
        'jour'=>$jourdes,
        'numj'=>1,
        'c1'=>$c1,
        'c2'=>$c2,
        'c3'=>$c3,
        'note'=>$valeurProbJournaliere,
        'mention'=>$mention,
        'id_emp'=>$id_employe
    ]);}

else if($jourdes == 'mardi'){
        $note_probabilite_journaliere =  NoteProbabiliteJournaliere::create([
            'annee'=>$annee,
            'mois'=>$mois,
            'jour'=>$jourdes,
            'numj'=>2,
            'c1'=>$c1,
            'c2'=>$c2,
            'c3'=>$c3,
            'note'=>$valeurProbJournaliere,
            'mention'=>$mention,
            'id_emp'=>$id_employe
        ]);}

else if($jourdes == 'mercredi'){
        $note_probabilite_journaliere =  NoteProbabiliteJournaliere::create([
            'annee'=>$annee,
            'mois'=>$mois,
            'jour'=>$jourdes,
            'numj'=>3,
            'c1'=>$c1,
            'c2'=>$c2,
            'c3'=>$c3,
            'note'=>$valeurProbJournaliere,
            'mention'=>$mention,
            'id_emp'=>$id_employe
            ]);}

else if($jourdes == 'jeudi'){
        $note_probabilite_journaliere =  NoteProbabiliteJournaliere::create([
            'annee'=>$annee,
            'mois'=>$mois,
            'jour'=>$jourdes,
            'numj'=>4,
            'c1'=>$c1,
            'c2'=>$c2,
            'c3'=>$c3,
            'note'=>$valeurProbJournaliere,
            'mention'=>$mention,
            'id_emp'=>$id_employe
                ]);}

else if($jourdes == 'vendredi'){
        $note_probabilite_journaliere =  NoteProbabiliteJournaliere::create([
            'annee'=>$annee,
            'mois'=>$mois,
            'jour'=>$jourdes,
            'numj'=>5,
            'c1'=>$c1,
            'c2'=>$c2,
            'c3'=>$c3,
            'note'=>$valeurProbJournaliere,
            'mention'=>$mention,
            'id_emp'=>$id_employe
                    ]);}

else if($jourdes == 'samedi'){
        $note_probabilite_journaliere =  NoteProbabiliteJournaliere::create([
            'annee'=>$annee,
            'mois'=>$mois,
            'jour'=>$jourdes,
            'numj'=>6,
            'c1'=>$c1,
            'c2'=>$c2,
            'c3'=>$c3,
            'note'=>$valeurProbJournaliere,
            'mention'=>$mention,
            'id_emp'=>$id_employe
                                    ]);}

else if($jourdes == 'dimanche'){
        $note_probabilite_journaliere =  NoteProbabiliteJournaliere::create([
            'annee'=>$annee,
            'mois'=>$mois,
            'jour'=>$jourdes,
            'numj'=>7,
            'c1'=>$c1,
            'c2'=>$c2,
            'c3'=>$c3,
            'note'=>$valeurProbJournaliere,
            'mention'=>$mention,
            'id_emp'=>$id_employe
            ]);}

    if($note_probabilite_journaliere){
        Alert::success('Succés', 'Opération effectuée aves succès !'); 
        return back();}
    }
}
