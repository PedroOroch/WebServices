<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MarcaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //Mantido para documentação
        //return parent::toArray($request);
        return [
            'id' => $this->pkcategoria,
            'nome_da_categoria' => $this->nomedacategoria
        ];
    }
}
