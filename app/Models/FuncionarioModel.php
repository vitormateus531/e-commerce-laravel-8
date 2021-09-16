<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionarioModel extends Model
{
    use HasFactory;

    public $table = 'funcionarios';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [ 
        'nome',
        'sobrenome',
        'email',
        'id_cargo',
        'id_loja',
    ];
}
