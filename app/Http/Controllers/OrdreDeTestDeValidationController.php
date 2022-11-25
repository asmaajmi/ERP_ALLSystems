<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\OrdreTravailTestValidation;
use App\Models\Capabilite;
use App\Models\Machine;
use App\Models\Normalite;
use App\Models\TypeOutil;
use App\Models\ParametreMesure;
use App\Models\Precision;
use App\Models\Produit;
use App\Models\ResponsableQualite;
use App\Models\TaillePeriode;
use App\Models\TypeMesure;
use App\Models\AvoirParametreMesure;
use Illuminate\Support\Facades\DB;
use App\Models\OutilMesure;
use App\Models\ProduitAchetable;
use App\Models\ProduitConstruisable;
use RealRashid\SweetAlert\Facades\Alert;
use phpDocumentor\Reflection\Types\Float_;
use PDF;
use Brick\Math\BigInteger;
use App\Models\OrdreTravail;



class OrdreDeTestDeValidationController extends Controller
{
       //******************************************afficher liste des ordres de travail test de validation ********************************
       public function ListeDesOrdresDeTestDeValidation(){
        $ordretravailtestvalidations=OrdreTravailTestValidation::all();
        $ordretravailtestvalidations=OrdreTravailTestValidation::orderBy('IDOTTV')->paginate(10);
        return view("Ordre_De_Travail_De_Test_De_Validation.Liste_Des_Ordres_De_Test_De_Validation",compact('ordretravailtestvalidations'));
    }
    //*******************************supprimer un ordre de travail test de validation **********************************
    public function destroy( $ordretravailtestvalidation)
    {   try{
        
        OrdreTravailTestValidation::where('IDOTTV',$ordretravailtestvalidation)->delete();
        OrdreTravail::where('IDOT',$ordretravailtestvalidation)->delete();
        Alert::success('Réussite', 'ordre de travail test de validation supprimé avec succès');
        return redirect()->route('ListeDesOrdresDeTestDeValidation');
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors du suppression de l'ordre de travail test de validation");
            return back();
        }
    }
     //**********************************supprimer all*******************************

     //*****************************génération PDF*********************************
    
     public function afficherPDF($ordretravailtestvalidation)

        {   
            $ordretravailtestvalidations=OrdreTravailTestValidation::all()->where('IDOTTV',$ordretravailtestvalidation);
            $capabilites=Capabilite::all()->where('IDOrdreTestValidation',$ordretravailtestvalidation);
            $normalites=Normalite::all()->where('IDOrdreTestValidation',$ordretravailtestvalidation);
            $taille_periodes=TaillePeriode::all()->where('IDOrdreTestValidation',$ordretravailtestvalidation);     
            view()->share('ordretravailtestvalidations',$ordretravailtestvalidations);
            view()->share('capabilites',$capabilites);
            view()->share('normalites',$normalites);
            view()->share('taille_periodes',$taille_periodes);
            $pdf=PDF::loadView('Fiches.Fiche_Test_De_Validation');
            return $pdf->stream('Fiche de test de validation.pdf');
           
        }
     public function enregistrerPDF($ordretravailtestvalidation){
            $ordretravailtestvalidations=OrdreTravailTestValidation::all()->where('IDOTTV',$ordretravailtestvalidation);
            $capabilites=Capabilite::all()->where('IDOrdreTestValidation',$ordretravailtestvalidation);
            $normalites=Normalite::all()->where('IDOrdreTestValidation',$ordretravailtestvalidation);
            $taille_periodes=TaillePeriode::all()->where('IDOrdreTestValidation',$ordretravailtestvalidation);     
            view()->share('ordretravailtestvalidations',$ordretravailtestvalidations);
            view()->share('capabilites',$capabilites);
            view()->share('normalites',$normalites);
            view()->share('taille_periodes',$taille_periodes);
            $pdf=PDF::loadView('Fiches.Fiche_Test_De_Validation');
            return $pdf->download('Fiche de test de validation.pdf');
     } 
      //*******************************affichage de la view de l'ajout de l'ordre de test de validation******************************
    public function CreerUnOrdreDeTestDeValidation(){
        $responsablequalites=ResponsableQualite::all();
        $produits=Produit::all();
        $type_mesures=TypeMesure::all();
        $type_outils=TypeOutil::all()->where('Etalon',false);
        $outil_mesures=OutilMesure::all();
        $parametre_mesures=ParametreMesure::all();
        $precisions=Precision::all();
        $avoir_parametre_mesure=AvoirParametreMesure::all();
        $machines=Machine::all();
        $produit_construisables=ProduitConstruisable::all();
        $produit_achetables=ProduitAchetable::all();
        return view("Ordre_De_Travail_De_Test_De_Validation.Creer_Un_Ordre_De_Test_De_Validation",compact('produit_achetables','produit_construisables','machines','precisions','parametre_mesures','avoir_parametre_mesure','type_outils','responsablequalites','produits','type_mesures','outil_mesures'));
    }
  

 

     
    //***********************************ajouter un ordre de travail de test de validation**********************************
    function store(Request $request)
    { 
        try
        {
            $OT=OrdreTravail::firstOrCreate([
                'IDOT'=>$request->input('IDOTTV'),
                'TypeOrdre'=>'Test De Validation',
            ]);

            $objectifs = implode(' ',$request->input('Objectif'));
            $ordretravailtestvalidations=OrdreTravailTestValidation::firstOrCreate([
            'IDOTTV'=>$request->input('IDOTTV'),
            'IDOT'=>$OT->IDOT,
            'DateOrdreTestValidation'=>$request->input('DateOrdreTestValidation'),
            'Objectif'=>$objectifs,
            'Description'=>$request->input('Description'),
            'IDResponsable'=>$request->input('IDResponsable'),
            'IDDirecteur'=>'1',
            'IDMachine'=>$request->input('IDMachine'),
            'DesProduit'=>$request->input('DesProduit'),
            'DesTypeOutil'=>$request->input('DesTypeOutil'),
            'DesParametreMesure'=>$request->input('DesParametreMesure'),
            'DesPrecision'=>$request->input('DesPrecision'),
            'DesTypeMesure'=>$request->input('DesTypeMesure'),
            'Etat'=>'En attend'
            ]);
            foreach($request->Objectif as  $key=>$Objectif)
        {
            switch($Objectif){
                case'Capabilite':
                    $capabilite=Capabilite::firstOrCreate([
                        'CapabiliteMinimale'=>(float)$request->input('CapabiliteMinimale'),
                        'IDOrdreTestValidation'=>$ordretravailtestvalidations->IDOTTV,
                    ]);
                    break;
                case'Normalite':
                    $normalite=Normalite::firstOrCreate([
                        'ValeurNormalite'=>(float)$request->input('ValeurNormalite'),
                        'IDOrdreTestValidation'=>$ordretravailtestvalidations->IDOTTV,
                    ]);
                    break;
                case'Taille_Periode':
                    $tailleperiode=TaillePeriode::firstOrCreate([
                        'TailleMinimale'=>(float)$request->input('TailleMinimale'),
                        'TailleMaximale'=>(float)$request->input('TailleMaximale'),
                        'PeriodeMinimale'=>(float)$request->input('PeriodeMinimale'),
                        'PeriodeMaximale'=>(float)$request->input('PeriodeMaximale'),
                        'IDOrdreTestValidation'=>$ordretravailtestvalidations->IDOTTV,
                    ]);
                    break;
            }
         }
         
            Alert::success('Réussite', 'Ordre du travail du test de validation ajouté avec succès');
       return back();
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de l'ajout d'ordre du travaille du test de validation");
            return back();
        }
    }
     //****************************************edit un ordre de travail de test de validation********************************
     public function ModifierUnOrdreDeTravailDeTestDeValidation($ordretravailtestvalidation)
     {   $taille_periodes=TaillePeriode::all()->where('IDOrdreTestValidation',$ordretravailtestvalidation);
         $precisions=Precision::all();
         $type_mesures=TypeMesure::all();
         $parametre_mesures=ParametreMesure::all();
         $type_outils=TypeOutil::all()->where('Etalon',false);
         $machines=Machine::all();
         $produits=Produit::all();
         $objectif=OrdreTravailTestValidation::where('IDOTTV',$ordretravailtestvalidation)->pluck('Objectif');
         $responsablequalites=ResponsableQualite::all();
         $ordretravailtestvalidations=OrdreTravailTestValidation::all()->where('IDOTTV',$ordretravailtestvalidation);
         $capabiltes=Capabilite::all()->where('IDOrdreTestValidation',$ordretravailtestvalidation);
         $normalites=Normalite::all()->where('IDOrdreTestValidation',$ordretravailtestvalidation);
         return view('Ordre_De_Travail_De_Test_De_Validation.Modifier_Un_Ordre_De_Test_De_Validation',compact('ordretravailtestvalidation','objectif','normalites','capabiltes','taille_periodes','precisions','type_mesures','ordretravailtestvalidations','responsablequalites','produits','machines','type_outils','parametre_mesures',));
     }
     //***************************Modifier un ordre de travail de test de validation*************************************
     function update(Request $request,$ordretravailtestvalidation)
     { 
         try
         {
            
             OrdreTravail::where('IDOT',$ordretravailtestvalidation)->update
             ([
                'IDOT'=>$request->input('IDOTTV'),
             ]);

             OrdreTravailTestValidation::where('IDOTTV', $ordretravailtestvalidation)->update
             ([  
                 'IDOTTV'=>$request->input('IDOTTV'),   
                 'DateOrdreTestValidation'=>$request->input('DateOrdreTestValidation'),
                 'Description'=>$request->input('Description'),
                 'IDResponsable'=>$request->input('IDResponsable'),
                 'IDDirecteur'=>(int)$request->input('IDResponsable'),
                 'IDOT'=>$request->input('IDOTTV',),
                 'Etat'=>'non envoyé'
              ]);
           $ordre=OrdreTravailTestValidation::where('IDOTTV',$request->input('IDOTTV'))->first();
                $objectifs=explode(' ',$ordre->Objectif);
              foreach($objectifs as  $Objectif)
              {
                  switch($Objectif)
                  {
                      case'Capabilite':
                        Capabilite::where('IDOrdreTestValidation',$ordretravailtestvalidation)->update
                        ([
                            'CapabiliteMinimale'=>(float)$request->input('CapabiliteMinimale'),
                            'IDOrdreTestValidation'=>$request->input('IDOTTV'),
                        ]);
                         
                          break;
                      case'Normalite':
                        Normalite::where('IDOrdreTestValidation',$ordretravailtestvalidation)->update
                        ([
                              'IDOrdreTestValidation'=>$request->input('IDOTTV'),
                             'ValeurNormalite'=>(float)$request->input('ValeurNormalite'),
                            ]);
                          break;
                      case'Taille_Periode':
                        TaillePeriode::where('IDOrdreTestValidation',$ordretravailtestvalidation)->update
                        ([
                           'IDOrdreTestValidation'=>$request->input('IDOTTV'),
                             'TailleMinimale'=>(float)$request->input('TailleMinimale'),
                             'TailleMaximale'=>(float)$request->input('TailleMaximale'),
                             'PeriodeMinimale'=>(float)$request->input('PeriodeMinimale'),
                             'PeriodeMaximale'=>(float)$request->input('PeriodeMaximale'),
                            ]);
                         break;
                    }
              }
             $ordretravailtestvalidation=OrdreTravailTestValidation::all();
             $ordretravailtestvalidations = OrdreTravailTestValidation::orderBy('IDOTTV')->paginate(12);
             Alert::success('Réussite', 'Ordre du traville du test de validation modifié avec succès');
             return view('Ordre_De_Travail_De_Test_De_Validation.Liste_Des_Ordres_De_Test_De_Validation', compact("ordretravailtestvalidations"));
         }
         catch(\Exception $e)
         {
             Alert::error('Erreur', "Erreur lors de la modification d'ordre du travaille du test de validation");
             return back();
         }
     }  

     //**************************** les fonction des recherche *******************************
     public function findMachineOTV(Request $request){
    

        $data=DB::table('produits_construisables_machines')
                ->select('IDMachine')
                ->where('produits_construisables_machines.IDProduitConstruisable',$request->id)
                ->get();
              
      return response()->json($data);
	}

    public function findParametreOTV(Request $request){
    

        $data=DB::table('avoir_parametre_mesure')
                ->select('DesParametreMesure')
                ->where('avoir_parametre_mesure.DesTypeOutil',$request->id)
                ->get();
              
      return response()->json($data);
	}

    public function findTypeMesureOTV(Request $request){
    

        $data=DB::table('parametre_mesures')
                ->select('DesTypeMesure')
                ->where('parametre_mesures.DesParametreMesure',$request->id)
                ->get();
              
      return response()->json($data);
	}

    public function findDesPrecisionOTV(Request $request){
        
        $data=DB::table('avoir_parametre_mesure')
                ->select('DesPrecision')
                ->where('avoir_parametre_mesure.DesParametreMesure',$request->id)
                ->get();
              
      return response()->json($data);
	}

    public function findNormalite(){
	 
        $DesParametre=request()->get('DesParametre');
        $IDMachine=request()->get('IDMachine');
        $DesProduit=request()->get('DesProduit');
 
        $data=OrdreTravailTestValidation::select()->where('DesParametreMesure',$DesParametre)
                                             ->where('DesProduit',$DesProduit)
                                             ->where('IDMachine',$IDMachine)
                                             ->where('Objectif','LIKE','%Normalite%')
                                             ->get();
 
        return response()->json($data);
    }

    public function findCapabilite(){
	 
        $DesParametre=request()->get('DesParametre');
        $IDMachine=request()->get('IDMachine');
        $DesProduit=request()->get('DesProduit');
 
        $data=OrdreTravailTestValidation::select()->where('DesParametreMesure',$DesParametre)
                                             ->where('DesProduit',$DesProduit)
                                             ->where('IDMachine',$IDMachine)
                                             ->where('Objectif','LIKE','%Capabilite%')
                                             ->get();
 
        return response()->json($data);
    }
}
