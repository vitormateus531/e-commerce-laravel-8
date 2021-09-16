<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargosModel extends Model
{
    use HasFactory;

    
    public $table = 'cargos';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [ 
        'nome'
    ];
}
