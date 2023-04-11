<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\ProdutoResource;


class ProdutoController extends Controller
{
    /**
     * trabalha com filtro de entrada
     */
    public function index(Request $request)
    {
      //Query padrao
      $query = Produto::with('categoria', 'marca');

      //Obtem o parametro do filtro
      $filterParameter = $request -> input ("filtro");

      //Sf bao ha nenhum parametro

      if($filterParameter == null) {
        //Retorna todos os produtos
        $produtos = $query->get( );

        $response = response( )->json([
            'status' => 200,
            'mensagem' => 'Lista de produtos retornada',
            'produtos' => ProdutoResource::collection($produtos)
        ], 200);
      } else {
        //Obtem o nome do filtro e o criterio
        [$filterCriteria, $filterValue] = explode(":", $filterParameter);

        //Se o filtro está adequado
        if($filterCriteria == "nome_da_categoria") {
            //Faz inner join para obter a categoria
            $produtos = $query->join("categorias", "pkcategoria", "=", "fkcategoria")
            ->where("nomedacategoria", "=", $filterValue)->get();

            $response = response()->json([
                'status' => 200,
                'mensagem' => 'Lista de produtos retornada - Filtrada',
                'produtos' => ProdutoResource::collection($produtos)
            ], 200);
        } else {
            //Usuario chamou filtro que não existe, então n]ao ha nada a retornar (Error 406 - Not Accepted)
            $response = response()->json([
                'status' => 406,
                'mensagem' => 'Filtro não aceito',
                'produtos' => []
            ], 406);
        }

       
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
