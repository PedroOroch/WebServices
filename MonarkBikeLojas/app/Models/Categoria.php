<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    //campos publicaveis
    protected $fillable = ['nomedacategoria'];

    //nome da chave primaria
    protected $primaryKey = 'pkcategoria';

    //Nome da Table
    protected $table = 'categorias';

    //Informa que esta trabalhando com incremento
    public $incrementing = true;

    //não utiliza timestamps (created & updated)
    public $timestamps = false;
}
