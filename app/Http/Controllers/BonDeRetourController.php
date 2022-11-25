<?php

namespace App\Http\Controllers;

use App\Models\OutilMesure;
use App\Models\OrdreTravail;
use Illuminate\Http\Request;
use App\Models\BonSortieOutil;
use App\Models\ResponsableQualite;
use App\Http\Controllers\Controller;
use App\Models\OperateurQualiteMesure;
use App\Models\OrdreTravailTestValidation;
use App\Models\OrdreTravailMesureAvoirParametreMesure;
use App\Models\BonDeRetour;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class BonDeRetourController extends Controller
{
    public function ListeDesBonsDeRetour (){
        $bonRetours=BonDeRetour::all();
        return view("Bon_De_Retour.Liste_Des_Bons_De_Retour", compact('bonRetours'));
    }

    public function AjoutUnBonDeRetour (){
        $bs=BonSortieOutil::all();
        $responsables=ResponsableQualite::all();
        $operateurs=OperateurQualiteMesure::all();
        return view("Bon_De_Retour.Creer_Un_Bon_De_Retour",compact('bs','responsables','operateurs'));
    }
    public function store(Request $request)
    { 
        try{
            $br=BonDeRetour::firstOrCreate([
                'DateRetour' =>$request->DateRetour
                ,'IDBS' =>$request->IDBS
                ,'IDResponsable' =>$request->Responsable
                ,'IDOperateurMesure' =>$request->IDOperateur
                ,'IDOutil' =>$request->OutilMesure
            ]);
            OutilMesure::where('DesOutilMesure',$request->OutilMesure)->update
            (
                ['Disponibilite' =>true]
            );
            $bs=BonSortieOutil::all();
            $responsables=ResponsableQualite::all();
            $operateurs=OperateurQualiteMesure::all();
            Alert::success('Réussite', 'Le bon de retour est crée avec succès');
            return view('Bon_De_Retour.Creer_Un_Bon_De_Retour',compact('bs','responsables','operateurs'));
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de la creation de bon de retour ");
            return back();
        }

        
    }
    public function modifier($bonRetour)
    {
        $BonRetour=BonDeRetour::find($bonRetour)->first();
        $bs=BonSortieOutil::find($BonRetour->IDBS)->all();
        return view("Bon_De_Retour.Modifier_Un_Bon_De_Retour",compact('bs','BonRetour','bonRetour'));

    }
    public function update(Request $request, $bonRetour)
    { 
        try
        {
            $br=BonDeRetour::find($bonRetour)->first();
        OutilMesure::where('DesOutilMesure',$br->IDOutil)->update
        ([
            'Disponibilite' =>false
        ]);
        BonDeRetour::find($bonRetour)->update
        (
            ['DateRetour' =>$request->DateRetour
            ,'IDBS' =>$request->IDBS
            ,'IDResponsable' =>$request->Responsable
            ,'IDOperateurMesure' =>$request->IDOperateur
            ,'IDOutil' =>$request->OutilMesure]
        );
        OutilMesure::where('DesOutilMesure',$request->OutilMesure)->update
        (
            ['Disponibilite' =>true]
        );
        $bonRetours=BonDeRetour::all();
        Alert::success('Réussite', 'Le bon de retour est modifié avec succès');
        return view("Bon_De_Retour.Liste_Des_Bons_De_Retour", compact('bonRetours','bonRetour'));
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de la modification de bon de retour ");
            return back();
        }
    }
    public function destroy($bonRetour)
    { 
        try
        {
            $br=BonDeRetour::find($bonRetour)->first();
            OutilMesure::where('DesOutilMesure',$br->IDOutil)->update
            ([
                'Disponibilite' =>false
            ]);
            BonDeRetour::find($bonRetour)->delete(); 
            $bonRetours=BonDeRetour::all();
            Alert::success('Réussite', 'Le bon de retour est supprimé avec succès');
            return view("Bon_De_Retour.Liste_Des_Bons_De_Retour", compact('bonRetours'));   
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de la supprission de bon de retour ");
            return back();
        }
       
    }

    public function voirPDF($bonRetour)
    {
        $BonRetour=BonDeRetour::find($bonRetour)->first();
        view()->share('BonRetour', $BonRetour);
        $pdf=PDF::loadView('Fiches\Bon_De_Retour')->setPaper('a6','landscape');
        return $pdf->stream('Bon de Retour.pdf');
    }

    public function TelechargePDF($bonRetour)
    {
        $BonRetour=BonDeRetour::find($bonRetour)->first();
        view()->share('BonRetour', $BonRetour);
        $pdf=PDF::loadView('Fiches\Bon_De_Retour')->setPaper('a6','landscape');
        return $pdf->download('Bon de Sortie.pdf');
    }

    //************************************fonctions recherche Ajax ***************************************/ 
    public function FindInformationBR(Request $request)
    {
        $data=DB::select("SELECT * 
        FROM bon_sortie_outils as bon ,
         outil_mesures as outil 
        
      
        WHERE bon.IDOutil = outil.DesOutilMesure
       
          and bon.id=?",[$request->id]);
        
        return response()->json($data);
    }
   
}
