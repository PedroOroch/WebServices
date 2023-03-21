<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'idade'];
    protected $primaryKey = 'id';
    protected $table = 'clientes';

    public $incrementing = true;

    public $timestamps = false;
}
