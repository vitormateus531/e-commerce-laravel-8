<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutosModel extends Model
{
    use HasFactory;

    public $table = 'produtos';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [ 
        'nome',
        'codigo',
        'valor'
    ];
}
