<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produit;
use App\Models\TypeMesure;
use App\Models\ParametreMesure;
use App\Models\OrdreTravail;
use App\Models\OrdreDeTravailDeMesure;
use App\Models\OrdreTravailMesureTypeMesure;
use App\Models\MethodeValide;
use App\Models\MethodeNonValideQuantitativeVariablePhysique;
use App\Models\MethodeNonValideQualitative;
use App\Models\Certification;
use App\Models\TypeOutil;
use App\Models\MethodeNonValideQualitativeAvoirParametreMesure;
use App\Models\OrdreTravailMesureAvoirParametreMesure;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use App\Models\OperateurQualiteMesure;
use App\Models\OTMesureNonValide;
use App\Models\OTMesureValide;
use App\Models\Precision;


class OrdreDeTravailDeMesureController extends Controller
{
public function ListeDesOrdresDeTravailDeMesure(){
        $OTM=OrdreDeTravailDeMesure::all();
        return view("Ordre_De_Travail_De_Mesure.Liste_Des_Ordres_De_Travail_De_Mesure",compact('OTM'));
}
/************************************* */
public function CreerUnOrdreDeTravailDeMesure(){
        $produits=Produit::all();
        $type_mesures=TypeMesure::all();
        $testeurs=Certification::all();
        $operateurs=OperateurQualiteMesure::all();
        $criteres=DB::select('SELECT * FROM parametre_mesures as parametre 
        where parametre.critere=?',[true]);
        $etalons=TypeOutil::all()->where('Etalon',true);
        $precisions=Precision::all();
    


        return view("Ordre_De_Travail_De_Mesure.creer_un_ordre_de_travail_de_mesure",compact('precisions','etalons','operateurs','produits','type_mesures','testeurs','criteres'));
}
/************************************* */
public function Modifier($OTM){
        $OTMesure=OrdreDeTravailDeMesure::where('IDOrdreTravailMesure',$OTM)->first();
        $typeMesures=OrdreTravailMesureTypeMesure::where('IDOrdreTravailMesure',$OTM)->get();
        $avoirParametres= OrdreTravailMesureAvoirParametreMesure::all()->where('IDOrdreTravailMesure',$OTM);
        $MethodeValides=MethodeValide::all()->where('IDOrdreTravailMesure',$OTM);
        $MethodeNonValideQVs=MethodeNonValideQuantitativeVariablePhysique::all()->where('IDOrdreTravailMesure',$OTM);
        $methodes=MethodeNonValideQualitativeAvoirParametreMesure::all()->where('IDOTM',$OTM);
        $MethodeNonValideQs=MethodeNonValideQualitative::all()->where('IDOrdreTravailMesure',$OTM);
        $operateurs=OperateurQualiteMesure::all();
        // return dd($typeMesures,$avoirParametres,$MethodeValides,$MethodeNonValideQVs,$methodes,$MethodeNonValideQs );
        return view("Ordre_De_Travail_De_Mesure.Modifier_un_ordre_de_travail_de_mesure",compact('operateurs','methodes','OTMesure','typeMesures','avoirParametres','MethodeValides','MethodeNonValideQVs','MethodeNonValideQs','OTM'));
}
/***********************************************************findMachine**********************************************************************/
public function findMachine(Request $request){
        $data=DB::table('produits_construisables_machines')
                ->select('IDMachine')
                ->where('produits_construisables_machines.IDProduitConstruisable',$request->id)
                ->get();
              
      return response()->json($data);
}
/***************************************************************findParametre************************************************************** */
public function findParametre(Request $request){
  $data=ParametreMesure::select('DesParametreMesure')->where('DesTypeMesure',$request->id)
  ->where('critere',0)->get();          
  return response()->json($data);
}
/******************************************************************findTypeOutil************************************************************ */
public function findTypeOutil(Request $request){
    
    $data=DB::select('SELECT *  FROM avoir_parametre_mesure as parametre , type_outils as outil 
                    where parametre.DesTypeOutil = outil.DesTypeOutil and DesParametreMesure=? and Etalon=? ',[$request->id, false]);
          
  return response()->json($data);
}
//*****************************************************find etalon*************************
public function findEtalon(Request $request){
    
    $data=DB::select('SELECT DISTINCT DesTypeOutil FROM  avoir_parametre_mesure as parametre 
                    where  DesParametreMesure=? ',[$request->id]);
          
  return response()->json($data);
}
/******************************************************************findPrecision******************************************************************** */
public function findPrecision(Request $request){
        
    $data=DB::table('avoir_parametre_mesure')
            ->select('DesPrecision')
            ->where('avoir_parametre_mesure.DesParametreMesure',$request->id)->distinct()
            ->get();
          
  return response()->json($data);
}
/******************************************************************findPrecisionde l'etalon******************************************************************** */
public function Findprecisionetalon(Request $request){
        
    $data=DB::table('avoir_parametre_mesure')
            ->select('DesPrecision')
            ->where('avoir_parametre_mesure.DesParametreMesure',$request->id)->distinct()
            ->get();
          
  return response()->json($data);
}
//**********************************************find bon validation**************************** */
public function findBonValidation()
{
    $DesParametre=request()->get('parametre');
    $IDMachine=request()->get('machine');
    $DesProduit=request()->get('produit');
    $typemesure=request()->get('typemesure');
    if($IDMachine== null)
    {
        $data=DB::select('SELECT * FROM ordre_travail_test_validations as ordre , bon_de_validations as bon 
    where bon.IDOrdreTravailTestValidation = ordre.IDOTTV  and DesProduit=? and DesTypeMesure=? and DesParametreMesure=? ',[$DesProduit,$typemesure,$DesParametre]);
    }
    else{
        $data=DB::select('SELECT * FROM ordre_travail_test_validations as ordre , bon_de_validations as bon 
         where bon.IDOrdreTravailTestValidation = ordre.IDOTTV and  IDMachine=? and DesProduit=? and DesTypeMesure=? and DesParametreMesure=? ',[$IDMachine,$DesProduit,$typemesure,$DesParametre]);
    }
    
    return response()->json($data);
}
/************************************* */
public function verifTaillePeriode (Request $request)
{
    $data=DB::select(' SELECT Taille , Periode from test_taille_periode_valides as testValide , test_taille_periodes as test
                        Where  testValide.IDTestTaillePeriode = test.id and test.IDBonValidation=?',[$request->id]);
    return response()->json($data);
}
/************************************* */
 public function Append(Request $request)
 {
     $data=DB::select('SELECT  DISTINCT DesParametreMesure FROM avoir_parametre_mesure as parametre , type_outils as outil 
     where parametre.DesTypeOutil = outil.DesTypeOutil  and Etalon=?  ',[true]);
     return response()->json($data);
 }
/*********************************************************************store************************************************************************* */
public function store(Request $request)
{
        try
        {
        $OT=OrdreTravail::firstOrCreate([
            'IDOT'=>$request->input('OTM'),
            'TypeOrdre'=>'Mesure',
        ]);
        $OTM=OrdreDeTravailDeMesure::firstOrCreate([
            'IDOT'=>$OT->IDOT,
            'IDOrdreTravailMesure'=>$request->input('OTM'),
            'Date'=>$request->input('date'),
            'Description'=>$request->input('Description'),
            'IDOperateurMesure'=>$request->input('IDOperateurMesure'),
            'IDMachine'=>$request->input('IDMachine'),
            'IDDirecteur'=>1,
            'DesProduit'=>$request->input('produit'),
            'Etat'=>'en attente',
        ]);
        foreach($request->DesTypeMesure as  $key=>$DesTypeMesure)
        {
            $typemesureOTM=OrdreTravailMesureTypeMesure::firstOrCreate([
                'IDOrdreTravailMesure'=>$OTM->IDOrdreTravailMesure,
                'DesTypeMesure'=> $DesTypeMesure,
            ]);
        }


        // *********************************************************************************************************
        $DesTypeOutil        = $request -> DesTypeOutil;
        $DesParametreMesure  = $request -> DesParametreMesure;
        $DesPrecision        = $request -> DesPrecision;
        $IDOTM               = $request -> OTM;

        for($i=0; $i < count($DesPrecision); $i++)
        {    
            $datasave = [
                'IDOrdreTravailMesure'=> $IDOTM,
                'DesTypeOutil'        => $DesTypeOutil[$i],
                'DesParametreMesure'  => $DesParametreMesure[$i],
                'DesPrecision'        => $DesPrecision[$i]
            ];   
            DB::table('ordre_travail_mesure_avoir_parametre_mesures')->updateOrInsert($datasave);
        }
        //***************************************************bon valide**********************************************************
        $c=0;
        if($request->idmethodevalide != null)
        {
                $TolérenceSup          =$request->TolérenceSup;
                $TolérenceInf          =$request->TolérenceInf;
                $NbrPrelevement        =$request->NbrPrelevement;
                $PeriodePrelevement    =$request->PeriodePrelevement;
                $TailleEchantillon     =$request->TailleEchantillon;
                $IDBVV                 =$request->idmethodevalide;
                
                for($c=0; $c < count($IDBVV); $c++)
                {
                    if($NbrPrelevement[$c]=='1')
                    {
                        $GenrePrelevement ='Simple'; 
                    }
                    else{
                        $GenrePrelevement='Multiple';
                    }
                    $methode_valides=MethodeValide::firstOrCreate([    
                    'TolérenceSup'          =>$TolérenceSup[$c],
                    'TolérenceInf'          =>$TolérenceInf[$c],
                    'GenrePrelevement'      =>$GenrePrelevement,
                    'NbrPrelevement'        =>$NbrPrelevement[$c],
                    'PeriodePrelevement'    =>$PeriodePrelevement[$c],
                    'TailleEchantillon'     =>$TailleEchantillon[$c],
                    'IDBVV'                 =>$IDBVV[$c],
                    'IDOrdreTravailMesure'  =>$IDOTM,
                    ]);
                }
        }
        //*************************************************bon non valide quantitative variable physique *********************************************************
       $b=0;
        if($request->idmethodeNVQV != null)
        {
            $TolérenceSupNV         =$request->TolérenceSupNV;
            $TolérenceInfNV         =$request->TolérenceInfNV;
            $NbrPrelevementNV       =$request->NbrPrelevementNV;
            $IDBVNV                 =$request->idmethodeNVQV;
            for($b=0; $b < count($IDBVNV); $b++)
            {   
                if($NbrPrelevementNV[$b]=='1')
                {
                    $GenrePrelevementNV ='Simple'; 
                }
                else{
                    $GenrePrelevementNV='Multiple';
                }
                $methode_non_validesQV=MethodeNonValideQuantitativeVariablePhysique::firstOrCreate([    
                'TolérenceSup'          =>$TolérenceSupNV[$b],
                'TolérenceInf'          =>$TolérenceInfNV[$b],
                'GenrePrelevement'      =>$GenrePrelevementNV,
                'NbrPrelevement'        =>$NbrPrelevementNV[$b],
                'IDBVNV'                =>$IDBVNV[$b],
                'IDOrdreTravailMesure'  =>$IDOTM,
                ]);
            }
        }
        /******************************************bon non valide qualitative ********************************************************************** */
       $a=0;
        if($request->idmethodeNVQ != null)
        {
            $NbrPrelevementNVQ      =$request->NbrPrelevementNVQ;
            $IDBVNVQ                 =$request->idmethodeNVQ;
           
            for($a=0; $a < count($IDBVNVQ); $a++)
            {   
                if($NbrPrelevementNVQ[$a]=='1')
                {
                    $GenrePrelevementNVQ ='Simple'; 
                }
                else{
                    $GenrePrelevementNVQ='Multiple';
                }
                $methode_non_validesQ=MethodeNonValideQualitative::firstOrCreate([    
                'GenrePrelevement'      =>$GenrePrelevementNVQ,
                'NbrPrelevement'        =>$NbrPrelevementNVQ[$a],
                'IDBVNV'                =>$IDBVNVQ[$a],
                'IDOrdreTravailMesure'  =>$IDOTM,
              
                ]);

                $etalon = $request->Etalon;
                $critere= $request->Critere;
                $precisionetalon= $request->DesPrecisionnv;
                $testeur= $request-> Testeur;
                    for($j=0; $j < count($critere); $j++)
                    {
                        
                        $table= MethodeNonValideQualitativeAvoirParametreMesure::firstOrCreate([
                            'DTO'=>$etalon[$j]
                            ,'DPM'=>$critere[$j]
                            ,'DP'=> $precisionetalon[$j]
                            ,'IDBVNV'=>$IDBVNVQ[$a]
                            ,'DesT'=>$testeur[$j]
                            ,'IDOTM'=>$IDOTM
                        ]);
                    }

            }
        }
        $p=$a+$b+$c;
        if($p==$c)
        {
            $OTMV=OTMesureValide::firstOrCreate([
                'IDOTMesureValide'=>$OTM->IDOrdreTravailMesure,
                'IDOTM'=>$OTM->IDOrdreTravailMesure,
            ]);
        }
        else
        {
            $OTMNV=OTMesureNonValide::firstOrCreate([
                'IDOTMesureNonValide'=>$OTM->IDOrdreTravailMesure,
                'IDOTM'=>$OTM->IDOrdreTravailMesure,
            ]);
        }
        Alert::success('Réussite', "L'ordre de travail de mesure  est crée avec succès");
        return back();
        }
        catch(\Exception $e)
        {
           Alert::error('Erreur', "Erreur lors de la creation d'ordre de travail de mesure ");
           return back();
        
        }
}
/************************************************************update********************************************************************************* */
public function update(Request $request, $OTM)
{
    try
    {
     
        OrdreDeTravailDeMesure::where('IDOrdreTravailMesure',$OTM)->update([
            'Date'=>$request->input('date'),
            'Description'=>$request->input('Description'), 
        ]);
        $IDOTM=OrdreDeTravailDeMesure::where('IDOrdreTravailMesure',$request->input('OTM'))->first();
        //*************************************************************************************************************
        if($request->idmethodevalide != null)
        {
            $TolérenceSup          =$request->TolérenceSup;
            $TolérenceInf          =$request->TolérenceInf;
            $NbrPrelevement        =$request->NbrPrelevement;
            $PeriodePrelevement    =$request->PeriodePrelevement;
            $TailleEchantillon     =$request->TailleEchantillon;
            $IDBVV                 =$request->idmethodevalide;
            for($i=0; $i < count($IDBVV); $i++)
            {   
                if($NbrPrelevement[$i]=='1')
                    {
                        $GenrePrelevement ='Simple'; 
                    }
                    else{
                        $GenrePrelevement='Multiple';
                    }
                MethodeValide::where('IDOrdreTravailMesure',$OTM)->update
                ([    
                'TolérenceSup'          =>$TolérenceSup[$i],
                'TolérenceInf'          =>$TolérenceInf[$i],
                'GenrePrelevement'      =>$GenrePrelevement,
                'NbrPrelevement'        =>$NbrPrelevement[$i],
                'PeriodePrelevement'    =>$PeriodePrelevement[$i],
                'TailleEchantillon'     =>$TailleEchantillon[$i],
                'IDOrdreTravailMesure'  =>$IDOTM->IDOrdreTravailMesure,
                ]);
            }
        }
        //**********************************************************************************************************
        if($request->idmethodeNVQV != null)
        {
            $TolérenceSupNV         =$request->TolérenceSupNV;
            $TolérenceInfNV         =$request->TolérenceInfNV;
            $NbrPrelevementNV       =$request->NbrPrelevementNV;
            $IDBVNV                 =$request->idmethodeNVQV;
            for($i=0; $i < count($IDBVNV); $i++)
            { 
                if($NbrPrelevementNV[$i]=='1')
                {
                    $GenrePrelevementNV ='Simple'; 
                }
                else{
                    $GenrePrelevementNV='Multiple';
                }
                MethodeNonValideQuantitativeVariablePhysique::where('IDOrdreTravailMesure',$OTM)->update
                ([    
                'TolérenceSup'          =>$TolérenceSupNV[$i],
                'TolérenceInf'          =>$TolérenceInfNV[$i],
                'GenrePrelevement'      =>$GenrePrelevementNV,
                'NbrPrelevement'        =>$NbrPrelevementNV[$i],
                'IDOrdreTravailMesure'  =>$IDOTM->IDOrdreTravailMesure,
                ]);
            }
        }

        if($request->idmethodeNVQ != null)
        {
            $NbrPrelevementNVQ       =$request->NbrPrelevementNVQ;
            $IDBVNVQ                 =$request->idmethodeNVQ;
            for($i=0; $i < count($IDBVNVQ); $i++)
            {   
                if($NbrPrelevementNVQ[$i]=='1')
                {
                    $GenrePrelevementNVQ ='Simple'; 
                }
                else{
                    $GenrePrelevementNVQ='Multiple';
                }
                MethodeNonValideQualitative::where('IDOrdreTravailMesure',$OTM)->update
                ([    
                'GenrePrelevement'      =>$GenrePrelevementNVQ,
                'NbrPrelevement'        =>$NbrPrelevementNVQ[$i],
                'IDOrdreTravailMesure'  =>$IDOTM->IDOrdreTravailMesure,
                ]);
            }
        }
        Alert::success('Réussite', "L'ordre de travail de mesure  est modifée avec succès");
        return back();
    }
    catch(\Exception $e)
    {
       Alert::error('Erreur', "Erreur lors de la modification d'ordre de travail de mesure ");
       return back();
       
    }
}
/************************************************************destroy********************************************************************************* */
public function destroy($OTM)
{ 
          try{
        
        MethodeValide::where('IDOrdreTravailMesure',$OTM)->delete();
        MethodeNonValideQuantitativeVariablePhysique::where('IDOrdreTravailMesure',$OTM)->delete();
        MethodeNonValideQualitativeAvoirParametreMesure::where('IDOTM',$OTM)->delete();
        MethodeNonValideQualitative::where('IDOrdreTravailMesure',$OTM)->delete();
        OrdreDeTravailDeMesure::where('IDOrdreTravailMesure',$OTM)->delete();
        OrdreTravail::where('IDOT',$OTM)->delete();
        Alert::success('Réussite','ordre de travail de Mesure supprimé avec succès');
        return redirect()->route('ListeDesOrdresDeTravailDeMesure');
       }
       catch(\Exception $e)
       {
           Alert::error('Erreur', "Erreur lors du suppression de l'ordre de travail de Mesure");
           return back();
        }
}
/************************************************************vuPDF********************************************************************************* */
public function vuPDF($OTM){
        $OTMesure=OrdreDeTravailDeMesure::where('IDOrdreTravailMesure',$OTM)->first();
        $parametreMesures=ParametreMesure::all();
        $avoirParametres=OrdreTravailMesureAvoirParametreMesure::all()->where('IDOrdreTravailMesure',$OTM);
        $MethodeValides=MethodeValide::all()->where('IDOrdreTravailMesure',$OTM);
        $MethodeNonValideQVs=MethodeNonValideQuantitativeVariablePhysique::all()->where('IDOrdreTravailMesure',$OTM);
        $methodes=MethodeNonValideQualitativeAvoirParametreMesure::all()->where('IDOTM',$OTM);
        $MethodeNonValideQs=MethodeNonValideQualitative::all()->where('IDOrdreTravailMesure',$OTM);
        view()->share('OTMesure',$OTMesure);
        view()->share('parametreMesures',$parametreMesures);
        view()->share('avoirParametres',$avoirParametres);
        view()->share('MethodeValides',$MethodeValides);
        view()->share('MethodeNonValideQVs',$MethodeNonValideQVs);
        view()->share('methodes',$methodes);
        view()->share('MethodeNonValideQs',$MethodeNonValideQs);
        $pdf=PDF::loadView('Fiches\Fiche_De_Mesure');
        return $pdf->stream('Ordre De Travail De Mesure.pdf');
}
/************************************************************downloadPDF********************************************************************************* */
public function downloadPDF($OTM){
        $OTMesure=OrdreDeTravailDeMesure::where('IDOrdreTravailMesure',$OTM)->first();
        $parametreMesures=ParametreMesure::all();
        $avoirParametres=OrdreTravailMesureAvoirParametreMesure::all()->where('IDOrdreTravailMesure',$OTM);
        $MethodeValides=MethodeValide::all()->where('IDOrdreTravailMesure',$OTM);
        $MethodeNonValideQVs=MethodeNonValideQuantitativeVariablePhysique::all()->where('IDOrdreTravailMesure',$OTM);
        $methodes=MethodeNonValideQualitativeAvoirParametreMesure::all()->where('IDOTM',$OTM);
        $MethodeNonValideQs=MethodeNonValideQualitative::all()->where('IDOrdreTravailMesure',$OTM);
        view()->share('OTMesure',$OTMesure);
        view()->share('parametreMesures',$parametreMesures);
        view()->share('avoirParametres',$avoirParametres);
        view()->share('MethodeValides',$MethodeValides);
        view()->share('MethodeNonValideQVs',$MethodeNonValideQVs);
        view()->share('methodes',$methodes);
        view()->share('MethodeNonValideQs',$MethodeNonValideQs);
        $pdf=PDF::loadView('Fiches\Fiche_De_Mesure');
        return $pdf->download('Ordre De Travail De Mesure.pdf');
}
   
}
