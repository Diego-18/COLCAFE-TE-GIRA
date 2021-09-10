<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroEmpaquesController extends Controller
{
    public function index(){
            return view('registro-empaques');
    }
}
