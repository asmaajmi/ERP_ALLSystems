<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class test extends Controller
{
    //
}

                            

                    foreach($request->nomoutil as $key=>$nomoutil){
                        $machine->outilfabrication()->attach([
                            ['ref_outil'=>$nomoutil, 'quantite'=>$request->qte[$key], 'unite'=>$request->unite[$key]]
                        ]);}
                    
                        $consommers = DB::table('consommers')
                        ->join('outil_fabrications', 'consommers.ref_outil', '=', 'outil_fabrications.id', 'left')
                        ->where('consommers.id_machine', '=', $machine->id)
                        ->select('consommers.ref_outil', 'consommers.quantite', 'consommers.unite')->get();   
                    