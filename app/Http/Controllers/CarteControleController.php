<?php

namespace App\Http\Controllers;
use App\Models\operateur;
use Illuminate\Http\Request;
use App\Models\OTMesureValide;
use App\Models\CarteDeControle;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CarteMesureMoyenneEtendue;
use App\Models\ColonneMesure;

class CarteControleController extends Controller
{
    public function AfficheCarteControle(){
        $OTMVs=OTMesureValide::all();
        $ops=operateur::all();
       
        return view("CarteControle.CarteControle",compact('OTMVs','ops'));

    }
    public function findparametremesure(Request $request){
        $data=DB::select('SELECT *  FROM o_t_mesure_valides as OTMV ,
                                        ordre_de_travail_de_mesures as OTM ,
                                        methode_valides as MV ,
                                        bon_de_validations as BV ,
                                        bon_de_validation_valides as BVV,
                                        ordre_travail_test_validations  as OTTV
                                    where OTMV.IDOTMesureValide=? and
                                        OTMV.IDOTM=OTM.IDOrdreTravailMesure and
                                        MV.IDBVV=BVV.IDBVV and
                                        BVV.IDBonValidation=BV.IDBV and
                                        BV.IDOrdreTravailTestValidation=OTTV.IDOTTV and
                                        OTM.IDOrdreTravailMesure=MV.IDOrdreTravailMesure ',
                                        [$request->id]);
                
        return response()->json($data);
    }
    public function findtol(){
        $DesParametre=request()->get('DesParametre');
        $IDOTMV=request()->get('IDOTMV');
        $data=DB::select('SELECT * FROM o_t_mesure_valides as OTMV ,
                                        ordre_de_travail_de_mesures as OTM ,
                                        methode_valides as MV ,
                                        bon_de_validations as BV ,
                                        bon_de_validation_valides as BVV,
                                        ordre_travail_test_validations  as OTTV
                                   where OTMV.IDOTMesureValide=? and
                                        OTMV.IDOTM=OTM.IDOrdreTravailMesure and
                                        MV.IDBVV=BVV.IDBVV and
                                        BVV.IDBonValidation=BV.IDBV and
                                        BV.IDOrdreTravailTestValidation=OTTV.IDOTTV and
                                        OTM.IDOrdreTravailMesure=MV.IDOrdreTravailMesure and
                                        OTTV.DesParametreMesure=?'
                                        ,[$IDOTMV ,$DesParametre]);                
        return response()->json($data);
    }
    public function findnbrmesure(Request $request){
        $data=DB::select('SELECT * FROM o_t_mesure_valides as OTMV ,
                                            ordre_de_travail_de_mesures as OTM ,
                                            methode_valides as MV ,
                                            bon_de_validations as BV ,
                                            bon_de_validation_valides as BVV,
                                            ordre_travail_test_validations  as OTTV
                                    where   OTMV.IDOTMesureValide=? and
                                            OTMV.IDOTM=OTM.IDOrdreTravailMesure and
                                            MV.IDBVV=BVV.IDBVV and
                                            BVV.IDBonValidation=BV.IDBV and
                                            BV.IDOrdreTravailTestValidation=OTTV.IDOTTV and
                                            OTM.IDOrdreTravailMesure=MV.IDOrdreTravailMesure'
                                            ,[$request->id]);
                
        return response()->json($data);
    }

     
    /*****************************store*********************************************/
    public function store(Request $request)
    {
     try{

            $CC=CarteDeControle::firstOrCreate([
            
                'Limite_Sup'=>$request->Limite_Sup,
                'Limite_Inf'=>$request->Limite_Inf,
                'Parametre'=>$request->Parametre,
                'IDOTMV'=>$request->IDOTMV,
         
            ]);
            $CME=CarteMesureMoyenneEtendue::firstOrCreate([
            'CoefA2'=>$request->CoefA2,
            'CoefD4'=>$request->CoefD4,
            'IDCC'=>$CC->id,
            ]);
            
            $Moyenne             = $request ->Moyenne;
            $Etendue             = $request ->Etendue;
            $Xdbar               = $request ->Xdbar;
            $Rbar                = $request ->Rbar;
            $date                = $request ->date;
            $heure               = $request ->heure;
            $lot                 = $request ->lot;
            $operateur           = $request ->operateur;
            $valeur_mesure       = $request ->valeur_mesure;
            $a=count($valeur_mesure)/count($Moyenne);
            for($i=0; $i < count($Moyenne); $i++)
            {
              $CM=ColonneMesure::firstOrCreate([
                'IDCM_ME'=>$CME->id,
                'Moyenne'=>(float)$Moyenne[$i],
                'Etendue'=>(float)$Etendue[$i],
                'Xdbar'=>(float)$Xdbar[$i],
                'Rbar'=>(float)$Rbar[$i],
                'date'=>$date[$i],
                'heure'=>$heure[$i],
                'lot'=>$lot[$i],
                'operateur'=>$operateur[$i],
                ]);
                for($j=$i*$a;$j<($i*$a+3); $j++)
                {
                    $datasave1 = [
                    'valeur_mesure' =>(float)$valeur_mesure[$j],
                    'IDCM' =>$CM->id,
                    ];
                DB::table('mesures')->updateOrInsert($datasave1);
                }
            }
          
            $OTMVs=OTMesureValide::all();
            $ops=operateur::all();
            Alert::success('Réussite', 'Carte de contrôle enregistré avec succès');
            return view('CarteControle.CarteControle',compact('ops','OTMVs'));
        }
        catch(\Exception $e)
        {
            Alert::error('Erreur', "Erreur lors de l'enregistrement de la carte de contrôle ");
            return back();
        }
    }
}
