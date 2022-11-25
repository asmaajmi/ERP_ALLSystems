<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Machine;
use App\Models\Nomenclature;
use App\Models\Produit;
use Illuminate\Http\Request;
use App\Models\Temps_reglages;
use App\Models\ProduitAchetable;
use Illuminate\Support\Facades\DB;
use App\Models\ProduitConstruisable;
use RealRashid\SweetAlert\Facades\Alert;

class ProduitController extends Controller
{
    public function ProduitList(){

        $produit_construisable=ProduitConstruisable::all();
        $produit_achetable=ProduitAchetable::all();
        
        return view('crudProduit',compact('produit_construisable','produit_achetable'));
    }

    public function ProduitConstruisableForm(){
        $machines=Machine::all();
        return view('formProduitConstruisable',compact('machines'));
    }

    

     
   
    // insert un produit construisable
    function ProduitConstruisableCreate (Request $request){
        try{

            $nom_produit=$request->input('nomproduit');
            $id_machine=$request->input('id_machine');
            $code_barre=$request->input('codebarre');
            $lot_optimal=$request->input('lotoptimal');
            $type=$request->input('typeproduit');
            $nature=$request->input('nature');
            $prix=$request->input('prix_unit_vente');
            $tempsunitaire=$request->input('tempsunitaire');
            $tempsreglages=$request->input('tempsreglages');


            $pro=Produit::firstOrCreate([
                'DesProduit' =>$nom_produit
                ,'TypeProduit' =>'construisable'
               
            ]);
            

            $Produit_const=ProduitConstruisable::create([
                'DesProduitC'=>$nom_produit,
                'DesProduit'=>$nom_produit,
                'nom_produit_const'=>$nom_produit,
                'code_barre'=>$code_barre,
                'lot_optimal'=>$lot_optimal,
                'type_produit'=>$type,
                'Nature_produit'=>$nature,
                'Prix_unit_vente'=>$prix,


            ]);
            $datasave = [
                'IDProduitConstruisable'  =>$nom_produit,
                'IDMachine'          => $id_machine,
            ];   
            DB::table('produits_construisables_machines')->updateOrInsert($datasave);

            $datasave2 = 
            ['id_machine'=>$id_machine,
            'id_produit_const'=>$nom_produit,
            'temps_unitaire'=>$tempsunitaire,
            'temps_reglage_lot'=>$tempsreglages,];
            DB::table('tempsfabrications')->updateOrInsert($datasave2);

            // $machine=Machine::select('DesMachine')->where('DesMachine',$id_machine)->get();
            // $Produit_const->Machines()->attach($machine,['temps_unitaire'=>$tempsunitaire,'temps_reglage_lot'=>$tempsreglages]);
            
            
            if($Produit_const){
                Alert::success('Succés', 'Création effectuée aves succès !'); 
                $produit_construisable=ProduitConstruisable::all();
                $produit_achetable=ProduitAchetable::all();
                return view('crudProduit',compact('produit_construisable','produit_achetable'));
            }
        }
        catch (\Exception $e){    
            Alert::error('Erreur', 'Erreur lors de la création  !');
            return back();}     

    }
    // suprimer un produit construisable
    public function deleteProduitConstruisable($prodconst){
        ProduitConstruisable::where("DesProduitC",$prodconst)->delete(); 
        Produit::where('DesProduit',$prodconst)->delete();
        $produit_construisable=ProduitConstruisable::all();
        $produit_achetable=ProduitAchetable::all();
        return view('crudProduit',compact('produit_construisable','produit_achetable'));    
    }
     // afficher les information d'un produit construisable
    public function afficherProduitPDF($prodconst){
        $prodconsts=ProduitConstruisable::all()->where('DesProduitC',$prodconst);
        $machines = Machine::all();
        $date = Carbon::now();
        $tmpFab = DB::table('tempsfabrications')
        ->join('machines', 'tempsfabrications.id_machine', '=', 'machines.DesMachine', 'left')
        ->where('tempsfabrications.id_produit_const', '=', $prodconst)
        ->select('tempsfabrications.id_machine', 'tempsfabrications.temps_unitaire','tempsfabrications.temps_reglage_lot','tempsfabrications.id_produit_const')->get();
        $pdf=PDF::loadView('pdf_produit',compact("machines", "tmpFab", "prodconst", "date",'prodconsts'));
        return $pdf->stream('Produit.pdf');
    }
   
    //****************************************************************** */
    public function ProduitAchetableForm(){
        return view('formProduitAchetable');
    }

    function ProduitAchetableCreate (Request $request){
        try{

           
            $nom_produit=$request->input('nomproduit_achetable');
            $pro=Produit::firstOrCreate([
                'DesProduit' =>$nom_produit
                ,'TypeProduit' =>'achetable'
               
            ]);
            $Produit_achetable=ProduitAchetable::firstOrCreate([
                'DesProduitA'=>$nom_produit,
                'DesProduit'=>$nom_produit,
                'nom_produit'=>$nom_produit,
                'type_prod' =>'Produit achetable'

            ]);

          
            if($nom_produit){
                Alert::success('Succés', 'Création effectuée aves succès !'); 
                $produit_construisable=ProduitConstruisable::all();
                $produit_achetable=ProduitAchetable::all();
                return view('crudProduit',compact('produit_construisable','produit_achetable'));}
        }
        catch (\Exception $e){    
            Alert::error('Erreur', 'Erreur lors de la création  !');
            return back();} 
    }

    public function deleteProduitAchetable($produit_achet){
        ProduitAchetable::where('DesProduitA',$produit_achet)->delete();
        Produit::where('DesProduit',$produit_achet)->delete();
        $produit_construisable=ProduitConstruisable::all();
        $produit_achetable=ProduitAchetable::all();
        return view('crudProduit',compact('produit_construisable','produit_achetable'));  
    }
  
    public function tempsReglageForm(){
        $produit_construisable=ProduitConstruisable::all();
        $machines=Machine::all();
        return view('formTempsReglage',compact('produit_construisable','machines'));
    }

    public function tempsReglageList(){
        $produit_construisables=ProduitConstruisable::all();
        $machines=Machine::all();
        $tmpsRegs = Temps_reglages::all();
        return view('crudTempsReglage',compact('tmpsRegs', 'produit_construisables', 'machines'));
    }


    public function FindProduit2(Request $request){

        //$request->id here is the id of our chosen option id
        $data=ProduitConstruisable::select('nom_produit_const','DesProduitC')->where('DesProduitC','<>',$request->DesProduitC)
        ->get();
        return response()->json($data);//then sent this data to ajax success
	}

    
    function TempsReglagesCreate (Request $request){
        // try{

            $id_produit1=$request->input('nom_prod1');
            $id_produit2=$request->input('nom_prod2');
            $id_machine=$request->input('id_machine');
            $temps_reglage=$request->input('temps_reg');
            $count = DB::table('temps_reglages')->count(DB::raw('id'));
            if($count>0){
            $select=Temps_reglages::where('id_machine',$id_machine)->first()
                                     ->where('id_produit_const1',$id_produit1)->first()
                                     ->where('id_produit_const2',$id_produit2)->first();
                                             
            if($select === null){
            $temp_reg=Temps_reglages::create([
                'id_machine'=>$id_machine,
                'id_produit_const1'=>$id_produit1,
                'id_produit_const2'=>$id_produit2,
                'temps_reglage'=>$temps_reglage
            ]);   
            
            if($temp_reg){
                Alert::success('Succés', 'Création effectuée aves succès !'); 
                $produit_construisables=ProduitConstruisable::all();
                $machines=Machine::all();
                $tmpsRegs = Temps_reglages::all();
                return view('crudTempsReglage',compact('tmpsRegs', 'produit_construisables', 'machines'));}
            }
            else{ 
            Alert::error('Error', 'Le temps de réglage pour ces entrées est déjà configurer !');
            return back();}
    }
            elseif($count == 0){
            $temp_reg=Temps_reglages::create([
            'id_machine'=>$id_machine,
            'id_produit_const1'=>$id_produit1,
            'id_produit_const2'=>$id_produit2,
            'temps_reglage'=>$temps_reglage]);      
        if($temp_reg){
            Alert::success('Succés', 'Création effectuée aves succès !'); 
            $produit_construisables=ProduitConstruisable::all();
            $machines=Machine::all();
            $tmpsRegs = Temps_reglages::all();
            return view('crudTempsReglage',compact('tmpsRegs', 'produit_construisables', 'machines'));}
        // }
}
        // catch (\Exception $e){    
        //     Alert::error('Erreur', 'Erreur lors de la création  !');
        //     return back();} 
    }

    public function deleteTempsReglage(Temps_reglages $tempsreglage){
        $tempsreglage->delete();
        $produit_construisables=ProduitConstruisable::all();
        $machines=Machine::all();
        $tmpsRegs = Temps_reglages::all();
        return view('crudTempsReglage',compact('tmpsRegs', 'produit_construisables', 'machines'));  
    }

    public function editTempsReglage(Temps_reglages $tempsreglage)
    {
        $produit_construisables=ProduitConstruisable::all();
        $machines=Machine::all();
        return view('editTempsReglage',compact('tempsreglage', 'produit_construisables', 'machines'));
    }

    public function updateTempsReglage(Request $request, Temps_reglages $tempsreglage){
        $tempsreglage->timestamps=false;
        try{
            $tempsreglage->update([
            'id_machine'=>$request->id_machine,
            'id_produit_const1'=>$request->nom_prod1,
            'id_produit_const2'=>$request->nom_prod2,
            'temps_reglage'=>$request->temps_reg
        ]);
        if($tempsreglage){
            Alert::success('Succés', 'Modification effectuée aves succès !'); 
            $produit_construisables=ProduitConstruisable::all();
            $machines=Machine::all();
            $tmpsRegs = Temps_reglages::all();
            return view('crudTempsReglage',compact('tmpsRegs', 'produit_construisables', 'machines'));}
        }

        catch (\Exception $e){    
            Alert::error('Erreur', 'Erreur lors de la modification  !');
            return back();} 
    }
}


