<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Receta;

class RecetasController extends Controller
{
    public function mostrar(Request $request){
        $request->validate([
            'pais'=>'required',
        ]);

        $recetas = Receta::Where('pais',$request->pais);

        return response()->json([
            'recetas'=>$recetas
        ],200);
    }
}
