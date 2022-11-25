<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\PointageEffectue;
use Illuminate\Support\Facades\DB;
use App\Models\NotePresenceAnnuelle;
use App\Models\NotePresenceMensuelle;
use App\Models\ProbabiliteCongeAnnuelle;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ProbabiliteCongeMensuelle;
use App\Models\ProbabilitePresenceAnnuelle;
use App\Models\ProbabilitePresenceMensuelle;

class NoteAssiduiteController extends Controller
{
    public function NoteAssiduiteForm(){
        $services=Service::all();
        $annees=PointageEffectue::select('annee')->distinct()->get();
        return view('NoteAssiduite',compact("services","annees"));
    }

    public function NotePresenceMensuelle(Request $request){
        $note=NotePresenceMensuelle::select('id_emp')->distinct()->get();
        $annees=NotePresenceMensuelle::select('annee')->distinct()->get();
        return view('chartsPresenceMensuelle',compact("annees","note"));
    }

    public function FindAnneeDebut(Request $request){

        //$request->id here is the id of our chosen option id
        $data=NotePresenceMensuelle::select('annee')->where('id_emp',$request->id)
        ->distinct()->get();
        return response()->json($data);//then sent this data to ajax success
	}

    
    public function FindChart(Request $request)
    {   
        $annee=$request->input('annee_debut');
        $annee_fin=$request->input('annee_fin');
        $val=NotePresenceMensuelle::select("valeur as val")
        ->where('annee',$request->annee_debut)
        ->where('id_emp',$request->id_emp)
        ->pluck('val');

    
        $months=NotePresenceMensuelle::select(DB::raw("mois as month"))
        ->where('annee',$request->annee_debut)
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
    public function calculPresenceMensuelle(Request $request){
        $id_employe=$request->input('id_employe');
        $annee=$request->input('Annee_presence');
        $mois=$request->input('mois_pres_mensuelle');
        $ProbPresence = ProbabilitePresenceMensuelle::select('valeur')
        ->where('id_emp',$id_employe)
        ->where('annee',$annee)
        ->where('mois',$mois)
        ->get();

        $countProbConge=ProbabiliteCongeMensuelle::select('valeur')
        ->where('id_emp',$id_employe)
        ->where('annee',$annee)
        ->where('mois',$mois)
        ->count();


        $probConge=ProbabiliteCongeMensuelle::select('valeur')->where('id_emp',$id_employe)
        ->where('annee',$annee)
        ->where('mois',$mois)
        ->get();
        
        $countNotePresence_EmpX=NotePresenceMensuelle::select('valeur','mention')
        ->where('id_emp',$id_employe)
        ->where('annee',$annee)
        ->where('mois',$mois)
        ->count();

        foreach($ProbPresence as $Presence)

        {
            $valeurpresence=$Presence->valeur;
        }
        foreach($probConge as $conge)
            
        {
            $valeurConge=$conge->valeur;
            
        }

        if($countProbConge == 0)
        {

            $notePresenceMensuelle=$valeurpresence;

        }
       
        else
        {
        
            $notePresenceMensuelle=$valeurpresence*(1-$valeurConge);
        
        }
        if($notePresenceMensuelle >=0.91)
        {
            $mention="Excellent";
        }
        else if($notePresenceMensuelle<=0.88 && $notePresenceMensuelle>0.91)
        {
            $mention="Bon";
        }
        else if($notePresenceMensuelle<=0.85 && $notePresenceMensuelle>0.88)
        {
            $mention="Moyen";
        }
        else if($notePresenceMensuelle<=0.82 && $notePresenceMensuelle>0.85)
        {
            $mention="Faible";
        }
        else
        {
            $mention="Mediocre";
        }
        

        if($countNotePresence_EmpX != 0){
            $notePresenceMensuelleUpdate = NotePresenceMensuelle::where('id_emp',$id_employe)
            ->where('mois',$mois)
            ->where('annee',$annee)
            ->update(['valeur'=>$notePresenceMensuelle,'mention'=>$mention]);
        }
        else{

            $notePresenceMensuelleCreate=NotePresenceMensuelle::create([
                'annee'=>$annee,
                'mois'=>$mois,
                'id_emp'=>$id_employe,
                'valeur'=>$notePresenceMensuelle,
                'mention'=>$mention
            ]);
        }
    }
    public function NotePresenceMensuelleAffiche()
    {
       $noteProbPresence=NotePresenceMensuelle::all();
        return view("affichageNotePresence",compact("noteProbPresence"));
        
    }

    public function calculPresenceAnnuelle(Request $request){

        try{
            $id_employe=$request->input('id_employe_ann');
            $annee=$request->input('Annee_presence_ann');

            $ProbPresence = ProbabilitePresenceAnnuelle::select('valeur')
            ->where('id_emp',$id_employe)
            ->where('annee',$annee)
            ->get();

            $countProbConge=ProbabiliteCongeAnnuelle::select('valeur')
            ->where('id_emp',$id_employe)
            ->where('annee',$annee)
            ->count();


            $probConge=ProbabiliteCongeAnnuelle::select('valeur')->where('id_emp',$id_employe)
            ->where('annee',$annee)
            ->get();
            
            $countNotePresence_EmpX=NotePresenceAnnuelle::select('valeur','mention')
            ->where('id_emp',$id_employe)
            ->where('annee',$annee)
            ->count();

            foreach($ProbPresence as $Presence)

            {
                $valeurpresenceAnnuelle=$Presence->valeur;
            }
            foreach($probConge as $conge)
                
            {
                $valeurCongeAnnuelle=$conge->valeur;
                
            }

            if($countProbConge == 0)
            {

                $notePresenceAnnuelle=$valeurpresenceAnnuelle;

            }
        
            else
            {
            
                $notePresenceAnnuelle=$valeurpresenceAnnuelle*(1-$valeurCongeAnnuelle);
            
            }
            if($notePresenceAnnuelle >=0.91)
            {
                $mention="Excellent";
            }
            else if($notePresenceAnnuelle<=0.88 && $notePresenceAnnuelle>0.91)
            {
                $mention="Bon";
            }
            else if($notePresenceAnnuelle<=0.85 && $notePresenceAnnuelle>0.88)
            {
                $mention="Moyen";
            }
            else if($notePresenceAnnuelle<=0.82 && $notePresenceAnnuelle>0.85)
            {
                $mention="Faible";
            }
            else
            {
                $mention="Mediocre";
            }
            

            if($countNotePresence_EmpX != 0){

                $notePresenceAnnuelleUpdate = NotePresenceAnnuelle::where('id_emp',$id_employe)
                ->where('annee',$annee)
                ->update(['valeur'=>$notePresenceAnnuelle,'mention'=>$mention]);

                Alert::success('Succés', 'Calcul effectuée avec succès !'); 
                $services=Service::all();
                $annees=PointageEffectue::select('annee')->distinct()->get();
                return view('Probabilite',compact("services","annees"));
        
            }
            else{

                $notePresenceAnnuelleCreate=NotePresenceAnnuelle::create([
                    'annee'=>$annee,
                    'id_emp'=>$id_employe,
                    'valeur'=>$notePresenceAnnuelle,
                    'mention'=>$mention
                ]);
                
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
}
