<?php

namespace App\Http\Controllers;

use App\Models\FuncionarioModel;
use App\Models\LojaModel;
use App\Models\ProdutosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function view(){
        
        $usuario = Auth::user()->id;
        $usuarioNome = Auth::user()->name;
        $funcionarios = FuncionarioModel::join('loja','funcionarios.id_loja','loja.id')->where('loja.id_user', $usuario)->count();
        $lojas =   LojaModel::where('id_user', $usuario)->count();
        $produtos = ProdutosModel::join('loja','produtos.id_loja','loja.id')->where('loja.id_user', $usuario)->count();
        return view('dashboard',compact('usuario','usuarioNome','funcionarios','lojas','produtos'));
    }
}
