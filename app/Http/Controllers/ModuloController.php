<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function listar(){
    	return view('modulo.listagem');
    }
}
