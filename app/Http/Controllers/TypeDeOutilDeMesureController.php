<?php

namespace App\Http\Controllers;
use App\Models\Precision;
use App\Models\TypeOutil;
use App\Models\TypeMesure;
use Illuminate\Http\Request;
use App\Models\ParametreMesure;
use Illuminate\Support\Facades\DB;
use App\Models\AvoirParametreMesure;
use App\Models\OutilMesure;
use RealRashid\SweetAlert\Facades\Alert;

class TypeDeOutilDeMesureController extends Controller
{
    public function ListeTypeOutilDeMesure()
    {
        $type_outils =TypeOutil::all();
        $precisions =Precision::all();
        $parametre_mesures=ParametreMesure::all();
        $avoir_parametre_mesures=AvoirParametreMesure::all();
        $outils=OutilMesure::all();
        return view("type_De_Outil_De_Mesure.Liste_Type_De_Outil_De_Mesure",compact('outils','parametre_mesures','avoir_parametre_mesures','precisions','type_outils'));   
    }
    /****************************************************** */
    public function AjoutUnTypeDeOutilDeMesure(){
        
        return view("type_De_Outil_De_Mesure.Ajout_Un_Type_De_Outil_De_Mesure");
    }
    /****************************************************** */
    public function delete($type_outil){
        try{
            TypeOutil::where('DesTypeOutil',$type_outil)->delete();
            Alert::success('Réussite', 'Type Outil supprimé avec succès');
            return redirect('/ListeTypeOutil');
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors du suppression de la type d'outil");
            return back();
        }
    }
    /****************************************************** */
    function store(Request $request){   
        // try
        // { 
             //insertion de type de mesure
             foreach($request->DesTypeMesure as $key=>$DesTypeMesure)
             {
                 $DesTypeMesure=TypeMesure::firstOrCreate(
                     ['DesTypeMesure' => $DesTypeMesure],
                 );
                 $DesTypeMesure->save();
             }
            // insertion de type d'outil
             $typeoutil=TypeOutil::firstOrCreate([

                'DesTypeOutil'=>$request->input('DesTypeOutil'),
                'Etalon' => $request->input('Categorie'),
             ]);
       
             //insertion dans la table parametre mesure
             $DesParametreMesure  = $request -> DesParametreMesure;
             $DesTypeMesure       = $request->DesTypeMesure;
 
             for($i=0; $i < count($DesParametreMesure); $i++)
             { 
                 
                 DB::table('parametre_mesures')->updateOrInsert(
                     ['DesParametreMesure'  => $DesParametreMesure[$i]],
                     [ 'DesTypeMesure'       => $DesTypeMesure[$i],
                     'critere'               => $request->input('Categorie')],
                     
                 );
     
             }
         
             // insertion dans la table precision
             foreach($request->DesPrecision as $key=>$DesPrecision)
             {
             
                 $precision=Precision::firstOrCreate(
                     ['DesPrecision' => $DesPrecision],
                 );
                 $precision->save();
             }
             //insertion dans la table avoir_parametre_mesure 
             $DesTypeOutil        = $request -> DesTypeOutil;
             $DesParametreMesure  = $request -> DesParametreMesure;
             $DesPrecision        = $request -> DesPrecision;
 
             for($i=0; $i < count($DesPrecision); $i++)
             {    
                 $datasave = [
                     
                     'DesTypeOutil'        => $DesTypeOutil,
                     'DesParametreMesure'  => $DesParametreMesure[$i],
                     'DesPrecision'        => $DesPrecision[$i]
                 ];   
                 DB::table('avoir_parametre_mesure')->updateOrInsert($datasave);
             }
             //affichage
             $typeoutils=TypeOutil::all();
              Alert::success('Réussite', 'Type Outil ajouté avec succès');
             return view('type_De_Outil_De_Mesure.Ajout_Un_Type_De_Outil_De_Mesure', compact("typeoutils"));
        // }
        // catch(\Exception $e)
        // {
        //     Alert::error('Erreur', "Erreur lors de l'ajout ");
        //     return back();
        // }
    }
    /********************************************** */
    public function ModifierUnTypeOutilDeMesure($type_outil){ 
        $typeoutilmesures=TypeOutil::all()->where('DesTypeOutil',$type_outil);
        $typemesures=TypeMesure::all();
        $avoir_parametre_mesures=AvoirParametreMesure::all();
        $parametre_mesures=ParametreMesure::all();
        $outils=OutilMesure::all();
        $Etalons=TypeOutil::select('Etalon')->distinct()->pluck('Etalon');
        return view('type_De_Outil_De_Mesure.Modifier_Un_Type_De_Outil_De_Mesure',compact('Etalons','outils','typeoutilmesures','typemesures','avoir_parametre_mesures','parametre_mesures','type_outil'));
    }
    /********************************************** */
    public function update(Request $request, $type_outil){
        // try
        // { 
             //update de type de mesure
             foreach($request->DesTypeMesure as $key=>$DesTypeMesure)
             {
                 $DesTypeMesure=TypeMesure::firstOrCreate(
                     ['DesTypeMesure' => $DesTypeMesure],
                 );
                 $DesTypeMesure->save();
             }
            // update de type d'outil
               
                $datasave =[
                    'DesTypeOutil'=>$request->input('DesTypeOutil'),
                    'Etalon' => $request->input('Categorie'),
                 ];
                 DB::table('type_outils')->where('DesTypeOutil',$type_outil)->update($datasave);
              
            
       
            //update dans la table parametre mesure
            $DesParametreMesure  = $request -> DesParametreMesure;
            $DesTypeMesure       = $request->DesTypeMesure;

            for($i=0; $i < count($DesParametreMesure); $i++)
            { 
                
                DB::table('parametre_mesures')->updateOrInsert(
                    ['DesParametreMesure'  => $DesParametreMesure[$i]],
                    [ 'DesTypeMesure'       => $DesTypeMesure[$i],
                    'critere'               => $request->input('Categorie')],
                    
                );
    
            }
            // update dans la table precision
            foreach($request->DesPrecision as $key=>$DesPrecision)
            {
            
                $precision=Precision::updateOrCreate(
                    ['DesPrecision' => $DesPrecision],
                );
                // $precision->save();
            }
            //update dans la table avoir_parametre_mesure 
            $DesTypeOutil        = $request -> DesTypeOutil;
            $DesParametreMesure  = $request -> DesParametreMesure;
            $DesPrecision        = $request -> DesPrecision;

            for($i=0; $i < count($DesPrecision); $i++)
            {    
                $datasave = [
                    
                    'DesTypeOutil'        => $DesTypeOutil,
                    'DesParametreMesure'  => $DesParametreMesure[$i],
                    'DesPrecision'        => $DesPrecision[$i]
                ];   
                DB::table('avoir_parametre_mesure')->updateOrInsert($datasave);
            }
            //affichage
            $type_outils=TypeOutil::all();
            $outils=OutilMesure::all();
            $Etalons=TypeOutil::all()->pluck('Etalon');
            //  Alert::success('Réussite', 'Outil modifié avec succès');
             return view('type_De_Outil_De_Mesure.Liste_Type_De_Outil_De_Mesure', compact('Etalons',"type_outils",'outils'));
        // }
        // catch(\Exception $e)
        // {
        //     Alert::error('Erreur', "Erreur lors de la modification de l'outil");
        //     return back();
            
        // }
    }
}
