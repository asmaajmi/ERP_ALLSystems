<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class pointageController extends Controller
{
    public function PointageAefflist(){
        return view('crudpointaeff');
    }
    public function Pointageefflist(){
        return view('crudpointeff');
    }
    public function Pointageeffform(){
        return view('formpointageeff');
    }
}
