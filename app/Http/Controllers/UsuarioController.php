<?php

namespace App\Http\Controllers;

use App\Models\CargosModel;
use App\Models\FuncionarioModel;
use App\Models\LojaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class UsuarioController extends Controller
{
    
    //
        //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user()->id;
        $funcionarios = FuncionarioModel::select('funcionarios.id as id','funcionarios.nome','funcionarios.email','loja.nome as loja_nome','cargos.nome as cargo_nome')
        ->join('cargos','funcionarios.id_cargo','cargos.id')
        ->join('loja','funcionarios.id_loja','loja.id')->where('loja.id_user', $usuario)->get();
        
        return view('usuarios.index',compact('funcionarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user()->id;
        $cargos = CargosModel::all();
        $lojas = LojaModel::where('id_user', $user)->get();
        return view('usuarios.create',compact('cargos','lojas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            
            $cadastrarUsuario = new FuncionarioModel;
            $cadastrarUsuario->nome = $request->input('nome');
            $cadastrarUsuario->sobrenome = $request->input('sobrenome');
            $cadastrarUsuario->email = $request->input('email');
            $cadastrarUsuario->id_cargo = $request->input('cargo');
            $cadastrarUsuario->id_loja = $request->input('loja');
            $cadastrarUsuario->save();

            return redirect()->route('usuarios.index')->with('sucesso', 'usuário cadastrado com sucesso!');

        }catch(Exception $e){
            return redirect()->route('usuarios.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kernel\KrStatusRecord  $krStatusRecord
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kernel\KrStatusRecord  $krStatusRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kernel\KrStatusRecord  $krStatusRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kernel\KrStatusRecord  $krStatusRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
