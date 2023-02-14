<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;



class categoriasController extends Controller
{
    public function listarCategorias() {
        $cliente = new Client(['base_uri' => 'http://hostwind.lucianoconde.net']);
        $response = $cliente->request('GET', '/disciplinaws202301/demomaster/api/categorias');
        $saida = json_decode($response->getBody());

        return view('listarCategorias', ["categorias" => $saida]);
    }
}
