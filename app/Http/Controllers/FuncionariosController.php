<?php

namespace App\Http\Controllers;

use App\Models\CargosModel;
use App\Models\FuncionarioModel;
use App\Models\LojaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDOException;

class FuncionariosController extends Controller
{
    //  //
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuario = Auth::user()->id;
        $loja = LojaModel::where('id', $request->loja)->first();
        $funcionarios = FuncionarioModel::select('funcionarios.id as id', 'funcionarios.nome', 'funcionarios.email', 'loja.nome as loja_nome', 'cargos.nome as cargo_nome')
            ->join('cargos', 'funcionarios.id_cargo', 'cargos.id')
            ->join('loja', 'funcionarios.id_loja', 'loja.id')
            ->where('loja.id_user', $usuario)
            ->where('funcionarios.id_loja', $loja->id)->get();

        return view('funcionarios.index', compact('funcionarios', 'loja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $usuario = Auth::user()->id;
        $cargos = CargosModel::all();
        $loja = LojaModel::where('id_user', $usuario)->where('id', $request->loja)->first();
        return view('funcionarios.create', compact('cargos', 'loja'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $cadastrarUsuario = new FuncionarioModel;
            $cadastrarUsuario->nome = $request->input('nome');
            $cadastrarUsuario->sobrenome = $request->input('sobrenome');
            $cadastrarUsuario->email = $request->input('email');
            $cadastrarUsuario->id_cargo = $request->input('cargo');
            $cadastrarUsuario->id_loja = $request->input('loja');
            $cadastrarUsuario->save();

            return redirect()->route('funcionarios.index', ['loja' => $request->input('loja')])->with('sucesso', 'usuário cadastrado com sucesso!');
        } catch (PDOException $e) {
            return redirect()->route('funcionarios.index', ['loja' => $request->input('loja')])->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kernel\KrStatusRecord  $krStatusRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $loja = LojaModel::where('id', $request->loja)->first();
        $funcionario = FuncionarioModel::where('id', $id)->first();
        $cargos = CargosModel::all();
        return view('funcionarios.edit', compact('funcionario', 'cargos', 'loja'));
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

        try {
            $atualizarFuncionario = FuncionarioModel::find($id);
            $atualizarFuncionario->nome = $request->input('nome');
            $atualizarFuncionario->sobrenome = $request->input('sobrenome');
            $atualizarFuncionario->email = $request->input('email');
            $atualizarFuncionario->id_cargo = $request->input('cargo');
            $atualizarFuncionario->save();

            return redirect()->route('funcionarios.index', ['loja' => $request->input('loja')])->with('sucesso', 'funcionário atualizado com sucesso!');
        } catch (PDOException $e) {
            return redirect()->route('funcionarios.index', ['loja' => $request->input('loja')])->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kernel\KrStatusRecord  $krStatusRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $removerFuncionario = FuncionarioModel::find($id);
            $removerFuncionario->delete();

            return redirect()->route('funcionarios.index', ['loja' => $request->loja])->with('sucesso', 'funcionário removido com sucesso!');
        } catch (PDOException $e) {
            return redirect()->route('funcionarios.index', ['loja' => $request->loja])->with('error', $e->getMessage());
        }
    }
}
