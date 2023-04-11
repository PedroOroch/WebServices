<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Resources\CategoriaResource;
use App\Http\Requests\StoreCategoriaRequest;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Illuminate\Validation\ValidationException;
use \Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $categorias = Categoria::all();

        //Captura a coluna para ordenacao
        $sortParameter = $request->input('ordenacao', 'nome_da_categoria');
        $sortDirection = Str::startsWith($sortParameter, '-') ? 'desc':'asc';
        $sortColumn = ltrim($sortParameter, '-');

        // Determina se faz a query ordenada ou aplica o default
        if($sortColumn == 'nome_da_categoria') {
            $categorias = Categoria::orderBy('nomedacategoria', $sortDirection)->get();
        } else {
            $categoria = Categoria::all();
        }

        return response() -> json([
            'status' => 200,
            'mensagem' => 'Lista de categorias retornada',
            'categorias' => CategoriaResource::collection ($categorias)
        ], 200);
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
    public function store(StoreCategoriaRequest $request)
    {
        //cria o objeto
        $categoria = new Categoria();

        //Transfere os valores
        $categoria->nomedacategoria = $request->nome_da_categoria;

        //Salva
        $categoria->save();

        //Retorna o resultado
        return response() -> json([
            'status' => 200,
            'mensagem' => 'Categoria criada',
            'categoria' => new CategoriaResource($categoria)
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($categoriaid)
    {
        /**
         * Validação da entrada para ter certeza que o  valor é numérico
         */
        try {
            $validator = Validator::make(['id' => $categoriaid], [
                'id' => 'integer'
            ]);

            if($validator->fails()) {
                throw ValidationException::withMessages(['id' => 'O campo Id deve ser numérico']);
            }
            /**
             * Continua o fluxo para execução
             */
    
             $categoria = Categoria::findorFail($categoriaid);
    
             return response() -> json([
                'status' => 200,
                'mensagem' => 'Categoria',
                'categoria' => new CategoriaResource($categoria)
             ]);
        } catch (\Exception $ex) {
            //throw $th;

            /**
             * Tratamento das exceções levantadas
             */

            $class = get_class($ex);//Pega a classe da exceção

            switch($class){
                case ModelNotFoundException::class: //Caso não exista o id na base
                    return response()-> json ([
                        'status' => 404,
                        'mensagem' => 'Categoria não encontrada',
                        'categoria' => []
                    ], 404);
                    break;
                case \Illuminate\Validation\ValidationException::class: //Caso não exista o id na base
                    return response()-> json ([
                            'status' => 406,
                            'mensagem' => $ex->getMessage(),
                            'categoria' => []
                    ], 404);
                    break;
                default: //Caso não exista o id na base
                    return response()-> json ([
                            'status' => 500,
                            'mensagem' => 'ERRO INTERNO',
                            'categoria' => []
                    ], 404);
                    break;
            }
        }
        $validator = Validator::make(['id' => $categoriaid], [
            'id' => 'integer'
        ]);
        //Caso não seja válido, levantar exceção
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoriaRequest $request, Categoria $categoria)
    {
        $categoria = Categoria::find($categoria->pkcategoria);
        $categoria->nomedacategoria = $request->nome_da_categoria;
        $categoria->update();


        return response() -> json([
            'status' => 200,
            'mensagem' => 'Categoria atualizada'

        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return response() -> json ([
            'status' => 200,
            'mensagem' => 'Categoria Deletada!'
        ], 200);
    }
}
