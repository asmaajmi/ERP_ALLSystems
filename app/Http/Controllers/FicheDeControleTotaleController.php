<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\FicheDeControle;
use Illuminate\Support\Facades\DB;
use App\Models\OperateurQualiteMesure;
use App\Models\OrdreDeTravailDeMesure;
use App\Models\OrdreTravailMesureAvoirParametreMesure;
use App\Models\OrdreTravailMesureTypeMesure;
use App\Models\OTMesureNonValide;

use App\Models\OutilMesure;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;


class FicheDeControleTotaleController extends Controller
{
    public function ListeDeFicheDeControleTotale(){
        $FCs=FicheDeControle::all();
        $OTMs=OTMesureNonValide::all();
        $OPs=OperateurQualiteMesure::all();
        return view("Fiche_De_Controle_Totale.Liste_Des_Fiches_De_Controle_Totale",compact('FCs','OTMs','OPs'));
    }
    /***************************************************************************************** */
    public function AjoutUneFicheDeControleTotale(){
        $OTMs=OTMesureNonValide::all();
        return view("Fiche_De_Controle_Totale.creer_Une_Fiche_De_Controle_Totale",compact('OTMs'));
    }
    /***************************************************************************************** */
    public function FindInformationFC(Request $request)
    {
        $data=DB::select('SELECT * FROM o_t_mesure_non_valides as otmnv ,
                                        ordre_de_travail_de_mesures as OTM ,
                                        employes as emp ,
                                        operateur_qualite_mesures as oqm 
                                where OTM.IDOperateurMesure=oqm.id and
                                        emp.id=oqm.IDEmploye and
                                        OTM.IDOrdreTravailMesure=? and
                                        otmnv.IDOTMesureNonValide=? ',[$request->IDotm , $request->IDotm]);
        return response()->json($data);
    }
    /*find parametre/precision/outil/typemesure/tolerenceinf/tolerencesup/enregistrement dans le cas de  methode_non_valide_quantitative_variable_physiques*/
    public function FindInformationPPO(Request $request)
    {
        $data=DB::select('SELECT * FROM 
                ordre_travail_mesure_avoir_parametre_mesures as OTMAPM ,
                parametre_mesures as pm ,
                bon_de_validations as bv ,
                ordre_travail_test_validations as OTTV ,
                methode_non_valide_quantitative_variable_physiques as MNVQV,
                o_t_mesure_non_valides as otmnv 
                where 
                OTMAPM.DesParametreMesure=pm.DesParametreMesure and
                MNVQV.IDBVNV=bv.IDBV and
                bv.IDOrdreTravailTestValidation=OTTV.IDOTTV and
                OTTV.DesParametreMesure=pm.DesParametreMesure and
                MNVQV.IDOrdreTravailMesure =? and
                otmnv.IDOTMesureNonValide=? and
                OTMAPM.IDOrdreTravailMesure =? ',[$request->IDotm , $request->IDotm , $request->IDotm ] );
        return response()->json($data);
    }
    /*find parametre/precision/outil/typemesure/tolerenceinf/tolerencesup/enregistrement dans le cas de  methode_valides*/
    public function FindInformationPPOV(Request $request)
    {
        $data=DB::select('SELECT * FROM 
                ordre_travail_mesure_avoir_parametre_mesures as OTMAPM ,
                parametre_mesures as pm ,
                bon_de_validations as bv ,
                ordre_travail_test_validations as OTTV ,
                methode_valides as MV ,
                o_t_mesure_non_valides as otmnv 
                where
                OTMAPM.DesParametreMesure=pm.DesParametreMesure and
                MV.IDBVV=bv.IDBV and
                bv.IDOrdreTravailTestValidation=OTTV.IDOTTV and
                OTTV.DesParametreMesure=pm.DesParametreMesure and
                MV.IDOrdreTravailMesure =? and
                OTMAPM.IDOrdreTravailMesure =? and
                otmnv.IDOTMesureNonValide=?',
                [$request->IDotm , $request->IDotm ,$request->IDotm]);
        return response()->json($data);
    }
    /*find parametre/precision/outil/typemesure/enregistrement dans le cas de  methode_non_valide_qualitatives*/
    public function FindInformationPPONVQ(Request $request)
    {
        $data=DB::select('SELECT * FROM 
                ordre_travail_mesure_avoir_parametre_mesures as OTMAPM ,
                parametre_mesures as pm ,
                bon_de_validations as bv ,
                ordre_travail_test_validations as OTTV ,
                methode_non_valide_qualitatives as MNVQ ,
                o_t_mesure_non_valides as otmnv 
                where
                OTMAPM.DesParametreMesure=pm.DesParametreMesure and
                MNVQ.IDBVNV=bv.IDBV and 
                bv.IDOrdreTravailTestValidation=OTTV.IDOTTV and
                OTTV.DesParametreMesure=pm.DesParametreMesure and
                MNVQ.IDOrdreTravailMesure =? and
                OTMAPM.IDOrdreTravailMesure =? and
                otmnv.IDOTMesureNonValide=?',
                [$request->IDotm , $request->IDotm ,$request->IDotm] );
        return response()->json($data);
    }
    /****************************find test capabilité valide dans le cas de methode valide *******************************************/
    public function Find_Test_CapabiliteV(Request $request)
    {
        $data=DB::select('SELECT * FROM 
            
                bon_de_validations as bv ,
                methode_valides as MV ,
                test_capabilites as TC
                where
            
                bv.IDBV = MV.IDBVV and
                bv.IDBV = TC.IDBonValidation and
                MV.IDOrdreTravailMesure=? ',
                [$request->IDotm]) ;
        return response()->json($data);
    }
    /*************************find test capabilité valide dans le cas de methode_non_valide_quantitative_variable_physiques*********************************************/
        public function Find_Test_CapabiliteNVQV(Request $request)
        {
            $data=DB::select('SELECT * FROM 
                
                    bon_de_validations as bv ,
                    methode_non_valide_quantitative_variable_physiques as MNVQV ,
                    test_capabilites as TC
                    where
                
                    bv.IDBV = MNVQV.IDBVNV and
                    bv.IDBV = TC.IDBonValidation and
                    MNVQV.IDOrdreTravailMesure=?',
                    [$request->IDotm]) ;
            return response()->json($data);
        }
    /********************find test capabilité valide dans le cas de methode_non_valide_qualitatives **************************************************/
    public function Find_Test_CapabiliteNVQ(Request $request)
    {
        $data=DB::select('SELECT * FROM 
            
                bon_de_validations as bv ,
                methode_non_valide_qualitatives as MNVQ, 
                test_capabilites as TC
                where
            
                bv.IDBV = MNVQ.IDBVNV and
                bv.IDBV = TC.IDBonValidation and
                MNVQ.IDOrdreTravailMesure =?',
                [$request->IDotm]) ;
        return response()->json($data);
    }
    /****************************find test normalites valide dans le cas de methode valide *******************************************/
     public function Find_Test_NormaliteV(Request $request)
    {
        $data=DB::select('SELECT * FROM 
            
                bon_de_validations as bv ,
                methode_valides as MV ,
                test_normalites as TN
                where
            
                bv.IDBV = MV.IDBVV and
                bv.IDBV = TN.IDBonValidation and
                MV.IDOrdreTravailMesure=? ',
                [$request->IDotm]) ;
        return response()->json($data);
    }
    /*************************find test normalites valide dans le cas de methode_non_valide_quantitative_variable_physiques*********************************************/
    public function Find_Test_NormaliteNVQV(Request $request)
    {
        $data=DB::select('SELECT * FROM 
            
                bon_de_validations as bv ,
                methode_non_valide_quantitative_variable_physiques as MNVQV ,
                test_normalites as TN
                where
            
                bv.IDBV = MNVQV.IDBVNV and
                bv.IDBV = TN.IDBonValidation and
                MNVQV.IDOrdreTravailMesure=?',
                [$request->IDotm]) ;
        return response()->json($data);
    }
    /********************find test normalites valide dans le cas de methode_non_valide_qualitatives **************************************************/
     public function Find_Test_NormaliteNVQ(Request $request)
     {
        $data=DB::select('SELECT * FROM 
            
                bon_de_validations as bv ,
                methode_non_valide_qualitatives as MNVQ, 
                test_normalites as TN
                where
            
                bv.IDBV = MNVQ.IDBVNV and
                bv.IDBV = TN.IDBonValidation and
                MNVQ.IDOrdreTravailMesure =?',
                [$request->IDotm]) ;
        return response()->json($data);
     }
   
    /*****************************store*********************************************/
    public function store(Request $request)
    {
         try{
            $FC=FicheDeControle::firstOrCreate([
            'IDFC'=>$request->IDFC
            ,'DateFC'=>$request->DateFC
            ,'Totale_a_Controler'=>$request->Totale_a_Controler
            ,'Pourcentage_defaut_estime'=>$request->Pourcentage_defaut_estime
            ,'NombreDeMesure'=>$request->NombreDeMesure
            ,'Taille_Echantillon'=>$request->Taille_Echantillon
            ,'Cm_propose'=>$request->Cm_propose
            ,'Cmk_propose'=>$request->Cmk_propose
            ,'IDOTMNV'=>$request->IDOTM
            ]);
            //insertion dans la table fcinformation 
            $DesTypeOutil        = $request -> DesTypeOutil;
            $DesParametreMesure  = $request -> DesParametreMesure;
            $DesPrecision        = $request -> DesPrecision;
            $DesTypeMesure       = $request -> DesTypeMesure;
            $TolérenceInf        = $request -> TolérenceInf;
            $TolérenceSup        = $request -> TolérenceSup;
            $enregistrement      = $request -> enregistrement;
            for($i=0; $i < count($DesPrecision); $i++)
            {    
                $datasave = [
                    'FC'                  => $request->IDFC,
                    'enregistrement'      => $enregistrement[$i],
                    'TypeOutil'           => $DesTypeOutil[$i],
                    'DesParametreMesure'  => $DesParametreMesure[$i],
                    'DesPrecision'        => $DesPrecision[$i],
                    'TypeMesure'          => $DesTypeMesure[$i],
                    'tolinf'              =>(integer) $TolérenceInf[$i],
                    'tolsup'              =>(integer)$TolérenceSup[$i],
                ];   
                DB::table('fcinformation')->updateOrInsert($datasave);
            }
            $OTMs=OrdreDeTravailDeMesure::all();
            Alert::success('Réussite', 'Fiche de contrôle est crée avec succès');
            return view('Fiche_De_Controle_Totale.creer_une_Fiche_De_Controle_Totale',compact('FC','OTMs'));
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de la cration de la fiche de contrôle ");
            return back();
        }
    }
    /*****************************génération PDF*********************************/
     public function FCvuPDF($FC)
        {   
            $FCs=FicheDeControle::all()->where('IDFC',$FC);
            $otmtms=OrdreTravailMesureTypeMesure::all();
            $otmpops=OrdreTravailMesureAvoirParametreMesure::all();
            $data=DB::select('SELECT * FROM  fcinformation as fc  where fc.FC=?',[$FC]);
            $donnees=DB::select('SELECT * FROM  fcinformation as fc  where fc.FC=?',[$FC]);
            view()->share('FCs',$FCs);
            view()->share('FC',$FC);
            view()->share('otmpops',$otmpops);
            view()->share('otmtms',$otmtms);
            view()->share('data',$data);
            view()->share('donnees',$donnees);
            $FC =['IDFC' => 'IDFC'];
            $pdf=PDF::loadView('Fiche_De_Controle_Totale.fiche_de_controle',$FC);
            return $pdf->stream('fiche de controle.pdf');
         } 
    /********************************************************************************/
         public function TelechargePDF($FC)
         {
            $FCs=FicheDeControle::all()->where('IDFC',$FC);
            $otmtms=OrdreTravailMesureTypeMesure::all();
            $otmpops=OrdreTravailMesureAvoirParametreMesure::all();
            $data=DB::select('SELECT * FROM  fcinformation as fc  where fc.FC=?',[$FC]);
            $donnees=DB::select('SELECT * FROM  fcinformation as fc  where fc.FC=?',[$FC]);
            view()->share('FCs',$FCs);
            view()->share('FC',$FC);
            view()->share('otmpops',$otmpops);
            view()->share('otmtms',$otmtms);
            view()->share('data',$data);
            view()->share('donnees',$donnees);
            $FC =['IDFC' => 'IDFC'];
            $pdf=PDF::loadView('Fiche_De_Controle_Totale.fiche_de_controle',$FC);
            return $pdf->download('fiche de controle.pdf');
         } 
    /**********************************supprimer*****************************************/
         public function destroy($IDFC)
         {
             try{
            FicheDeControle::where("IDFC",$IDFC)->delete();
            Alert::success('Réussite', 'Fiche de contrôle supprimé avec succès');
            return redirect()->route('ListeDeFicheDeControleTotale.affiche');
            }
            catch(\Exception $e)
            {
                Alert::error('Erreur', "Erreur lors du suppression de la Fiche de contrôle");
                return back();
            }
        }
    /*************************************************Modifier**********************/
    public function ModifierFicheDeControleTotale ($IDFC)
    {   
        $donnees=DB::select('SELECT * FROM  fcinformation as fc  where fc.FC=?',[$IDFC]);
        $FC=FicheDeControle::where('IDFC',$IDFC)->first();
        $OTM=OrdreDeTravailDeMesure::first();
        $OTMs=OrdreDeTravailDeMesure::all();
        return view('Fiche_De_Controle_Totale.Modifier_une_Fiche_De_Controle_Totale',compact('IDFC','OTMs','FC','donnees','OTM'));
    }
    /************************************update**********************************/
    function update(Request $request,$IDFC)
    { 
        try
        {
                FicheDeControle::where('IDFC',$IDFC)->update
                ([
                'IDFC'=>$request->IDFC
                ,'DateFC'=>$request->DateFC
                ,'Totale_a_Controler'=>$request->Totale_a_Controler
                ,'Pourcentage_defaut_estime'=>$request->Pourcentage_defaut_estime
                ,'NombreDeMesure'=>$request->NombreDeMesure
                ,'Taille_Echantillon'=>$request->Taille_Echantillon
                ,'Cm_propose'=>$request->Cm_propose
                ,'Cmk_propose'=>$request->Cmk_propose
                ]);
                $OTMs=OrdreDeTravailDeMesure::all();
                $FCs=FicheDeControle::all();
            Alert::success('Réussite', 'Fiche de contrôle totale modifié avec succès');
            return view('Fiche_De_Controle_Totale.Liste_Des_Fiches_De_Controle_Totale', compact("IDFC","OTMs",'FCs'));
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de la modification de la Fiche de contrôle totale");
            return back();
        }
    } 

}


