<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Marcas;
use Illuminate\Http\Request;
use App\Http\Resources\MarcaResource;
use App\Http\Requests\StoreMarcaRequest;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marcas::all();

        return response() -> json([
            'status' => 200,
            'mensagem' => 'Lista de marcas retornada',
            'marcas' => MarcaResource::collection ($marcas)
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
    public function store(StoreMarcaRequest $request)
    {
        //cria o objeto
        $marca = new Marcas();

        //Transfere os valores
        $marca->nomedamarca = $request->nome_da_marca;

        //Salva
        $marca->save();

        //Retorna o resultado
        return response() -> json([
            'status' => 200,
            'mensagem' => 'Marca criada',
            'marca' => new MarcaResource($marca)
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Marcas $marcas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marcas $marcas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreMarcaRequest $request, Marcas $marca)
    {
        $marca = Marcas::find($marca->pkmarca);
        $marca->nomedamarca = $request->nome_da_marca;
        $marca->update();


        return response() -> json([
            'status' => 200,
            'mensagem' => 'Marca atualizada'

        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Marcas $marca)
    {
        $marca->delete();

        return response() -> json ([
            'status' => 200,
            'mensagem' => 'marca Deletada!'
        ], 200);
    }
}
