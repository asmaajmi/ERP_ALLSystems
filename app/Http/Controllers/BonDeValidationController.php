<?php

namespace App\Http\Controllers;

use App\Models\AvoirParametreMesure;
use PDF;
use App\Models\Precision;
use App\Models\TypeOutil;
use Illuminate\Http\Request;
use App\Models\TestNormalite;
use App\Models\TestCapabilite;
use App\Models\BonDeValidation;
use App\Models\TestTaillePeriode;
use Illuminate\Support\Facades\DB;
use App\Models\BonDeValidationValide;
use App\Models\OperateurQualiteMesure;
use App\Models\TestTaillePeriodeValide;
use App\Models\BonDeValidationNonValide;
use RealRashid\SweetAlert\Facades\Alert;
use phpDocumentor\Reflection\Types\Null_;
use App\Models\OrdreTravailTestValidation;
use App\Models\TestTaillePeriodeNonValide;
use App\Models\TestCapabiliteOperateurMesure;
use DateTime;
use Illuminate\Support\Carbon;
use PhpParser\Node\Stmt\Function_;
use App\Models\Normalite;
use App\Models\Capabilite;
use App\Models\TaillePeriode;
use phpDocumentor\Reflection\PseudoTypes\False_;
use phpDocumentor\Reflection\PseudoTypes\True_;

class BonDeValidationController extends Controller
{
    // ***********************************affiche la liste des bons de validation*********************************
    public function ListeDesBonsDeValidation(){
        $BonDeValidations=BonDeValidation::all();
        return view("Bon_De_Validation.Liste_Des_Bons_De_Validation",compact('BonDeValidations'));
    }

     // ***********************************affiche la page d'ajout d'un bon de validation****************
    public function AjoutUnBonDeValidation(){
        $operateurmesures=OperateurQualiteMesure::all();
        $type_outils=TypeOutil::all();
        $precisions=Precision::all();
        return view("Bon_De_Validation.Creer_Un_Bon_De_Validation",compact('operateurmesures','type_outils','precisions'));
    }

     // ***********************************Ajouter un bon de validation****************
    function store(Request $request)
    {   
           try{
            // insertion de la bon de validation
          
            $TypeDuTests = implode(' ',$request->input('TypeDuTest'));

            if(strstr( $TypeDuTests,'Echantillonnage')==FALSE){
                $validation_bon_validation=FALSE;
            }
            else
            {
                $validation_bon_validation=$request->input('ValiditeEchantillonnage');
            }
            $BonDeValidation =BonDeValidation::firstOrCreate([
                
                'IDBV'=>$request->input('IDBV'),
                'DateValidation'=>$request->input('Date'),
                'TypeDuTest'=>$TypeDuTests,
                'ValidationOrdreTravail'=>$request->input('ValidationOrdreTravail'),
                'ValidationBonValidation'=>$validation_bon_validation,
                'Etat'=>'En attend',
                'IDOrdreTravailTestValidation'=>$request->input('IDOrdreTravailTestValidation'),
            ]);
            if($validation_bon_validation){
                
                    $BonDeValidationValide = BonDeValidationValide::firstOrCreate([
                        'IDBonValidation'=>$BonDeValidation->IDBV,
                        'IDBVV'=>$BonDeValidation->IDBV,
                    ]);
                }
                else   
                {

                    $BonDeValidationNonValide = BonDeValidationNonValide::firstOrCreate([
                        'IDBonValidation'=>$BonDeValidation->IDBV,
                       'IDBVNV'=>$BonDeValidation->IDBV,
                    ]); 
                
                }
            foreach($request->TypeDuTest as  $key=>$type_test)
            {
                switch($type_test){
                    case'Capabilite':
                    // ********************insertion de la test de capabilité************************
                        $TestCapabilite = TestCapabilite::firstOrCreate([
                            'CapabiliteMesure'=>(float)$request->input('CapabiliteMesure'),
                            'Validation'=>$request->input('ValiditeCapabilite'),
                            'DesTypeOutil'=>$request->input('DesTypeOutil'),
                            'DesParametreMesure'=>$request->input('DesParametreMesure'),
                            'DesPrecision'=>$request->input('DesPrecision'),
                            'IDBonValidation'=>$BonDeValidation->IDBV,
                        ]); 
                        // *********************** insertion de capabilité-operateur**********************
                        foreach($request->IDOperateurMesure as $key=>$IDOperateurMesure)
                        {
                        
                            $capabilite_operateur=TestCapabiliteOperateurMesure::firstOrCreate(
                                ['IDOperateurMesure' => $IDOperateurMesure,
                                'IDTestCapabilite'=> $TestCapabilite->id],
                            );
                            $capabilite_operateur->save();
                        }
                        break;
                    case'Normalite':
                            // ******************insertion de la test de normalité**************************
                            $TestNormalite = TestNormalite::firstOrCreate([
                                'NormaliteMesure'=>(float)$request->input('NormaliteMesure'),
                                'Validation'=>$request->input('ValiditeNormalite'),
                                'IDBonValidation'=>$BonDeValidation->IDBV,
                            ]);
                        break;
                        
                    case'Echantillonnage':
                        // ***********************insertion de la test_taille_periode**************************
                            $TestTaillePeriode = TestTaillePeriode::firstOrCreate([
                                'Validation'=>$request->input('ValiditeEchantillonnage'),
                                'IDBonValidation'=>$BonDeValidation->IDBV,
                            ]);

                            if($request->input('ValiditeEchantillonnage') == "0"){
                                    // **************************insertion de la test_taille_periode_non_valide***********************
                                    $TestTaillePeriodeNonValide = TestTaillePeriodeNonValide::firstOrCreate([
                                        'TailleMaxTeste'             =>(float)$request->input('TailleMaxTeste'),
                                        'PeriodeMinTeste'            =>(float)$request->input('PeriodeMinTeste'),
                                        'Cause'              =>$request->input('Cause'),
                                        'IDTestTaillePeriode'=>$TestTaillePeriode->id,
                                    ]);
                            }
                            if($request->input('ValiditeEchantillonnage') == "1"){
                                    // ******************insertion de la test_taille_periode_valide***************************
                                    $TestTaillePeriodeValide = TestTaillePeriodeValide::firstOrCreate([
                                        'Taille'             =>(float)$request->input('Taille'),
                                        'Periode'            =>(float)$request->input('Periode'),
                                    'IDTestTaillePeriode'=>$TestTaillePeriode->id,
                                ]);
                                }
                        break;
                        
                }
            }
            //********************affichage****************
            Alert::success('Réussite', 'Le bon de validation est crée avec succès');
            $BonDeValidations=BonDeValidation::all();
            $operateurmesures=OperateurQualiteMesure::all();
            $type_outils=TypeOutil::all();
            $precisions=Precision::all();
            return view('Bon_De_Validation.Creer_Un_Bon_De_Validation', compact("BonDeValidations",'operateurmesures','type_outils','precisions'));
        }
         catch(\Exception $e)
         {
            Alert::error('Erreur', "Erreur lors de la creation de bon de validation ");
            return back();
            
         }

    }
    //*************************************************Modifier***************** */
    public function ModifierUnBonDeValidation ($BonDeValidation)
    {   
       $BonValidations=BonDeValidation::where('IDBV',$BonDeValidation)->first();
        $TestCapabilite=TestCapabilite::where('IDBonValidation',$BonDeValidation)->first();
        $TestNormalite=TestNormalite::where('IDBonValidation',$BonDeValidation)->first();
        $TestTaille=TestTaillePeriode::where('IDBonValidation',$BonDeValidation)->first();
            $TestTaillePeriodeValides=TestTaillePeriodeValide::all();
            $TestTaillePeriodeNonValides=TestTaillePeriodeNonValide::all();
            $operateurmesures=OperateurQualiteMesure::all();
            $tests=TestCapabiliteOperateurMesure::all();
        return view('Bon_De_Validation.Modifier_Un_Bon_De_Validation',compact('tests','operateurmesures','TestTaillePeriodeNonValides','TestCapabilite','TestTaille','BonDeValidation','BonValidations','TestTaillePeriodeValides','TestNormalite'));
    }

    //*************************************************Update***************** */
    function update(Request $request, $BonDeValidation)
    {   
          try{
            // modifier de la bon de validation
          $bonvalidation=BonDeValidation::where('IDBV',$BonDeValidation)->first();
          $TypeDuTest=explode(' ',$bonvalidation->TypeDuTest);
         BonDeValidation::where('IDBV',$BonDeValidation)->update
         ([
                'IDBV'=>$request->input('IDBV'),
                'DateValidation'=>$request->input('Date'),
                'ValidationOrdreTravail'=>$request->input('ValidationOrdreTravail'),
            ]);
             if($bonvalidation->ValidationBonValidation==0){
            //*********** */ modifier de la Bon_De_Validation_Non_Valide***************
              BonDeValidationNonValide::where('IDBonValidation',$BonDeValidation)->update
              ([
                    'IDBonValidation'=>$request->input('IDBV'),
                   'IDBVNV'=>$request->input('IDBV'),
                ]);
            }
             else{
            //**************** */ modifier de la Bon_De_Validation_Valide******************
                 BonDeValidationValide::where('IDBonValidation',$request->input('IDBV'))->update
                 ([
                    'IDBonValidation'=>$request->input('IDBV'),
                    'IDBVV'=>$request->input('IDBV'),
                ]);
            }
            foreach($TypeDuTest as  $type_test)
            {
                switch($type_test){
                    case'Capabilite':
                    // ********************modifier de la test de capabilité************************
                        TestCapabilite::where('IDBonValidation',$BonDeValidation)->update
                        ([
                            'CapabiliteMesure'=>(float)$request->input('CapabiliteMesure'),
                            'IDBonValidation'=>$request->input('IDBV'),
                        ]); 
                        $capabilite=TestCapabilite::where('IDBonValidation',$request->input('IDBV'))->first();
                       
                        break;
                    case'Normalite':
                            // ******************modifier de la test de normalité**************************
                          TestNormalite::where('IDBonValidation',$BonDeValidation)->update([
                                'NormaliteMesure'=>(float)$request->input('NormaliteMesure'),
                                'IDBonValidation'=>$request->input('IDBV'),
                            ]);
                        break;
                        
                    case'Echantillonnage':
                        // ***********************modifier de la test_taille_periode**************************
                            TestTaillePeriode::where('IDBonValidation',$BonDeValidation)->update([
                                'IDBonValidation'=>$request->input('IDBV'),
                            ]);
                            $TestTaillePeriode=TestTaillePeriode::where('IDBonValidation',$request->input('IDBV'))->first();
                            if($TestTaillePeriode->Validation ==0){
                                    // **************************modifier de la test_taille_periode_non_valide***********************
                            TestTaillePeriodeNonValide::where( 'IDTestTaillePeriode',$TestTaillePeriode->id)->update
                            ([
                                        'TailleMaxTeste'             =>(float)$request->input('TailleMaxTeste'),
                                        'PeriodeMinTeste'            =>(float)$request->input('PeriodeMinTeste'),
                                        'Cause'              =>$request->input('Cause'),
                                        'IDTestTaillePeriode'=>$TestTaillePeriode->id,
                                    ]);
                            }
                            else{
                                    // ******************modifier de la test_taille_periode_valide***************************
                                    TestTaillePeriodeValide::where( 'IDTestTaillePeriode',$TestTaillePeriode->id)->update([
                                        'Taille'             =>(float)$request->input('Taille'),
                                        'Periode'            =>(float)$request->input('Periode'),
                                    'IDTestTaillePeriode'=>$TestTaillePeriode->id,
                                ]);
                                }
                        break;
                        
                }
            }
            //********************affichage****************
         Alert::success('Réussite', 'Le bon de validation est modifié avec succès');
            $BonDeValidations=BonDeValidation::all();
            $operateurmesures=OperateurQualiteMesure::all();
            $type_outils=TypeOutil::all();
            $precisions=Precision::all();
            return view('Bon_De_Validation.Liste_Des_Bons_De_Validation', compact("BonDeValidations",'operateurmesures','type_outils','precisions'));
        }
         catch(\Exception $e)
         {
            Alert::error('Erreur', "Erreur lors de la creation de bon de validation ");
            return back();
            
         }

    }
    
    // ********************Suprimer********************
    public function destroy($BonDeValidation)
     {
         try{
        BonDeValidation::where("IDBV",$BonDeValidation)->delete();
        Alert::success('Réussite', 'Bon de validation supprimé avec succès');
        return redirect()->route('ListeDesBonsDeValidation.affiche');
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors du suppression de Bon de validation");
            return back();
        }
    }
    //**************************génération PDF*********************
    
    public function afficherPDF($BonDeValidation)

    {   
        $BonDeValidations=BonDeValidation::all()->where('IDBV',$BonDeValidation);
        $ordretravailtestvalidations=OrdreTravailTestValidation::all();
        $capabilites=TestCapabilite::all()->where('IDBonValidation',$BonDeValidation);
        $normalites=TestNormalite::all()->where('IDBonValidation',$BonDeValidation);
        $taille_periodes=TestTaillePeriode::all()->where('IDBonValidation',$BonDeValidation);
        $taille_periodes_non_valides=TestTaillePeriodeNonValide::all();
        $taille_periodes_valides=TestTaillePeriodeValide::all();
        $test_capabilite_operateur_mesures=TestCapabiliteOperateurMesure::all();
        $operateur_qualite_mesures=OperateurQualiteMesure::all();
        view()->share('BonDeValidations',$BonDeValidations);
        view()->share('ordretravailtestvalidations',$ordretravailtestvalidations);
        view()->share('capabilites',$capabilites);
        view()->share('normalites',$normalites);
        view()->share('taille_periodes',$taille_periodes);
        view()->share('operateur_qualite_mesures',$operateur_qualite_mesures);
        view()->share('test_capabilite_operateur_mesures',$test_capabilite_operateur_mesures);
        view()->share('taille_periodes_valides',$taille_periodes_valides);
        view()->share('taille_periodes_non_valides',$taille_periodes_non_valides);
        $pdf=PDF::loadView('Fiches\Bon_De_Validation');
        return $pdf->stream('Bon de validation.pdf');
     }   
     public function enregistrerPDF($BonDeValidation){
        $BonDeValidations=BonDeValidation::all()->where('IDBV',$BonDeValidation);
        $ordretravailtestvalidations=OrdreTravailTestValidation::all();
        $capabilites=TestCapabilite::all()->where('IDBonValidation',$BonDeValidation);
        $normalites=TestNormalite::all()->where('IDBonValidation',$BonDeValidation);
        $taille_periodes=TestTaillePeriode::all()->where('IDBonValidation',$BonDeValidation);
        $taille_periodes_non_valides=TestTaillePeriodeNonValide::all();
        $taille_periodes_valides=TestTaillePeriodeValide::all();
        $test_capabilite_operateur_mesures=TestCapabiliteOperateurMesure::all();
        $operateur_qualite_mesures=OperateurQualiteMesure::all();
        view()->share('BonDeValidations',$BonDeValidations);
        view()->share('ordretravailtestvalidations',$ordretravailtestvalidations);
        view()->share('capabilites',$capabilites);
        view()->share('normalites',$normalites);
        view()->share('taille_periodes',$taille_periodes);
        view()->share('operateur_qualite_mesures',$operateur_qualite_mesures);
        view()->share('test_capabilite_operateur_mesures',$test_capabilite_operateur_mesures);
        view()->share('taille_periodes_valides',$taille_periodes_valides);
        view()->share('taille_periodes_non_valides',$taille_periodes_non_valides);
        $pdf=PDF::loadView('Fiches\Bon_De_Validation');
        return $pdf->download('Bon de validation.pdf');
     }  
     //**************************** les fonction du recherche en Ajax*************************
     public function findinformation(Request $request){
	
		
		$data=OrdreTravailTestValidation::select('IDMachine','DesProduit','DesParametreMesure','DesTypeOutil','DesPrecision')->where('IDOTTV',$request->id)->first();
		
    	return response()->json($data);
	} 
    public function findprecision(Request $request){
	
		
		$data=AvoirParametreMesure::select('DesPrecision')->where('DesTypeOutil',$request->id)
                                                             ->where('DesParametreMesure',$request->par)->distinct()->get();
		
    	return response()->json($data);
	} 

    public function findTypeOutil(Request $request)
    {
        $data=TypeOutil::all()->where('Etalon',false);
        return response()->json($data);

    }
  
    public function findCapabiliteOT(Request $request){
 
        $data=OrdreTravailTestValidation::select()->where('IDOTTV',$request->id)
                                             ->where('Objectif','LIKE','Capabilite%')
                                             ->get();
 
        return response()->json($data);
    }
    public function findNormaliteOT(Request $request){
 
        $data=OrdreTravailTestValidation::select()->where('IDOTTV',$request->id)
                                             ->where('Objectif','LIKE','%Normalite%')
                                             ->get();
 
        return response()->json($data);
    }
    public function findEchantillonnageOT(Request $request){
 
        $data=OrdreTravailTestValidation::select()->where('IDOTTV',$request->id)
                                             ->where('Objectif','LIKE','%Taille_Periode')
                                             ->get();
 
        return response()->json($data);
    }

    public function findNormaliteMinimale(Request $request)
    {
        $data=Normalite::select("ValeurNormalite")->where("IDOrdreTestValidation",$request->id)->first();

        return response()->json($data);
    }
}
