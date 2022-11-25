<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\NotePresenceMensuelle;
use App\Http\Requests\RegisterRequest;
use App\Models\NoteProbabiliteJournaliere;
use App\Models\PonctualitePersMensuelle;

class TableauBordAideDecisionController extends Controller
{
    public function chartview(){
        $anneesPonctPersMens=PonctualitePersMensuelle::select('annee')->distinct()->get();
        $anneesProbPres=NotePresenceMensuelle::select('annee')->distinct()->get();
        $anneesProbJournMens=NoteProbabiliteJournaliere::select('annee')->distinct()->get();
        
        return view('Tableau_bord_aide_decision',compact("anneesPonctPersMens", "anneesProbPres", "anneesProbJournMens"));
    }

    public function findChart1(Request $request)
    {
        $nbreemployes=Employe::select('id')->count();
       
        $months1=NotePresenceMensuelle::select(DB::raw("mois as month"))
        ->where('mention',"=",'Excellent')
        ->where('annee',$request->annee)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');

        
       

    
        $months2=NotePresenceMensuelle::select(DB::raw("mois as month"))
        ->where('mention','Bon')
        ->where('annee',$request->annee)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');

       

    
        $months3=NotePresenceMensuelle::select(DB::raw("mois as month"))
        ->where('mention','Moyen')
        ->where('annee',$request->annee)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');

      

    
        $months4=NotePresenceMensuelle::select(DB::raw("mois as month"))
        ->where('mention','Faible')
        ->where('annee',$request->annee)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');

      

    
        $months5=NotePresenceMensuelle::select(DB::raw("mois as month"))
        ->where('mention','Mediocre')
        ->where('annee',$request->annee)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');
        $data1=array(0,0,0,0,0,0,0,0,0,0,0,0);
        $data2=array(0,0,0,0,0,0,0,0,0,0,0,0);
        $data3=array(0,0,0,0,0,0,0,0,0,0,0,0);
        $data4=array(0,0,0,0,0,0,0,0,0,0,0,0);
        $data5=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months1 as $index1=>$month1)
        {   
             $val1=NotePresenceMensuelle::select("id_emp as val")
            ->where('mention',"=",'Excellent')
            ->where('annee',$request->annee)
            ->where("mois",$month1)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');
            $data1[$month1-1]=count($val1)*100/$nbreemployes;
        }

        foreach($months2 as $index2=>$month2)
        {   
            $val2=NotePresenceMensuelle::select("id_emp as val")
            ->where('mention','Bon')
            ->where('annee',$request->annee)
            ->where("mois",$month2)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');
            $data2[$month2-1]=count($val2)*100/$nbreemployes;
        }

        foreach($months3 as $index3=>$month3)
        {
            $val3=NotePresenceMensuelle::select("id_emp as val")
            ->where('mention','Moyen')
            ->where('annee',$request->annee)
            ->where("mois",$month3)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');
            $data3[$month3-1]=count($val3)*100/$nbreemployes;
        }

        foreach($months4 as $index4=>$month4)
        {
            $val4=NotePresenceMensuelle::select("id_emp as val")
            ->where('mention','Faible')
            ->where('annee',$request->annee)
            ->where("mois",$month4)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');

            $data4[$month4-1]=count($val4)*100/$nbreemployes;
        }

        foreach($months5 as $index5=>$month5)
        {
            $val5=NotePresenceMensuelle::select("id_emp")
            ->where('mention','Mediocre')
            ->where('annee',$request->annee)
            ->where("mois",$month5)
            ->groupBy(DB::raw("id_emp"))
            ->get();
            $employes=NotePresenceMensuelle::select("id_emp")
            ->where('mention','Mediocre')
            ->where('annee',$request->annee)
            ->where("mois",$month5)
            ->get();
            foreach($val5 as $employe)
            {
            $emp=Employe::select("nom_emp","prenom_emp")
            ->where("id",$employe->id_emp)
            ->get();
            }
            foreach($emp as $item){
                $nom_emp=$item->nom_emp;
                $prenom_emp=$item->prenom_emp;

            }
            $data5[$month5-1]=count($val5)*100/$nbreemployes;
        
        }
        $mois=NotePresenceMensuelle::select('mois')->where('annee',$request->annee)->distinct()->get();
        
        $nomEmp=NotePresenceMensuelle::select('id_emp','mention','mois')->where('annee',$request->annee)->get();
        $employenom=Employe::all();
        $mentionExcellents=NotePresenceMensuelle::select('id_emp','mention','mois')->where('mention','Excellent')->where('annee',$request->annee)->get();
        $mentionBons=NotePresenceMensuelle::select('id_emp','mention','mois')->where('mention','Bon')->where('annee',$request->annee)->get();
        $mentionMoyens=NotePresenceMensuelle::select('id_emp','mention','mois')->where('mention','Moyen')->where('annee',$request->annee)->get();
        $mentionFaibles=NotePresenceMensuelle::select('id_emp','mention','mois')->where('mention','Faible')->where('annee',$request->annee)->get();
        $mentionMediocres=NotePresenceMensuelle::select('id_emp','mention','mois')->where('mention','Mediocre')->where('annee',$request->annee)->get();

        $data=[
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            'mois'=>$mois,
            'nomEmp'=>$nomEmp,
            'employenom'=>$employenom,
            'mentionExcellents'=>$mentionExcellents,
            'mentionBons'=>$mentionBons,
            'mentionMoyens'=>$mentionMoyens,
            'mentionFaibles'=>$mentionFaibles,
            'mentionMediocres'=>$mentionMediocres
        ];
        return response()->json($data);
    }












    public function findChart2(Request $request)
    {
        $nbreemployes=Employe::select('id')->count();
       
        $months1=PonctualitePersMensuelle::select(DB::raw("mois as month"))
        ->where('mention',"=",'Excellent')
        ->where('annee',$request->annee)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');

        
       

    
        $months2=PonctualitePersMensuelle::select(DB::raw("mois as month"))
        ->where('mention','Bon')
        ->where('annee',$request->annee)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');

       

    
        $months3=PonctualitePersMensuelle::select(DB::raw("mois as month"))
        ->where('mention','Moyen')
        ->where('annee',$request->annee)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');

      

    
        $months4=PonctualitePersMensuelle::select(DB::raw("mois as month"))
        ->where('mention','Faible')
        ->where('annee',$request->annee)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');

      

    
        $months5=PonctualitePersMensuelle::select(DB::raw("mois as month"))
        ->where('mention','Mediocre')
        ->where('annee',$request->annee)
        ->groupBy(DB::raw("mois"))
        ->pluck('month');
        $data1=array(0,0,0,0,0,0,0,0,0,0,0,0);
        $data2=array(0,0,0,0,0,0,0,0,0,0,0,0);
        $data3=array(0,0,0,0,0,0,0,0,0,0,0,0);
        $data4=array(0,0,0,0,0,0,0,0,0,0,0,0);
        $data5=array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach($months1 as $index1=>$month1)
        {   
             $val1=PonctualitePersMensuelle::select("id_emp as val")
            ->where('mention',"=",'Excellent')
            ->where('annee',$request->annee)
            ->where("mois",$month1)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');
            $data1[$month1-1]=count($val1)*100/$nbreemployes;
        }

        foreach($months2 as $index2=>$month2)
        {   
            $val2=PonctualitePersMensuelle::select("id_emp as val")
            ->where('mention','Bon')
            ->where('annee',$request->annee)
            ->where("mois",$month2)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');
            $data2[$month2-1]=count($val2)*100/$nbreemployes;
        }

        foreach($months3 as $index3=>$month3)
        {
            $val3=PonctualitePersMensuelle::select("id_emp as val")
            ->where('mention','Moyen')
            ->where('annee',$request->annee)
            ->where("mois",$month3)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');
            $data3[$month3-1]=count($val3)*100/$nbreemployes;
        }

        foreach($months4 as $index4=>$month4)
        {
            $val4=PonctualitePersMensuelle::select("id_emp as val")
            ->where('mention','Faible')
            ->where('annee',$request->annee)
            ->where("mois",$month4)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');

            $data4[$month4-1]=count($val4)*100/$nbreemployes;
        }

        foreach($months5 as $index5=>$month5)
        {
            $val5=PonctualitePersMensuelle::select("id_emp")
            ->where('mention','Mediocre')
            ->where('annee',$request->annee)
            ->where("mois",$month5)
            ->groupBy(DB::raw("id_emp"))
            ->get();
            $employes=PonctualitePersMensuelle::select("id_emp")
            ->where('mention','Mediocre')
            ->where('annee',$request->annee)
            ->where("mois",$month5)
            ->get();
            foreach($val5 as $employe)
            {
            $emp=Employe::select("nom_emp","prenom_emp")
            ->where("id",$employe->id_emp)
            ->get();
            }
            foreach($emp as $item){
                $nom_emp=$item->nom_emp;
                $prenom_emp=$item->prenom_emp;

            }
            $data5[$month5-1]=count($val5)*100/$nbreemployes;
        
        }
        $mois=PonctualitePersMensuelle::select('mois')->where('annee',$request->annee)->distinct()->get();
        
        $nomEmp=PonctualitePersMensuelle::select('id_emp','mention','mois')->where('annee',$request->annee)->get();
        $employenom=Employe::all();
        $mentionExcellents=PonctualitePersMensuelle::select('id_emp','mention','mois')->where('mention','Excellent')->where('annee',$request->annee)->get();
        $mentionBons=PonctualitePersMensuelle::select('id_emp','mention','mois')->where('mention','Bon')->where('annee',$request->annee)->get();
        $mentionMoyens=PonctualitePersMensuelle::select('id_emp','mention','mois')->where('mention','Moyen')->where('annee',$request->annee)->get();
        $mentionFaibles=PonctualitePersMensuelle::select('id_emp','mention','mois')->where('mention','Faible')->where('annee',$request->annee)->get();
        $mentionMediocres=PonctualitePersMensuelle::select('id_emp','mention','mois')->where('mention','Mediocre')->where('annee',$request->annee)->get();

        $data=[
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            'mois'=>$mois,
            'nomEmp'=>$nomEmp,
            'employenom'=>$employenom,
            'mentionExcellents'=>$mentionExcellents,
            'mentionBons'=>$mentionBons,
            'mentionMoyens'=>$mentionMoyens,
            'mentionFaibles'=>$mentionFaibles,
            'mentionMediocres'=>$mentionMediocres
        ];
        return response()->json($data);
    }













    public function findChart3(Request $request)
    {
        $nbreemployes=Employe::select('id')->count();
       
        $jours1=NoteProbabiliteJournaliere::select(DB::raw("numj as day"))
        ->where('mention',"=",'Excellent')
        ->where('annee',$request->annee)
        ->where('mois',$request->mois)
        ->groupBy(DB::raw("numj"))
        ->pluck('day');



        
        $jours2=NoteProbabiliteJournaliere::select(DB::raw("numj as day"))
        ->where('mention','Bon')
        ->where('annee',$request->annee)
        ->where('mois',$request->mois)
        ->groupBy(DB::raw("numj"))
        ->pluck('day');

       

        $jours3=NoteProbabiliteJournaliere::select(DB::raw("numj as day"))
        ->where('mention','Moyen')
        ->where('annee',$request->annee)
        ->where('mois',$request->mois)
        ->groupBy(DB::raw("numj"))
        ->pluck('day');    


                
        $jours4=NoteProbabiliteJournaliere::select(DB::raw("numj as day"))
        ->where('mention','Faible')
        ->where('annee',$request->annee)
        ->where('mois',$request->mois)
        ->groupBy(DB::raw("numj"))
        ->pluck('day');          
                

      
        $jours5=NoteProbabiliteJournaliere::select(DB::raw("numj as day"))
        ->where('mention','Mediocre')
        ->where('annee',$request->annee)
        ->where('mois',$request->mois)
        ->groupBy(DB::raw("numj"))
        ->pluck('day');        
    
        
        $data1=array(0,0,0,0,0,0,0);
        $data2=array(0,0,0,0,0,0,0);
        $data3=array(0,0,0,0,0,0,0);
        $data4=array(0,0,0,0,0,0,0);
        $data5=array(0,0,0,0,0,0,0);

        foreach($jours1 as $index1=>$jour1)
        {   
             $val1=NoteProbabiliteJournaliere::select("id_emp as val")
            ->where('mention',"=",'Excellent')
            ->where('annee',$request->annee)
            ->where('mois',$request->mois)
            ->where("numj",$jour1)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');
            $data1[$jour1-1]=count($val1)*100/$nbreemployes;
        }

        foreach($jours2 as $index2=>$jour2)
        {   
            $val2=NoteProbabiliteJournaliere::select("id_emp as val")
            ->where('mention','Bon')
            ->where('annee',$request->annee)
            ->where('mois',$request->mois)
            ->where("numj",$jour2)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');
            $data2[$jour2-1]=count($val2)*100/$nbreemployes;
        }

        foreach($jours3 as $index3=>$jour3)
        {
            $val3=NoteProbabiliteJournaliere::select("id_emp as val")
            ->where('mention','Moyen')
            ->where('annee',$request->annee)
            ->where('mois',$request->mois)
            ->where("numj",$jour3)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');
            $data3[$jour3-1]=count($val3)*100/$nbreemployes;
        }

        foreach($jours4 as $index4=>$jour4)
        {
            $val4=NoteProbabiliteJournaliere::select("id_emp as val")
            ->where('mention','Faible')
            ->where('annee',$request->annee)
            ->where('mois',$request->mois)
            ->where("numj",$jour4)
            ->groupBy(DB::raw("id_emp"))
            ->pluck('val');

            $data4[$jour4-1]=count($val4)*100/$nbreemployes;
        }

        foreach($jours5 as $index5=>$jour5)
        {
            $val5=NoteProbabiliteJournaliere::select("id_emp")
            ->where('mention','Mediocre')
            ->where('annee',$request->annee)
            ->where('mois',$request->mois)
            ->where("numj",$jour5)
            ->groupBy(DB::raw("id_emp"))
            ->get();
            $employes=NoteProbabiliteJournaliere::select("id_emp")
            ->where('mention','Mediocre')
            ->where('annee',$request->annee)
            ->where('mois',$request->mois)
            ->where("numj",$jour5)
            ->get();
            foreach($val5 as $employe)
            {
            $emp=Employe::select("nom_emp","prenom_emp")
            ->where("id",$employe->id_emp)
            ->get();
            }
            foreach($emp as $item){
                $nom_emp=$item->nom_emp;
                $prenom_emp=$item->prenom_emp;

            }
            $data5[$jour5-1]=count($val5)*100/$nbreemployes;
        
        }
        $jour=NoteProbabiliteJournaliere::select('numj')->where('annee',$request->annee)
                                                        ->where('mois',$request->mois)
                                                        ->distinct()
                                                        ->get();
        
        $nomEmp=NoteProbabiliteJournaliere::select('id_emp','mention','numj')->where('annee',$request->annee)
                                                                             ->where('mois',$request->mois)
                                                                             ->get();

        $employenom=Employe::all();

        $mentionExcellents=NoteProbabiliteJournaliere::select('id_emp','mention','numj')->where('mention','Excellent')
                                                                                        ->where('annee',$request->annee)
                                                                                        ->where('mois',$request->mois)
                                                                                        ->get();

        $mentionBons=NoteProbabiliteJournaliere::select('id_emp','mention','numj')->where('mention','Bon')
                                                                                  ->where('annee',$request->annee)
                                                                                  ->where('mois',$request->mois)
                                                                                  ->get();

        $mentionMoyens=NoteProbabiliteJournaliere::select('id_emp','mention','numj')->where('mention','Moyen')
                                                                                    ->where('annee',$request->annee)
                                                                                    ->where('mois',$request->mois)
                                                                                    ->get();

        $mentionFaibles=NoteProbabiliteJournaliere::select('id_emp','mention','numj')->where('mention','Faible')
                                                                                     ->where('annee',$request->annee)
                                                                                     ->where('mois',$request->mois)
                                                                                     ->get();

        $mentionMediocres=NoteProbabiliteJournaliere::select('id_emp','mention','numj')->where('mention','Mediocre')
                                                                                       ->where('annee',$request->annee)
                                                                                       ->where('mois',$request->mois)
                                                                                       ->get();

        $data=[
            'data1' => $data1,
            'data2' => $data2,
            'data3' => $data3,
            'data4' => $data4,
            'data5' => $data5,
            'jour'=>$jour,
            'nomEmp'=>$nomEmp,
            'employenom'=>$employenom,
            'mentionExcellents'=>$mentionExcellents,
            'mentionBons'=>$mentionBons,
            'mentionMoyens'=>$mentionMoyens,
            'mentionFaibles'=>$mentionFaibles,
            'mentionMediocres'=>$mentionMediocres
        ];
        return response()->json($data);
    }
}
