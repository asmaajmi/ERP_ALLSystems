<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\NotePresenceMensuelle;
use App\Models\NoteProbabiliteJournaliere;
use App\Models\PonctualitePersMensuelle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ProbabilitePresenceMensuelle;

class TableauBordPieController extends Controller
{
    public function TableauBordAffiche(){
        $employes=Employe::all();
        $employepresence=ProbabilitePresenceMensuelle::all();
        $employeponctpersmens=PonctualitePersMensuelle::all();
        $employeprobjourna=NoteProbabiliteJournaliere::all();
        return view('Tableau_bord1',compact("employepresence","employeponctpersmens","employeprobjourna","employes"));
    }

    public function FindAnnee(Request $request){
        //$request->id here is the id of our chosen option id

        $data = DB::table('note_presence_mensuelles')
        ->join('employes', 'note_presence_mensuelles.id_emp', '=', 'employes.id', 'left')
        ->where('note_presence_mensuelles.id_emp', '=', $request->id)
        ->select('note_presence_mensuelles.annee')->distinct()->get();


       
        return response()->json($data);
	}

    public function FindAnneeponctmens(Request $request){
        //$request->id here is the id of our chosen option id

        $data = DB::table('ponctualite_pers_mensuelles')
        ->join('employes', 'ponctualite_pers_mensuelles.id_emp', '=', 'employes.id', 'left')
        ->where('ponctualite_pers_mensuelles.id_emp', '=', $request->id)
        ->select('ponctualite_pers_mensuelles.annee')->distinct()->get();
     
        return response()->json($data);
	}

    public function FindAnneeProbaJourna(Request $request){
        //$request->id here is the id of our chosen option id

        $data = DB::table('note_probabilite_journalieres')
        ->join('employes', 'note_probabilite_journalieres.id_emp', '=', 'employes.id', 'left')
        ->where('note_probabilite_journalieres.id_emp', '=', $request->id)
        ->select('note_probabilite_journalieres.annee')->distinct()->get();
       
        return response()->json($data);
	}

    public function FindChart(Request $request)
    {   
        $emp_id=$request->input('id_emp_prob_pres');
        $val=NotePresenceMensuelle::select("valeur as val")
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->pluck('val');

    
        $months=NotePresenceMensuelle::select(DB::raw("mois as month"))
        ->where('annee',$request->annee)
        ->where('id_emp',$request->id_emp)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');

        $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index=>$month)
        {
            $data[$month-1]=$val[$index];
        }

        $data=[
            'data1' => $data,
            'valeur' => $val
        ];
        return response()->json($data);

    }

    public function FindChartPersMens(Request $request){
        $emp_id=$request->input('nom_emp_ponct_pres_mens');
        $val=PonctualitePersMensuelle::select("valeur as val")
        ->where('annee',$request->anneeval)
        ->where('id_emp',$request->id_emp_ponct_mens)
        ->pluck('val');

    
        $months=PonctualitePersMensuelle::select(DB::raw("mois as month"))
        ->where('annee',$request->anneeval)
        ->where('id_emp',$request->id_emp_ponct_mens)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');

        $data=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months as $index=>$month)
        {
            $data[$month-1]=$val[$index];
        }

        $data=[
            'data1' => $data,
            'valeur' => $val
        ];
        return response()->json($data);
    }

    public function FindChartProbaJournaliere(Request $request){
        $emp_id=$request->input('nom_emp_Proba_Journa');
        $val=NoteProbabiliteJournaliere::select("note as val")
        ->where('annee',$request->anneeJour)
        ->where('id_emp',$request->id_empJour)
        ->where('mois',$request->moisJour)
        ->pluck('val');

        $jours=NoteProbabiliteJournaliere::select(DB::raw("numj as j"))
        ->where('annee',$request->anneeJour)
        ->where('id_emp',$request->id_empJour)
        ->where('mois',$request->moisJour)
        ->groupBy(DB::raw("numj"))
        ->pluck('j');

        $data=array(0,0,0,0,0,0,0);
       
        foreach($jours as $index=>$j)
        {
            $data[$j-1]=$val[$index];
        }

        $data=[
            'data1' => $data,
            'note' => $val,
            'jours'=>$jours
        ];
        return response()->json($data);
    }
}
