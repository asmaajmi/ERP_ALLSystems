<?php

namespace App\Http\Controllers;

use App\Models\ConstituePar;
use App\Models\Nomenclature;
use Illuminate\Http\Request;
use App\Models\ProduitAchetable;
use Illuminate\Support\Facades\DB;
use App\Models\ProduitConstruisable;

class NomenclatureController extends Controller
{
    public function NomenclatureList(){
        $produit_const=ProduitConstruisable::all();
        $produit_achetable=ProduitAchetable::all();
        $nomenclatures=Nomenclature::all();
        $constituers=ConstituePar::all();
        return view('crudNomenclature',compact('produit_const','produit_achetable','nomenclatures','constituers'));

    }

    public function NomenclatureForm(){
     $produit_const=ProduitConstruisable::select('nom_produit_const','code_barre','DesProduitC','lot_optimal')->where('type_produit','Sous_produit')->get();
     $produit_achetable=ProduitAchetable::all();
        return view('formNomenclature',compact('produit_const','produit_achetable'));
    }


    public function FindProduit(Request $request){

        //$request->id here is the id of our chosen option id
        $data1=ProduitConstruisable::select('nom_produit_const','id','type_produit')->where('type_produit',$request->type)->get();
        $data2=ProduitAchetable::select('nom_produit','id','type_prod')->where('type_prod',$request->type)->get();
        $data=[
            'data1' => $data1,
            'data2' => $data2
        ];
        return response()->json($data);//then sent this data to ajax success
	}
    function NomenclatureCreate (Request $request){
        try{

            $nom_nomenclature=$request->input('nom_nomenclature');
            $arrondi=$request->input('arrondi');
            
            $nomenclature=Nomenclature::create([
                'designation'=>$nom_nomenclature,
                        
            ]);
            foreach($request->nom_produit_const as $key=>$produit)
            {    
                $quantite= $request->quantite_produit_const[$key];
                $unite= $request->unite_produit_const[$key];
                $arrondi= $request->arrondi_produit_const[$key];

                $nomenclature->Produits_construisables()->attach($produit,['quantite'=>$quantite,'unite'=>$unite,'arrondi'=>$arrondi]);
                
            }
            foreach($request->nom_produit_achet as $key=>$produit_ach)
            {    
                $quantite2= $request->quantite_prod_achet[$key];
                $unite2= $request->unite_prod_achet[$key];
                $arrondi2= $request->arrondi_prod_achet[$key];

                $nomenclature->Produits_achetables()->attach($produit_ach,['quantite'=>$quantite2,'unite'=>$unite2,'arrondi'=>$arrondi2]);
                
            }

            return redirect()->back()
            ->with('success', 'Création effectuée avec succès !');
        }
        
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la creation  !');

        }
    }

    public function DeleteConstituerPar(ConstituePar $const)
    {
        
        $const->delete();
    
        $produit_const=ProduitConstruisable::all();
        $produit_achetable=ProduitAchetable::all();
        $nomenclatures=Nomenclature::all();
        $constituers=ConstituePar::all();
        return view('crudNomenclature',compact('produit_const','produit_achetable','nomenclatures','constituers'));

    }
    public function DeleteNomenclature(Nomenclature $nomenclature)
    {
        
        $nomenclature->delete();
    
        $produit_const=ProduitConstruisable::all();
        $produit_achetable=ProduitAchetable::all();
        $nomenclatures=Nomenclature::all();
        $constituers=ConstituePar::all();
        return view('crudNomenclature',compact('produit_const','produit_achetable','nomenclatures','constituers'));

    }

    public function AddComposantNomenclatureForm(Nomenclature  $nomenclature){
        $produit_const=ProduitConstruisable::all();
        $produit_achetable=ProduitAchetable::all();
           return view('formAddProduitNomenclature',compact('produit_const','produit_achetable','nomenclature'));
       }

    public function CreateComposantNomenclature(Request $request ,Nomenclature  $nomenclature){
        try{
            
            foreach($request->nom_produit_const as $key=>$produit)
            {    
                $quantite= $request->quantite_produit_const[$key];
                $unite= $request->unite_produit_const[$key];
                $arrondi= $request->arrondi_produit_const[$key];
                $nomenclature->Produits_construisables()->attach($produit,['quantite'=>$quantite,'unite'=>$unite,'arrondi'=>$arrondi]);
                
            }
            foreach($request->nom_produit_achet as $key=>$produit_ach)
            {    
                $quantite2= $request->quantite_prod_achet[$key];
                $unite2= $request->unite_prod_achet[$key];
                $arrondi2= $request->arrondi_prod_achet[$key];

                $nomenclature->Produits_achetables()->attach($produit_ach,['quantite'=>$quantite2,'unite'=>$unite2,'arrondi'=>$arrondi2]);
                
            }

            return redirect()->back()
            ->with('success', 'Création effectuée aves succès !');
       }
       catch (\Exception $e)
       {
           return redirect()->back()
            ->with('error', 'Erreur lors de la creation  !');
       }
    }

    public function NomenclatureEdit(Nomenclature $nomenclature){
        $produit_const=ProduitConstruisable::all();
        $produit_achetable=ProduitAchetable::all();
        $constituers=ConstituePar::all();

        return view('formNomenclatureEdit',compact('produit_const','produit_achetable','nomenclature','constituers'));
       
    }


    function UpdateNomenclature(Request $request,Nomenclature $nomenclature){

        try
        {   
            $id_nomenclature=$nomenclature->id;
            $nom_nomenclature=$request->input('nom_nomenclature');
           
            
            Nomenclature::where('id',$id_nomenclature)->update(['designation'=>$nom_nomenclature,]);
            
            foreach($request->nom_produit_const as $key=>$produit)
            {    
                $quantite= $request->quantite_produit_const[$key];
                $unite= $request->unite_produit_const[$key];
                $arrondi= $request->arrondi_produit_const[$key];

                DB::table('constituer_pars')->where('id_prodconstruisable',$produit)
                ->update(['quantite'=>$quantite,'unite'=>$unite,'arrondi'=>$arrondi]);                
            }
            foreach($request->nom_produit_achet as $key=>$produit_ach)
            {    
                $quantite2= $request->quantite_prod_achet[$key];
                $unite2= $request->unite_prod_achet[$key];
                $arrondi2= $request->unite_prod_achet[$key];

                DB::table('constituer_pars')->where('id_prodachetable',$produit)
                ->update(['quantite'=>$quantite2,'unite'=>$unite2,'arrondi'=>$arrondi2]);                  
            }
                return redirect()->route('Nomenclature.list')
                ->with('success', 'Modification effectuée avec succès !'); 
            
        }
        catch (\Exception $e){
            return redirect()->back()
                ->with('error', 'Erreur lors de la Modification  !');
 
        }
    

    }
}
