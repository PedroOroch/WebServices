<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;
use App\Http\Resources\ProdutoResource;
use Illuminate\Support\Str;


class ProdutoController extends Controller
{

   
    public function index(Request $request)
    {
        $query = Produto::with('categoria', 'marca');
        $mensagem = "Lista de produtos retornada";
        $codigoderetorno = 0;
    
        /**
         * REALIZA PROCESSAMENTO DO FILTRO
         */
        //Obtem o parametro do filtro
        $filterParameter = $request -> input("filtro");
    
        // Sf nao ha nenhum parametro
        if($filterParameter == null) {
            //Retorna todos os produtos & Default
            $mensagem = "Listagem de produtos retornada - COMPLETA";
            $codigoderetorno = 200;
        } else {
            //Obtem op nome do filtro e o criterio
            [$filterCriteria, $filterValue] = explode(":", $filterParameter);
    
            //Se o filtro está adequado
            if($filterCriteria == "nome_da_categoria") {
                //Faz inner join para obter a categoria
                $produtos = $query->join("categorias", "pkcategoria", "=", "fkcategoria")
                ->where("nomedacategoria", "=", $filterValue);
                $mensagem = "Lista de produtos retornada - Filtrada";
                $codigoderetorno = 200;
            } else {
                //Usuario chamou um filtro que não existe, então não há nada a retornar (Erro 406 - Not Accepted)
                $produtos = [ ];
                $mensagem = "Filtro nao aceito";
                $codigoderetorno = 406;
            }
        }
    
        if($codigoderetorno == 200) {
            /**
             * Realiza o precossamento da ordenacao
             */
            // Se há input para ordenacao
            if($request->input('ordenacao','')) {
                $sorts = explode(',' , $request->input('ordenacao' , ''));
    
                foreach($sorts as $sortColumn) {
                    $sortDirection = Str::startsWith($sortColumn, '-')?'desc':'asc';
                    $sortColumn = ltrim($sortColumn, '-');
    
                    //Transforma os nomes dos parametros em nomes dos campos do Modelo
                    switch($sortColumn) {
                        case("nome_do_produto"):
                            $query->orderBy('nomedoproduto', $sortDirection);
                            break;
                        case("ano_do_modelo"):
                            $query->orderBy('anomodelo', $sortDirection);
                            break;
                        case("preco_de_lista"):
                            $query->orderBy('precodelista', $sortDirection);
                            break;
                    }
                }
                $mensagem = $mensagem . "+Ordenada";
            }
        }

        /**
         * REALIZA PROCESSAMENTO DA PAGINACAO
         */

        $input = $request->input('pagina');
        if ($input) {
            $page = $input;
            $perPage = 10; //Registros por pagina
            $query->offset(($page-1) * $perPage)->limit($perPage);
            $produtos = $query->get();

            $recordsTotal = Produto::count();
            $numberOfPages = ceil($recordsTotal / $perPage);

            $mensagem = $mensagem . "+Paginada";
        }

        //Se o processamento foi ok, retorna com base no criterio
        if($codigoderetorno == 200) {
            $produtos = $query->get();
            $response = response() -> json([
                'status' => 200,
                'mensagem' => $mensagem,
                'produtos' => ProdutoResource::collection($produtos)
            ], 200);
        } else {
            //Retorna o erro que ocorreu
            $response = response() -> json([
                'status' => 406,
                'mensagem' => $mensagem,
                'produtos' => $produtos
            ], 406);
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
