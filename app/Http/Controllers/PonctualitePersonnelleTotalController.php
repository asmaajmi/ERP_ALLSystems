<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Models\DateAEffectuer;
use App\Models\DifferenceJour;
use App\Models\JourAEffectuer;
use App\Models\PointageEffectue;
use App\Models\PointageAEffectuer;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\PonctualitePersonnelleTotal;

class PonctualitePersonnelleTotalController extends Controller
{
    public function calculPonctualiteTotal(Request $request){
        
        $id_employe3=$request->input('id_employe3');
        echo($id_employe3);

        if($id_employe3 == null){
            Alert::error('Erreur', "La sélection d'un employé est obligatoire");
            return back();
        }

        $countd= PointageAEffectuer::where('id_emp', $id_employe3)
                                   ->count();
        if($countd == 0){
            Alert::error('Erreur', "Impossible d'effectuer le calcul ! : Cet employé n'a aucun pointage à effectuer ");
            return back();
        }
        else{

        // verifier si la note est calcule déjà si c'est le cas en efface la ligne qui existe dans la table déjà
        $count = DB::table('ponctualite_personnelle_totals')->where('id_emp',$id_employe3)
                                                            ->count(DB::raw('id'));
        
        if($count>0){
            PonctualitePersonnelleTotal::where('id_emp',$id_employe3)
                                       ->delete();}
        // fin de verification

        $pointageeff=PointageEffectue::select('heure_entree','heure_sortie','id','id_emp','annee','mois')
                                     ->where('id_emp','=',$id_employe3)
                                     ->get();

        echo($pointageeff);
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
            ->where('pointage_a_effectuers.id_emp', '=', $id_employe3)
            ->select('date_a_effectuers.id_pointaeff')
            ->distinct()
            ->get();
            
        echo($dates);
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

        $formuledenote=($nbrehrtotalaeff-$nbrehreff)/$nbrehrtotalaeff;
        $notePonctTotal = 1- $formuledenote;

        if($notePonctTotal<=1 && $notePonctTotal>=0.95)
        {
            $mention="Excellent";
        }
        else if($notePonctTotal<0.95 && $notePonctTotal>=0.90)
        {
            $mention="Bon";
        }
        else if($notePonctTotal<0.90 && $notePonctTotal>=0.85)
        {
            $mention="Moyen";
        }
        else if($notePonctTotal<0.85 && $notePonctTotal>=0.8)
        {
            $mention="Faible";
        }
        else
        {
            $mention="Mediocre";
        }

        $ponctualite_pers_total=PonctualitePersonnelleTotal::create([
            'total'=>$notePonctTotal,
            'mention'=>$mention,
            'id_emp'=>$id_employe3
        ]);
        if($ponctualite_pers_total){
            DB::table('difference_jours')->delete();
            Alert::success('Succés', 'Opération effectuée aves succès !'); 
            return back();    
          }
    }
}
}

