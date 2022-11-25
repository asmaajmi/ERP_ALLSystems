<?php

namespace App\Http\Controllers;

use App\Models\OutilMesure;
use App\Models\OrdreTravail;
use Illuminate\Http\Request;
use App\Models\BonSortieOutil;
use App\Models\ResponsableQualite;
use App\Models\OperateurQualiteMesure;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\OrdreTravailTestValidation;
use App\Models\OrdreTravailMesureAvoirParametreMesure;
use PDF;
use Illuminate\Support\Facades\DB;

class BonDeSortieController extends Controller
{
    public function ListeDesBonsDeSortie(){
        $bonSorties=BonSortieOutil::all();
        return view("Bon_De_Sortie.Liste_Des_Bons_De_Sortie", compact('bonSorties'));
    }
    public function AjoutUnBonDeSortie(){
        $ordres=OrdreTravail::all();
        $responsables=ResponsableQualite::all();
        $operateurs=OperateurQualiteMesure::all();
        return view("Bon_De_Sortie.Creer_Un_Bon_De_Sortie",compact('ordres','responsables','operateurs'));
    }

    public function store(Request $request)
    {
        try
        {
            $bs=BonSortieOutil::firstOrCreate([
                'DateSortie' =>$request->DateSortie
                ,'IDOT' =>$request->Ordre
                ,'IDResponsable' =>$request->Responsable
                ,'IDOperateurMesure' =>$request->IDOperateur
                ,'IDOutil' =>$request->OutilMesure
            ]);
            OutilMesure::where('DesOutilMesure',$request->OutilMesure)->update
            (
                ['Disponibilite' =>false]
            );
            $ordres=OrdreTravail::all();
            $responsables=ResponsableQualite::all();
            $operateurs=OperateurQualiteMesure::all();
            Alert::success('Réussite', 'Le bon de sortie est supprimé avec succès');
            return view('Bon_De_Sortie.Creer_Un_Bon_De_Sortie',compact('ordres','responsables','operateurs'));
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de la creation de bon de sortie ");
            return back();
        }
        
    }
    public function modifier($bonSortie)
    {
        $BonSortie=BonSortieOutil::find($bonSortie)->first();
        $operateurs=OperateurQualiteMesure::all();
        $x=OrdreTravail::where('IDOT',$BonSortie->IDOT)->first();
        if($x->TypeOrdre == 'Test De Validation')
        {
            $TypeOutils=OrdreTravailTestValidation::all()->where('IDOTTV',$BonSortie->IDOT);
        }
        else
        {
            $TypeOutils=OrdreTravailMesureAvoirParametreMesure::all()->where('IDOrdreTravailMesure',$BonSortie->IDOT);
        }
        $Outils=OutilMesure::all();
        return view("Bon_De_Sortie.Modifier_Un_Bon_De_Sortie",compact('BonSortie','bonSortie','operateurs','TypeOutils','Outils'));

    }
    public function update(Request $request, $bonSortie)
    {
        try
        {
            $bs=BonSortieOutil::find($bonSortie)->first();
        OutilMesure::where('DesOutilMesure',$bs->IDOutil)->update
        ([
            'Disponibilite' =>true
        ]);
        BonSortieOutil::find($bonSortie)->update
        (
            [ 'DateSortie' =>$request->DateSortie
            ,'IDOperateurMesure' =>$request->IDOperateur
            ,'IDOutil' =>$request->OutilMesure]
        );
        OutilMesure::where('DesOutilMesure',$request->OutilMesure)->update
        (
            ['Disponibilite' =>false]
        );
        $bonSorties=BonSortieOutil::all();
        Alert::success('Réussite', 'Le bon de sortie est modifié avec succès');
        return view("Bon_De_Sortie.Liste_Des_Bons_De_Sortie", compact('bonSorties')); 
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de la modification de bon de sortie ");
            return back();
        }
        
    }
    public function destroy($bonSortie)
    {  
        try
        {
            $bs=BonSortieOutil::find($bonSortie)->first();
        OutilMesure::where('DesOutilMesure',$bs->IDOutil)->update
        ([
            'Disponibilite' =>true
        ]);
        BonSortieOutil::find($bonSortie)->delete(); 
        $bonSorties=BonSortieOutil::all();
        Alert::success('Réussite', 'Le bon de sortie est supprimé avec succès');
        return view("Bon_De_Sortie.Liste_Des_Bons_De_Sortie", compact('bonSorties'));
        }
          catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de la supprission de bon de sortie ");
            return back();
        } 
    }

    public function voirPDF($bonSortie)
    {
        $BonSortie=BonSortieOutil::find($bonSortie)->first();
        view()->share('BonSortie', $BonSortie);
        $pdf=PDF::loadView('Fiches\Bon_De_Sortie')->setPaper('a6','landscape');
        return $pdf->stream('Bon de Sortie.pdf');
    }

    public function TelechargePDF($bonSortie)
    {
        $BonSortie=BonSortieOutil::find($bonSortie)->first();
        view()->share('BonSortie', $BonSortie);
        $pdf=PDF::loadView('Fiches\Bon_De_Sortie')->setPaper('a6','landscape');
        return $pdf->download('Bon de Sortie.pdf');
    }

   //************************************fonctions recherche Ajax */ 
    public function FindInformationBS(Request $request)
    {
        $x=OrdreTravail::where('IDOT',$request->id)->first();
        if($x->TypeOrdre == 'Test De Validation')
        {
            $data=OrdreTravailTestValidation::all()->where('IDOTTV',$request->id);
        }
        else
        {
            $data=OrdreTravailMesureAvoirParametreMesure::all()->where('IDOrdreTravailMesure',$request->id);
        }
        return response()->json($data);
    }

    public function FindOutilBS(Request $request)
    {
        $data=DB::select(' SELECT * from outil_mesures where DesTypeOutil=? and Disponibilite=?',[$request->id,true]);
       
        
        return response()->json($data);
    }
   
}
