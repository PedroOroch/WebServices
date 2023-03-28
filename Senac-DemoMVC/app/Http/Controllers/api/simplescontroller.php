<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class simplescontroller extends Controller
{
    public function receber(Request $request) {

        $resultado = $request->valor;
    
        return response() -> json ([
    
        'status' => 200,
        'mensagem' => 'método executado com sucesso',
        'resultado' => $resultado
    
    ], 200);
    
    }
}
