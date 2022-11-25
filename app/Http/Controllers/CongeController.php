<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Employe;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\Models\CongePlanifie;
use App\Models\CongeNonPlanifie;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class CongeController extends Controller
{

//affichage de liste des congés planifiés
    public function CongePlanifie(){
        $employes=Employe::all();
        $conges=CongePlanifie::select('id')->get();
        $data=CongePlanifie::select('id','nbre_jours_nonpayés','nbre_jours_payés')->get()->groupBy(
            function($data){
                return ($data->nbre_jours_payés);
            });
                $jours=[];
                $count_jours=[];
                foreach ($data as $nbre=>$value)
                {

                    $jours[]=$nbre;
                    $count_jours[]=count($value);

                }
    return view("crudcongeplanifie",['data'=>$data,'jours'=> $jours,'count_jours'=>$count_jours],compact('employes','conges'));
}




//affichage de la liste selon l'employé choisi
    public function findcrud(Request $request){
        //$request->id here is the id of our chosen option id
        $data=CongePlanifie::select('id','date_debut_conge','date_fin_conge','designation_conge','nbre_jours_nonpayés','nbre_jours_payés')
                            ->where('id_emp',$request->idemp)->get();

        return response()->json($data);//then sent this data to ajax success
	}


    //supprimer le congé planifié
    public function deleteconge(CongePlanifie $conge){
        $employes=Employe::all();
        $conge->delete();
        return view('crudcongeplanifie',compact('employes'));
    }





    //la fonction qui retourne le formulaire pour les congés planifiés

    public function CongePlanifieform(){
        $employes=Employe::all();
        $conge=CongePlanifie::all();

        return view('formcongeplanifie',compact("employes","conge"));
    }



    //la fonction qui retourne le formulaire pour les congés non planifiés
    public function CongeNonPlanifieform(){
        $employes=Employe::all();
        $conge=CongePlanifie::all();
        return view('formcongenonplanifie',compact("employes","conge"));
    }

    //la fonction qui permet d'ajouter/créer les congés planifiés
    public function createcongeplanifie(Request $request){
      
        try
        {
            $id_emp=$request->input('id_emp');
                                    
            $date_debut_conge=$request->input('date_debut_conge');

            $date_fin_conge=$request->input('date_fin_conge');

            $desconge=$request->input('desconge');

            $id_emp=$request->input('id_emp');

            $payement=$request->input('payement');



            function dateDifference($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' )
            {
            
                $datetime1 = date_create($date_debut_conge);
                $datetime2 = date_create($date_fin_conge);
                
                $interval = date_diff($datetime1, $datetime2);
                
                return $interval->format($differenceFormat);
                
            }
                
        
            $congeplanifie =CongePlanifie::create([
            'id_emp'=>$id_emp ,
            'date_debut_conge'=>$date_debut_conge,
            'date_fin_conge'=>$date_fin_conge,
            'designation_conge'=>$desconge,
            'payement_conge'=>$payement,
            'annee'=>Carbon::createFromFormat('Y-m-d', $date_debut_conge)->format('Y'),
            'mois'=>Carbon::createFromFormat('Y-m-d', $date_debut_conge)->format('m'),
            'mois_fin'=>Carbon::createFromFormat('Y-m-d', $date_fin_conge)->format('m'),
            'validation_conge'=>$request->input('validation'),
            ]);


            if($desconge=='Conge Maladie')
            {   
                $congemaladie='Conge Maladie';
                $valeureseuilmaladie=Employe::select('var_seuil_conge_maladie','id')->where('id',$id_emp)->get();
                $x=dateDifference($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' );

                foreach( $valeureseuilmaladie as $item){

                    if($item->var_seuil_conge_maladie>=$x)
                    {
                        $valeurupdate=$item->var_seuil_conge_maladie-$x;
                        Employe::where('id',$id_emp)->update(['var_seuil_conge_maladie' => $valeurupdate]);
                        DB::table('conge_planifies')->where('id_emp',$id_emp)
                                                    ->where('designation_conge',$congemaladie)
                                                    ->where('date_debut_conge',$date_debut_conge)
                                                    ->where('date_fin_conge',$date_fin_conge)
                                                    ->update(['payement_conge' => 1,'nbre_jours_nonpayés' => 0,'nbre_jours_payés'=>$x]);

                    }

                    else{
                        $valeurupdate2=$item->var_seuil_conge_maladie-$x;
                        if($valeurupdate2<0){
                            $c_maladie=$item->var_seuil_conge_maladie;
                            $jrmalanpaye=$x-$c_maladie;
                            $jrmalapaye=$x-$jrmalanpaye;
                            Employe::where('id',$id_emp)->update(['var_seuil_conge_maladie' => 0]);
                            DB::table('conge_planifies')->where('id_emp',$id_emp)
                                                        ->where('designation_conge',$congemaladie)
                                                        ->where('date_debut_conge',$date_debut_conge)
                                                        ->where('date_fin_conge',$date_fin_conge)
                                                        ->update(['nbre_jours_nonpayés' => $jrmalanpaye,'nbre_jours_payés'=>$jrmalapaye]);
                            
                        }
                        
                    }
                }
            }


            else if($desconge=='Conge Annuel')
            {
                $congeannuel='Conge Annuel';
                $valeurannuel=Employe::select('var_seuil_conge_annuel','id')->where('id',$id_emp)->get();
                $x2=dateDifference($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' );

                foreach( $valeurannuel as $item){

                    if($item->var_seuil_conge_annuel>=$x2){
                        $valeurannuelupdate=$item->var_seuil_conge_annuel-$x2;
                        Employe::where('id',$id_emp)->update(['var_seuil_conge_annuel' => $valeurannuelupdate]);
                        DB::table('conge_planifies')->where('id_emp',$id_emp)
                                                    ->where('designation_conge',$congeannuel)
                                                    ->where('date_debut_conge',$date_debut_conge)
                                                    ->where('date_fin_conge',$date_fin_conge)
                                                    ->update(['payement_conge' => 1,'nbre_jours_nonpayés' => 0,'nbre_jours_payés'=>$x2]);

                    }

                    else{
                        $valeurupdate=$item->var_seuil_conge_annuel-$x2;
                        if($valeurupdate<0){
                            $c_annuel=$item->var_seuil_conge_annuel;
                            $jrannuelnpaye=$x2-$c_annuel;
                            $jrannuelpaye=$x2-$jrannuelnpaye;
                            Employe::where('id',$id_emp)->update(['var_seuil_conge_annuel' => 0]);
                            DB::table('conge_planifies')->where('id_emp',$id_emp)
                                                        ->where('designation_conge',$congeannuel)
                                                        ->where('date_debut_conge',$date_debut_conge)
                                                        ->where('date_fin_conge',$date_fin_conge)
                                                        ->update(['nbre_jours_nonpayés' => $jrannuelnpaye,'nbre_jours_payés'=>$jrannuelpaye]);
                            
                        }
                        
                    }
                }
            }


            else if($desconge=='Conge Accidentel')
            {
                $congeaccide='Conge Accidentel';
                $valeureaccidentel=Employe::select('var_seuil_conge_accidentel','id')->where('id',$id_emp)->get();
                $x3=dateDifference($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' );

                foreach( $valeureaccidentel as $item){

                    if($item->var_seuil_conge_accidentel>=$x3){
                        $valeurupdate=$item->var_seuil_conge_accidentel-$x3;
                        Employe::where('id',$id_emp)->update(['var_seuil_conge_accidentel' => $valeurupdate]);
                        DB::table('conge_planifies')->where('id_emp',$id_emp)
                                                    ->where('designation_conge',$congeaccide)
                                                    ->where('date_debut_conge',$date_debut_conge)
                                                    ->where('date_fin_conge',$date_fin_conge)
                                                    ->update(['payement_conge' => 1,'nbre_jours_nonpayés' => 0,'nbre_jours_payés'=>$x3]);

                    }

                    else{
                        $valeurupdate=$item->var_seuil_conge_accidentel-$x3;
                        if($valeurupdate<0){
                            $c_accidentelle=$item->var_seuil_conge_accidentel;
                            $jraccidenpaye=$x3-$c_accidentelle;
                            $jraccidepaye=$x3-$jraccidenpaye;
                            Employe::where('id',$id_emp)->update(['var_seuil_conge_accidentel' => 0]);
                            DB::table('conge_planifies')->where('id_emp',$id_emp)
                                                        ->where('designation_conge',$congeaccide)
                                                        ->where('date_debut_conge',$date_debut_conge)
                                                        ->where('date_fin_conge',$date_fin_conge)
                                                        ->update(['nbre_jours_nonpayés' => $jraccidenpaye,'nbre_jours_payés'=>$jraccidepaye]);
                            
                        }
                        
                    }
                }
            }
            else if (($payement==1)&&($desconge !='Conge Accidentel')&&($desconge!='Conge Annuel')&&($desconge!='Conge Maladie'))
                {
                    $jourautre=dateDifference($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' );
                    DB::table('conge_planifies')->where('id_emp',$id_emp)
                    ->where('date_debut_conge',$date_debut_conge)
                    ->where('date_fin_conge',$date_fin_conge)
                    ->update(['nbre_jours_nonpayés' => 0,'nbre_jours_payés'=>$jourautre]);

                    }
                
            else
                    {
                    $jourautre=dateDifference($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' );
                    DB::table('conge_planifies')->where('id_emp',$id_emp)
                    ->where('date_debut_conge',$date_debut_conge)
                    ->where('date_fin_conge',$date_fin_conge)
                    ->update(['nbre_jours_nonpayés' => $jourautre,'nbre_jours_payés'=>0]);

                }

            return redirect()->route('congeplanifie.list')
            ->with('success', 'Création effectuée aves succès !'); 
        }


        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');

        }
                
    }


    //la fonction qui permet d'ajouter/créer les congés planifiés
    public function createcongeNonplanifie(Request $request){
      
        try
        {
            $id_emp=$request->input('id_emp');
                                    
            $date_debut_conge=$request->input('date_debut_conge');

            $date_fin_conge=$request->input('date_fin_conge');

            $desconge=$request->input('desconge');

            $id_emp=$request->input('id_emp');

            $payement=$request->input('payement');



            function dateDifference_nonplanifie($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' )
            {
            
                $datetime1 = date_create($date_debut_conge);
                $datetime2 = date_create($date_fin_conge);
                
                $interval = date_diff($datetime1, $datetime2);
                
                return $interval->format($differenceFormat);
                
            }
                
        
            $congeplanifie =CongeNonPlanifie::create([
            'id_emp'=>$id_emp ,
            'date_debut_conge'=>$date_debut_conge,
            'date_fin_conge'=>$date_fin_conge,
            'designation_conge'=>$desconge,
            'annee'=>Carbon::createFromFormat('Y-m-d', $date_debut_conge)->format('Y'),
            'mois'=>Carbon::createFromFormat('Y-m-d', $date_debut_conge)->format('m'),
            'mois_fin'=>Carbon::createFromFormat('Y-m-d', $date_fin_conge)->format('m'),
            'payement_conge'=>$payement            
            ]);


            if($desconge=='Conge Maladie')
            {   
                $congemaladie='Conge Maladie';
                $valeureseuilmaladie=Employe::select('var_seuil_conge_maladie','id')->where('id',$id_emp)->get();
                $x=dateDifference_nonplanifie($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' );

                foreach( $valeureseuilmaladie as $item){

                    if($item->var_seuil_conge_maladie>=$x)
                    {
                        $valeurupdate=$item->var_seuil_conge_maladie-$x;
                        Employe::where('id',$id_emp)->update(['var_seuil_conge_maladie' => $valeurupdate]);
                        DB::table('conge_non_planifies')->where('id_emp',$id_emp)
                                                    ->where('designation_conge',$congemaladie)
                                                    ->where('date_debut_conge',$date_debut_conge)
                                                    ->where('date_fin_conge',$date_fin_conge)
                                                    ->update(['payement_conge' => 1,'nbre_jours_nonpayés' => 0,'nbre_jours_payés'=>$x]);

                    }

                    else{
                        $valeurupdate2=$item->var_seuil_conge_maladie-$x;
                        if($valeurupdate2<0){
                            $c_maladie=$item->var_seuil_conge_maladie;
                            $jrmalanpaye=$x-$c_maladie;
                            $jrmalapaye=$x-$jrmalanpaye;
                            Employe::where('id',$id_emp)->update(['var_seuil_conge_maladie' => 0]);
                            DB::table('conge_non_planifies')->where('id_emp',$id_emp)
                                                        ->where('designation_conge',$congemaladie)
                                                        ->where('date_debut_conge',$date_debut_conge)
                                                        ->where('date_fin_conge',$date_fin_conge)
                                                        ->update(['nbre_jours_nonpayés' => $jrmalanpaye,'nbre_jours_payés'=>$jrmalapaye]);
                            
                        }
                        
                    }
                }
            }


            else if($desconge=='Conge Annuel')
            {
                $congeannuel='Conge Annuel';
                $valeurannuel=Employe::select('var_seuil_conge_annuel','id')->where('id',$id_emp)->get();
                $x2=dateDifference_nonplanifie($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' );

                foreach( $valeurannuel as $item){

                    if($item->var_seuil_conge_annuel>=$x2){
                        $valeurannuelupdate=$item->var_seuil_conge_annuel-$x2;
                        Employe::where('id',$id_emp)->update(['var_seuil_conge_annuel' => $valeurannuelupdate]);
                        DB::table('conge_non_planifies')->where('id_emp',$id_emp)
                                                    ->where('designation_conge',$congeannuel)
                                                    ->where('date_debut_conge',$date_debut_conge)
                                                    ->where('date_fin_conge',$date_fin_conge)
                                                    ->update(['payement_conge' => 1,'nbre_jours_nonpayés' => 0,'nbre_jours_payés'=>$x2]);

                    }

                    else{
                        $valeurupdate=$item->var_seuil_conge_annuel-$x2;
                        if($valeurupdate<0){
                            $c_annuel=$item->var_seuil_conge_annuel;
                            $jrannuelnpaye=$x2-$c_annuel;
                            $jrannuelpaye=$x2-$jrannuelnpaye;
                            Employe::where('id',$id_emp)->update(['var_seuil_conge_annuel' => 0]);
                            DB::table('conge_non_planifies')->where('id_emp',$id_emp)
                                                        ->where('designation_conge',$congeannuel)
                                                        ->where('date_debut_conge',$date_debut_conge)
                                                        ->where('date_fin_conge',$date_fin_conge)
                                                        ->update(['nbre_jours_nonpayés' => $jrannuelnpaye,'nbre_jours_payés'=>$jrannuelpaye]);
                            
                        }
                        
                    }
                }
            }


            else if($desconge=='Conge Accidentel')
            {
                $congeaccide='Conge Accidentel';
                $valeureaccidentel=Employe::select('var_seuil_conge_accidentel','id')->where('id',$id_emp)->get();
                $x3=dateDifference_nonplanifie($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' );

                foreach( $valeureaccidentel as $item){

                    if($item->var_seuil_conge_accidentel>=$x3){
                        $valeurupdate=$item->var_seuil_conge_accidentel-$x3;
                        Employe::where('id',$id_emp)->update(['var_seuil_conge_accidentel' => $valeurupdate]);
                        DB::table('conge_non_planifies')->where('id_emp',$id_emp)
                                                    ->where('designation_conge',$congeaccide)
                                                    ->where('date_debut_conge',$date_debut_conge)
                                                    ->where('date_fin_conge',$date_fin_conge)
                                                    ->update(['payement_conge' => 1,'nbre_jours_nonpayés' => 0,'nbre_jours_payés'=>$x3]);

                    }

                    else{
                        $valeurupdate=$item->var_seuil_conge_accidentel-$x3;
                        if($valeurupdate<0){
                            $c_accidentelle=$item->var_seuil_conge_accidentel;
                            $jraccidenpaye=$x3-$c_accidentelle;
                            $jraccidepaye=$x3-$jraccidenpaye;
                            Employe::where('id',$id_emp)->update(['var_seuil_conge_accidentel' => 0]);
                            DB::table('conge_non_planifies')->where('id_emp',$id_emp)
                                                        ->where('designation_conge',$congeaccide)
                                                        ->where('date_debut_conge',$date_debut_conge)
                                                        ->where('date_fin_conge',$date_fin_conge)
                                                        ->update(['nbre_jours_nonpayés' => $jraccidenpaye,'nbre_jours_payés'=>$jraccidepaye]);
                            
                        }
                        
                    }
                }
            }
            else if (($payement==1)&&($desconge !='Conge Accidentel')&&($desconge!='Conge Annuel')&&($desconge!='Conge Maladie'))
                {
                    $jourautre=dateDifference_nonplanifie($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' );
                    DB::table('conge_non_planifies')->where('id_emp',$id_emp)
                    ->where('date_debut_conge',$date_debut_conge)
                    ->where('date_fin_conge',$date_fin_conge)
                    ->update(['nbre_jours_nonpayés' => 0,'nbre_jours_payés'=>$jourautre]);

                    }
                
            else
                    {
                    $jourautre=dateDifference_nonplanifie($date_debut_conge , $date_fin_conge , $differenceFormat = '%a' );
                    DB::table('conge_non_planifies')->where('id_emp',$id_emp)
                    ->where('date_debut_conge',$date_debut_conge)
                    ->where('date_fin_conge',$date_fin_conge)
                    ->update(['nbre_jours_nonpayés' => $jourautre,'nbre_jours_payés'=>0]);

                }

            return redirect()->route('congenonplanifie.list')
            ->with('success', 'Création effectuée avec succès !'); 
        }


        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');

        }
                
    }
    //affichage de liste des congés non planifiés

    public function CongeNonPlanifie(){
        $employes=Employe::all();
        $conges=CongeNonPlanifie::select('id')->get();
        return view("crudcongenonplanifie",compact('employes','conges'));
    }


    //affichage de la liste selon l'employé choisi
    public function findcrudNonPlanifie(Request $request){
        //$request->id here is the id of our chosen option id
        $data=CongeNonPlanifie::select('id','date_debut_conge','date_fin_conge','designation_conge','nbre_jours_nonpayés','nbre_jours_payés')
                            ->where('id_emp',$request->idemp)->get();

        return response()->json($data);//then sent this data to ajax success
    }

    //supprimer le congé non planifié
    public function deletecongeNonPlanifié(CongeNonPlanifie $conge){
        $employes=Employe::all();
        $conge->delete();
        return view('crudcongeplanifie',compact('employes'));
    }
   
}
