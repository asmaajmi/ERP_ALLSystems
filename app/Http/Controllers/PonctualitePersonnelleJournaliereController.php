<?php

namespace App\Http\Controllers;

use DateTime;
use Carbon\Carbon;
use App\Models\Employe;
use Illuminate\Http\Request;
use App\Models\DateAEffectuer;
use App\Models\JourAEffectuer;
use App\Models\PointageEffectue;
use App\Models\PointageAEffectuer;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\PonctualitePersonnelleJournaliere;

class PonctualitePersonnelleJournaliereController extends Controller
{
    public function CalculerPonctuaJournalier(Request $request){
        
        $annee=$request->input('annee_journaliere');       
        $mois=$request->input('mois_journaliere'); 
        $journum = $request->input('jour_journalier');
        $jourdes = $request->input('des_jour_journalier')  ;
        $id_employe4=$request->input('id_employe4');

        if($id_employe4 == null){
            Alert::error('Erreur', "La sélection d'un employé est obligatoire");
            return back();
        }

        $countd= PointageAEffectuer::where('id_emp', $id_employe4)
                                   ->count();
        if($countd != 0){
            if( $annee == null && $mois == null && $journum == null && $jourdes  == null ){
                Alert::error('Erreur', "La sélection des champs  est obligatoire");
                return back();}
          
            else if($annee == null && $mois == null){
                Alert::error('Erreur', "La sélection d'année et du mois est obligatoire");
                return back();}

            else if($annee == null && $journum == null){
                Alert::error('Erreur', "La sélection d'année et du numéro du jour est obligatoire");
                return back();}

            else if($annee == null && $jourdes == null){
                Alert::error('Erreur', "La sélection d'année et du la désignation du jour est obligatoire");
                return back();}

            else if($mois == null && $journum == null){
                Alert::error('Erreur', "La sélection du mois et du numéro du jour est obligatoire");
                return back();}
            
            else if($mois == null && $jourdes == null){
                Alert::error('Erreur', "La sélection du mois et la désignation du jour est obligatoire");
                return back();}

            else if($journum == null && $jourdes == null){
                Alert::error('Erreur', "La sélection du numéro du jour et la désignation du jour est obligatoire");
                return back();}
            
            else if($annee == null){
                Alert::error('Erreur', "La sélection d'année est obligatoire");
                return back();}

            else if($mois == null){
                Alert::error('Erreur', "La sélection du mois est obligatoire");
                return back();}

            else if($journum == null){
                Alert::error('Erreur', "La sélection du numéro du jour est obligatoire");
                return back();}

            else if($jourdes == null){
                Alert::error('Erreur', "La sélection du désignation du jour est obligatoire");
                return back();}

                
            $datesselect= DB::table('date_a_effectuers')
                ->join('pointage_a_effectuers', 'date_a_effectuers.id_pointaeff', '=', 'pointage_a_effectuers.id')
                ->where('pointage_a_effectuers.id_emp', '=', $id_employe4)
                ->where('date_a_effectuers.annee','=',$annee)
                ->where('date_a_effectuers.mois','=',$mois)
                ->where('date_a_effectuers.num_j','=',$journum)
                ->where('date_a_effectuers.des_j','=',$jourdes)
                ->select('date_a_effectuers.id_pointaeff')
                ->distinct()
                ->get();
        
            $datenb = $datesselect->count();

            if($datenb == 0){
                Alert::error('Erreur', "Cet employé n'a aucun pointage dans cet mois vous-pouvez choisir d'autres options");
                return back();}

            

        // verifier si la note est calcule déjà si c'est le cas en efface la ligne qui existe dans la table déjà
        $count = DB::table('ponctualite_personnelle_journalieres')->where('id_emp',$id_employe4)
                                                                  ->where('annee',$annee)
                                                                  ->where('mois',$mois)
                                                                  ->where('jour',$journum)
                                                                  ->where('des_jour',$jourdes)
                                                                  ->count(DB::raw('id'));
        
        if($count>0){
            PonctualitePersonnelleJournaliere::where('id_emp',$id_employe4)
                                             ->where('annee',$annee)
                                             ->where('mois',$mois)
                                             ->where('jour',$journum)
                                             ->where('des_jour',$jourdes)
                                             ->delete();}
        // fin de verification

        $pointageeff=PointageEffectue::select('heure_entree','heure_sortie','id','id_emp','annee','mois','num_j','des_j')
                                     ->where('id_emp','=',$id_employe4)
                                     ->where('annee','=',$annee)
                                     ->where('mois','=',$mois)
                                     ->where('num_j',$journum)
                                     ->where('des_j',$jourdes)
                                     ->get();

        echo($pointageeff);
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
                    $nbrehreff=$nbrehreff+1;
                }
        $minuteeff = $minuteeff * 0.01;
        $nbrehreff = $nbrehreff + $minuteeff;

            $dates= DB::table('date_a_effectuers')
            ->join('pointage_a_effectuers', 'date_a_effectuers.id_pointaeff', '=', 'pointage_a_effectuers.id')
            ->where('pointage_a_effectuers.id_emp', '=', $id_employe4)
            ->where('date_a_effectuers.annee','=',$annee)
            ->where('date_a_effectuers.mois','=',$mois)
            ->where('date_a_effectuers.num_j','=',$journum)
            ->where('date_a_effectuers.des_j','=',$jourdes)
            ->select('date_a_effectuers.id_pointaeff')
            ->distinct()
            ->get();
            
        echo($dates);
        foreach ($dates as $datepointaeff){

        // pour le jour 
            $jouraeff=JourAEffectuer::select('heure_sortie_j','heure_entree_j')
            ->where('num_seq_pa',$datepointaeff->id_pointaeff)
            ->where('designation_j','=',$jourdes)
            ->whereNotNull('heure_sortie_j')
            ->whereNotNull('heure_entree_j')->get();

            if($jouraeff->isEmpty()){
                 $hour = 0;
                 $min = 0;
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
    }
       
        //  fin de jour 

        $nbrehrtotalaeff = $hour;
        $minutetotalaeff = $min;
        
        $minutetotalaeff = $minutetotalaeff*0.01;
        $nbrehrtotalaeff = $nbrehrtotalaeff + $minutetotalaeff;
        echo($nbrehrtotalaeff);
        $formuledenote=($nbrehrtotalaeff-$nbrehreff)/$nbrehrtotalaeff;
        $notePonctJournaliere = 1- $formuledenote;

        if($notePonctJournaliere<=1 && $notePonctJournaliere>=0.95)
        {
            $mention="Excellent";
        }
        else if($notePonctJournaliere<0.95 && $notePonctJournaliere>=0.90)
        {
            $mention="Bon";
        }
        else if($notePonctJournaliere<0.90 && $notePonctJournaliere>=0.85)
        {
            $mention="Moyen";
        }
        else if($notePonctJournaliere<0.85 && $notePonctJournaliere>=0.8)
        {
            $mention="Faible";
        }
        else
        {
            $mention="Mediocre";
        }

        $date = Carbon::create($annee, $mois, $journum);
        $ponctualite_pers_journalier=PonctualitePersonnelleJournaliere::create([
            'annee'=>$annee,
            'mois'=>$mois,
            'jour'=>$journum,
            'des_jour'=>$jourdes,
            'valeur'=>$notePonctJournaliere,
            'mention'=>$mention,
            'date_jour'=> $date,
            'id_emp'=>$id_employe4
        ]);
        if($ponctualite_pers_journalier){
            Alert::success('Succés', 'Opération effectuée aves succès !'); 
            return back();    
          }      
    }
        }
    else{
        Alert::error('Erreur', "Impossible d'effectuer le calcul ! : Cet employé n'a aucun pointage à effectuer");
                return back();
    }
    }

    public function afficheEvaluerJour(Request $request){
        $employes = Employe::all();
        return view('chartsPonctualitePersJournaliere', compact('employes'));
    }
}
