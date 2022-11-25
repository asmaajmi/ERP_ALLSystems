<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccueilController extends Controller
{
    public function AccueilView(){
        return view('accueil');
    }

    public function indexView(){
        return view('index');
    }
}
