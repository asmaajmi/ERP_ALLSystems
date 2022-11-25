<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Diplome;
use App\Models\Employe;
use App\Models\Service;
use PDF;
use Illuminate\Http\Request;
use App\Models\NotePonctualite;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class employeController extends Controller
{
    
   
    public function Employelist(){
        $employes = Employe::orderBy("nom_emp", "asc")->paginate(5);  
        $services=Service::all();   
        return view("crudEmp",compact("employes","services"));
    }


    public function Employeform(){
        $services=Service::all();
        return view('createEmploye', compact("services"));
    }


    public function edit(Employe $employe)
    {
        $services=Service::all();
        $travails = DB::table('travaillers')
        ->join('services', 'travaillers.id_serv', '=', 'services.id', 'left')
        ->where('travaillers.id_emp', '=', $employe->id)
        ->select('travaillers.id_serv', 'travaillers.date_debut_tr')->get();
        if($employe->role_emp == "employe"){
        return view("editEmploye", compact("employe","services","travails"));}
        elseif($employe->role_emp == "directeur"){
            return view("editDirecteur",compact("employe"));}
    }

    function create(Request $request){      
     try{
         $maladie=$request->input('conge_mal');
         $annuel=$request->input('conge_annuel');
        $acciden=$request->input('conge_acc');
            DB::unprepared('SET IDENTITY_INSERT employes ON;');
            $employee = Employe::create([
                'id'=>$request->input('id_emp'),
                'cin_emp'=>$request->input('cin_emp'),
                'nom_emp'=>$request->input('nom_emp'),
                'prenom_emp'=>$request->input('prenom_emp'),
                'date_naissance_emp'=>$request->input('date_nais_emp'),
                'tel1_emp'=>$request->input('tel1_emp'),
                'tel2_emp'=>$request->input('tel2_emp'),
                'mob1_emp'=>$request->input('mob1_emp'),
                'mob2_emp'=>$request->input('mob2_emp'),
                'etat_civil_emp'=>$request->input('etat_civil_emp'),
                'date_recrutement_emp'=>$request->input('date_rec_emp'),
                'salaire_base_emp'=>$request->input('salaire_emp'),
                'seuil_conge_maladie'=>$maladie,
                'seuil_conge_annuel'=>$annuel,
                'seuil_conge_accidentel'=>$acciden,
                'var_seuil_conge_maladie'=>$maladie,
                'var_seuil_conge_annuel'=>$annuel,
                'var_seuil_conge_accidentel'=>$acciden,
                'salaire_journalier'=>$request->input('salaire_emp')/30.5,

                'role_emp'=>$request->input('role'),
            ]);
             DB::unprepared('SET IDENTITY_INSERT employes OFF;');

     
            foreach($request->date_ob_dip as $key=>$date_ob_dip)
            {
                $x=new Diplome();        
                $x->dt_obtention= $date_ob_dip;
                $x->niveau= $request->niveau_emp[$key];
                $x->ecole= $request->ecole_emp[$key]; 
                $x->id_emp=$request->id_emp;
                $x->save();
            }
           
            if( $request->input('role') == "employe")
            {
                $id_serv = $request->input('id_serv');
                $employee->service()->attach([
                ['date_debut_tr'=>$request->input('date_debut_tr'),'id_serv'=>$id_serv]   
                ]);
            }

            if($employee){
            Alert::success('Succés', 'Création effectuée aves succès !'); 
            $employes = Employe::orderBy("nom_emp", "asc")->paginate(5);  
            $services=Service::all();      
            return view("crudEmp", compact("employes","services"));
            }    
            }      
            catch (\Exception $e){    
            Alert::error('Erreur', 'Erreur lors de la Création  !');
            return back();
            Employe::where('id',$request->input('id_emp'))->delete();}           
    }
    
    public function delete(Employe $employe){
        $employe->delete();      
        $employes = Employe::orderBy("nom_emp", "asc")->paginate(5);  
        $services=Service::all();      
        return view("crudEmp", compact("employes","services"));
    }


    public function update(Request $request, Employe $employe){
      $employe->timestamps=false;
      try{
        $employe->update([
            'cin_emp'=>$request->cin_emp,
            'nom_emp'=>$request->nom_emp,
            'prenom_emp'=>$request->prenom_emp,
            'date_naissance_emp'=>$request->date_nais_emp,
            'tel1_emp'=>$request->tel1_emp,
            'tel2_emp'=>$request->tel2_emp,
            'mob1_emp'=>$request->mob1_emp,
            'mob2_emp'=>$request->mob2_emp,
            'etat_civil_emp'=>$request->etat_civil_emp,
            'date_recrutement_emp'=>$request->date_rec_emp,
            'salaire_base_emp'=>$request->salaire_emp,
            'seuil_conge_maladie'=>$request->conge_mal,
            'seuil_conge_annuel'=>$request->conge_annuel,
            'seuil_conge_accidentel'=>$request->conge_acc,         
        ]);
        
       foreach($request->num_dip_emp  as $key=>$num_dip_emp){ 
            $id=$num_dip_emp;
            $dt_obtention= $request->date_ob_dip[$key];
            $niveau= $request->niveau_emp[$key];
            $ecole= $request->ecole_emp[$key];
            Diplome::where(['id' => $id])
             ->update(['niveau'=>$niveau, 'ecole'=>$ecole, 'dt_obtention'=>$dt_obtention
               ]);
            }
    
    if( $request->input('role') == "employe"){
    $id_serv = $request->input('id_serv');
    $employe->service()->sync([        
        ['date_debut_tr'=>$request->input('date_debut_tr'),'id_serv'=>$id_serv]   
        ]);}
        
        if($employe){
            Alert::success('Succés', 'Modification effectuée aves succès !'); 
            $employes = Employe::orderBy("nom_emp", "asc")->paginate(5);  
            $services=Service::all();      
            return view("crudEmp", compact("employes","services"));
            }    
            }      
            catch (\Exception $e){    
            Alert::error('Erreur', 'Erreur lors de la Modification  !');
            return back();}          
}

public function afficherPDF(Employe $employe){
    $services=Service::all();
    $diplomes=Diplome::all();
    $date = Carbon::now();
    $travails = DB::table('travaillers')
    ->join('services', 'travaillers.id_serv', '=', 'services.id', 'left')
    ->where('travaillers.id_emp', '=', $employe->id)
    ->select('travaillers.id_serv', 'travaillers.date_debut_tr','travaillers.date_fin_tr','travaillers.id_emp')->get();
    $pdf=PDF::loadView('pdf_employe',compact("employe","travails","services","diplomes","date"));
    return $pdf->stream('Employe.pdf');
 }
}
