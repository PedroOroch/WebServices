<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    //campos publicaveis
    protected $fillable = ['nomedamarca'];

    //nome da chave primaria
    protected $primaryKey = 'pkmarca';

    //Nome da Table
    protected $table = 'marcas';

    //Informa que esta trabalhando com incremento
    public $incrementing = true;

    //não utiliza timestamps (created & updated)
    public $timestamps = false;
}
