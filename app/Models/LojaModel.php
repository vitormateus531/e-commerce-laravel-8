<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LojaModel extends Model
{
    use HasFactory;

    public $table = 'loja';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [ 
        'nome',
        'endereco',
        'id_user'
    ];

}
