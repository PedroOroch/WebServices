<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\ProdutoResource;


class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //Captura a entrada a pagina
        $input = $request->input('pagina');

        //Monta a query com e sem paginacao
        $query = Produto::with('categoria', 'marca');

        if($input) {
            $page = $input;
            $perPage = 10; //Registros por pagina
            $query->offset(($page-1) * $perPage)->limit($perPage);
            $produtos = $query->get( );

            $recordsTotal = Produto::count();
            $numbersOfPages = ceil($recordsTotal / $perPage);
            $response = response() -> json([
                'status' => 200,
                'mensagem' => 'Lista de produtos retornada',
                'produtos' => ProdutoResource::collection($produtos),
                'meta' => [
                    'total_numero_de_registros' => (string) $recordsTotal,
                    'numero_de_registros_por_pagina' => (string) $perPage,
                    'numero_de_paginas' => (string) $numbersOfPages,
                    'pagina_atual' => $page
                ]
            ], 200);
        } else {
            $produtos = $query->get( );

            $response = response() -> json ([
                'status' => 200,
                'mensagem' => 'Lista de produtos retornada',
                'produtos' => ProdutoResource::collection($produtos)
            ], 200);
        }

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        //
    }
}
