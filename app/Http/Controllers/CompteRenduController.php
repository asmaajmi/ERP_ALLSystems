<?php

namespace App\Http\Controllers;

use App\Models\Caisse;
use PDF;
use App\Models\CompteRendu;
use Illuminate\Http\Request;
use App\Models\FicheDeControle;
use App\Models\SuivieDesRebuts;
use App\Models\SuivieDesDrebus1;
use Illuminate\Support\Facades\DB;
use App\Models\OperateurQualiteCalcul;
use RealRashid\SweetAlert\Facades\Alert;

class CompteRenduController extends Controller
{
      /***************************************affiche la liste des compte rendu********************************************/
    public function ListeDeCompteRendu(){

        $CRs=CompteRendu::all();
        return view("Compte_Rendu.Liste_Des_Comptes_Rendus",compact('CRs'));
    }
    /***************************************affiche l'interface de l'ajout********************************************/
    public function AjoutCompteRendu(){
        $FCs=FicheDeControle::all();
        $ops=OperateurQualiteCalcul::all();
        return view("Compte_Rendu.creer_Un_Compte_Rendu",compact('FCs','ops'));
    }
    /*********find information sur fiche contrôle et ordre de travail de mesure non valide *******************************/
    public function FindFC_OTM (Request $request)
    {
        $data=DB::select('SELECT * FROM fiche_de_controles as FC , ordre_travail_mesure_avoir_parametre_mesures as OTMAPM  where OTMAPM.IDOrdreTravailMesure=FC.IDOTMNV and FC.IDFC=? ',[$request->FC]);
        return response()->json($data);
    }
    /******************************************plus********************************************************************/
    public function plus(Request $request){
        $data=DB::select('SELECT * FROM fiche_de_controles as FC , ordre_travail_mesure_avoir_parametre_mesures as OTMAPM  where OTMAPM.IDOrdreTravailMesure=FC.IDOTMNV and FC.IDFC=? ',[$request->FC]);
        return response()->json($data);
    }
    /************************************************storecr*************************************************************/
    public function storecr(Request $request)
    { 
        try
        {
            $CR=CompteRendu::firstOrCreate([
                'IDCR'=>$request->input('IDCR'),
                'DateCR'=>$request->input('DateCR'),
                'TotaleControler'=>$request->input('TotaleControler'),
                'SommeDefautsTotale'=>$request->input('SommeDefautsTotale'),
                'Pourcentage_defaut_reel'=>$request->input('Pourcentage_defaut_reel'),
                'Cm_mesure'=>$request->input('Cm_mesure'),
                'Cmk_mesure'=>$request->input('Cmk_mesure'),
                'Description'=>$request->input('Description'),
                'IDFC'=>$request->input('IDFC'),
                'IDOperateurCalcul'=>$request->input('IDOperateurCalcul'),
            ]);
     
           
             $PourcentagePartielle = $request -> PourcentagePartielle;
             $DesParametreMesure   = $request -> DesParametreMesure;
             $Date_Encaissement    = $request -> date;
           
               //insertion dans la table Suivie de rebut
             for($j=0;$j<count($DesParametreMesure);$j++)
             {
                
                    $datasave = [
                        'Date_Encaissement'           =>$Date_Encaissement[$j],
                        'PourcentagePartielle'        =>(float)$PourcentagePartielle[$j],
                        'DesParametreMesure'          => $DesParametreMesure[$j],
                        'IDCR'                        => $request->input('IDCR'),
                    ];   
                    DB::table('suivie_des_rebuts')->updateOrInsert($datasave);
                    $nbp=$DesParametreMesure[$j].'Nbr_Pieces';
                    $nc=$DesParametreMesure[$j].'Ncaisse';
                    $r=$DesParametreMesure[$j].'Remarque';
                    $Nbr_Pieces           = $request -> input($nbp);
                    $Ncaisse              = $request -> input($nc);
                    $Remarque             = $request -> input($r);
                    for($i=0; $i < count($Remarque); $i++)
                    {    
                      $caisse=Caisse::firstOrCreate(
                          ['Ncaisse' => $Ncaisse[$i]],
                      );
                      $caisse->save();
                        $datasave = [
                            'Nbr_Pieces'                  =>$Nbr_Pieces[$i],
                            'DesParametreMesure'          => $DesParametreMesure[$j],
                            'Remarque'                    => $Remarque[$i],
                            'Ncaisse'                     => $Ncaisse[$i],
                            'IDCR'                        => $request->input('IDCR'),
                        ];   
                        DB::table('suivie_des_drebus1s')->updateOrInsert($datasave);
                    }
                }
        
       
         
          Alert::success('Réussite', 'Compte_rendu créer avec succès');
            $FCs=FicheDeControle::all();
            $ops=OperateurQualiteCalcul::all();
            return view('Compte_Rendu.creer_Un_Compte_Rendu',compact('FCs','ops'));
            return dd(count($Remarque));
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de la création du Compte_rendu");
            return back();
        }
    }
    /************************************************supprimer*****************************************/
     public function destroy($IDCR)
     {
        try{
        CompteRendu::where("IDCR",$IDCR)->delete();
        Alert::success('Réussite', 'Compte-Rendu supprimé avec succès');
        return redirect()->route('ListeDeCompteRendu.affiche');
         }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors du suppression du Compte-Rendu");
            return back();
        }
    }
    //*************************************************Modifier***************** */
    public function ModifierCompteRendu ($CR)
    {   
        
        $ops=OperateurQualiteCalcul::all();
        $Compte=CompteRendu::where('IDCR',$CR )->first();
        $SRs=SuivieDesRebuts::all()->where('IDCR',$CR );    
        $SR1s=SuivieDesDrebus1::all()->where('IDCR',$CR );         
        return view('Compte_Rendu.Modifier_un_Compte_Rendu',compact('CR','ops','Compte','SRs','SR1s'));
      
    }

    /******************************************************update*************************************************************** */
    function update(Request $request,$CR)
{ 

    try
    {
        CompteRendu::where('IDCR',$CR)->update
        ([
           
            'DateCR'=>$request->input('DateCR'),
            'TotaleControler'=>$request->input('TotaleControler'),
            'SommeDefautsTotale'=>$request->input('SommeDefautsTotale'),
            'Pourcentage_defaut_reel'=>$request->input('Pourcentage_defaut_reel'),
            'Cm_mesure'=>$request->input('Cm_mesure'),
            'Cmk_mesure'=>$request->input('Cmk_mesure'),
            'Description'=>$request->input('Description'),
            'IDOperateurCalcul'=>$request->input('IDOperateurCalcul'),
        ]);
 
       
         $PourcentagePartielle = $request -> PourcentagePartielle;
         $DesParametreMesure   = $request -> DesParametreMesure;
         $Date_Encaissement    = $request -> date;
       
           //insertion dans la table Suivie de rebut
         for($j=0;$j<count($DesParametreMesure);$j++)
         {
            
                $datasave = [
                    'Date_Encaissement'           =>$Date_Encaissement[$j],
                    'PourcentagePartielle'        =>(float)$PourcentagePartielle[$j],
                    'DesParametreMesure'          => $DesParametreMesure[$j],
                    'IDCR'                        => $request->input('IDCR'),
                ];   
                DB::table('suivie_des_rebuts')->where('IDCR', $request->input('IDCR'))
                ->where('DesParametreMesure',  $DesParametreMesure[$j])
                ->update($datasave);
                $nbp=$DesParametreMesure[$j].'Nbr_Pieces';
                $nc=$DesParametreMesure[$j].'Ncaisse';
                $r=$DesParametreMesure[$j].'Remarque';
                $Nbr_Pieces           = $request -> input($nbp);
                $Ncaisse              = $request -> input($nc);
                $Remarque             = $request -> input($r);
                for($i=0; $i < count($Remarque); $i++)
                {    
                  $caisse=Caisse::firstOrCreate(
                      ['Ncaisse' => $Ncaisse[$i]],
                  );
                  $caisse->save();
                    $datasave = [
                        'Nbr_Pieces'                  =>$Nbr_Pieces[$i],
                        'DesParametreMesure'          => $DesParametreMesure[$j],
                        'Remarque'                    => $Remarque[$i],
                        'Ncaisse'                     => $Ncaisse[$i],
                        'IDCR'                        => $request->input('IDCR'),
                    ];   
                    DB::table('suivie_des_drebus1s')
                    ->where('IDCR',$CR)
                    ->where('DesParametreMesure',$DesParametreMesure[$j])
                    ->where('Ncaisse',$Ncaisse[$i])
                    ->update($datasave);
                }
            }
    
   
     
       Alert::success('Réussite', 'Compte_rendu modifier avec succès');
        $FCs=FicheDeControle::all();
        $ops=OperateurQualiteCalcul::all();
        $CRs=CompteRendu::all();
        return view('Compte_Rendu.Liste_Des_Comptes_Rendus',compact('FCs','ops','CRs'));
    }
    catch(\Exception $e)
    {
        Alert::error('Erreur', "Erreur lors de la modification du Compte_rendu");
        return back();
    }
} 
/*******************************************voir PDF*************************************************/
public function voirPDF($CR)
{
    $CompteRendu=CompteRendu::where('IDCR',$CR)->first();
    $srs=SuivieDesDrebus1::all()->where('IDCR',$CR);
    $sr1s=SuivieDesRebuts::all()->where('IDCR',$CR);
    view()->share('CompteRendu', $CompteRendu);
    view()->share('CR', $CR);
    view()->share('srs', $srs);
    view()->share('sr1s', $sr1s);
    $CR =['IDCR' => 'IDCR'];
    $pdf=PDF::loadView('Compte_Rendu.Bon_Du_Compte')->setPaper('a6','landscape');
    return $pdf->stream('Bon_Du_Compte.pdf');
}
/*******************************************téléchargé PDF*************************************************/
public function TelechargePDF($CR)
{
    $CompteRendu=CompteRendu::where('IDCR',$CR)->first();
    $srs=SuivieDesDrebus1::all()->where('IDCR',$CR);
    $sr1s=SuivieDesRebuts::all()->where('IDCR',$CR);
    view()->share('CompteRendu', $CompteRendu);
    view()->share('CR', $CR);
    view()->share('srs', $srs);
    view()->share('sr1s', $sr1s);
    $CR =['IDCR' => 'IDCR'];
    $pdf=PDF::loadView('Compte_Rendu.Bon_Du_Compte')->setPaper('a6','landscape');
    return $pdf->download('Bon_Du_Compte.pdf');
}




}
