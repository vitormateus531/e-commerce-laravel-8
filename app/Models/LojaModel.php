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

     
    /**
     * consegue consegue os produtos da loja.
     */
    public function getProdutos()
    {
        return $this->belongsToMany(ProdutosModel::class, 'loja_produtos', 'loja_id', 'produtos_id')
            ->withTimestamps();
    }
}
