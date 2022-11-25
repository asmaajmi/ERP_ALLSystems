<?php

namespace App\Http\Controllers;

use App\Models\Pause;
use Illuminate\Http\Request;
use App\Models\JourAEffectuer;
use App\Models\PointageAEffectuer;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;



class PauseController extends Controller
{
    function index(){
      $pointagessaeff = PointageAEffectuer::select('designation_periode')->distinct("designation_periode")->get();
      return view('formpause',compact('pointagessaeff'));
}


public function finddatedeb(Request $request){

		
  //if our chosen id and products table prod_cat_id col match the get first 100 data 

    //$request->id here is the id of our chosen option id
    $data=PointageAEffectuer::select ('annee','id')->where('designation_periode',$request->desperiode)->get();
    return response()->json($data);//then sent this data to ajax success
}

public function finddatefin(Request $request){

		
  //if our chosen id and products table prod_cat_id col match the get first 100 data 

    //$request->id here is the id of our chosen option id
    $data=PointageAEffectuer::select('date_fin_periode')->where('id',$request->datedeb)                                                         
                                                           ->get();
    return response()->json($data);//then sent this data to ajax success
}


public function findjours(Request $request){

		
  //if our chosen id and products table prod_cat_id col match the get first 100 data 

    //$request->id here is the id of our chosen option id
    $data=JourAEffectuer::select('designation_j','id')->where('num_seq_pa',$request->idpoint)
                                                      ->whereNotNull('heure_entree_j')
                                                      ->whereNotNull('heure_sortie_j')
                                                      ->get();
                                                           
    return response()->json($data);//then sent this data to ajax success
}



function create(Request $request){
   try{
  $despause = $request->des_pause;
  $hdebpause = $request->heuredebutpause;
  $hfinpause = $request->heurefinpause;
  $select=Pause::where('designation_pause',$despause)
                ->where('heure_deb_pause',$hdebpause)
                ->where('heure_fin_pause',$hfinpause);
   if($select ===null){
  foreach($despause as $key=>$des_pause){
    $x=new Pause();
    $x->designation_pause=$des_pause;
    $x->heure_deb_pause= $hdebpause[$key];
    $x->heure_fin_pause= $hfinpause[$key];
    $x->num_seq_j=$request->desj;
    $x->save();
 }
    Alert::success('Succés', 'Création effectuée aves succès !'); 
                return back();}
          else{ 
    Alert::error('Error', 'Cette ligne deja existe !');
            return back();}
              }
            catch (\Exception $e){
      Alert::error('Error', 'Erreur lors de la création !');
            return back();}
          }
    public function delete(Pause $pause){
      $pause->delete();      
  }
}