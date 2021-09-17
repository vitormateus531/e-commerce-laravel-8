<?php

namespace App\Http\Controllers;

use App\Models\FuncionarioModel;
use App\Models\LojaModel;
use App\Models\ProdutosModel;
use PDOexception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LojaController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = Auth::user()->id;
        $lojas = LojaModel::where('id_user', $usuario)->get();
        return view('loja.index', compact('lojas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('loja.create');
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
            $usuario = Auth::user()->id;

            $cadastrarLojas = new LojaModel;
            $cadastrarLojas->nome = $request->input('nome');
            $cadastrarLojas->endereco = $request->input('endereco');
            $cadastrarLojas->id_user = $usuario;
            $cadastrarLojas->save();
            return redirect()->route('lojas.index')->with('sucesso', 'Loja inserida com sucesso!');
        } catch (PDOexception $e) {
            return redirect()->route('lojas.index')->with('error', $e->getMessage());
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
        $loja = LojaModel::where('id', $id)->first();
        return view('loja.show', compact('loja'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kernel\KrStatusRecord  $krStatusRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = Auth::user()->id;
        $loja = LojaModel::where('id_user', $usuario)->where('id', $id)->first();
        return view('loja.edit', compact('loja'));
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

            $atualizarLoja = LojaModel::find($id);
            $atualizarLoja->nome = $request->input('nome');
            $atualizarLoja->endereco = $request->input('endereco');
            $atualizarLoja->save();

            return redirect()->route('lojas.index')->with('sucesso', 'Loja atualizada com sucesso!');
        } catch (PDOexception $e) {
            return redirect()->route('lojas.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kernel\KrStatusRecord  $krStatusRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                
                $removerProdutosLoja = ProdutosModel::where('id_loja', $id)->get();
                foreach ($removerProdutosLoja as $removerProdutos) {
                    $removerProdutos->delete();
                }

                $removerFuncionariosLoja = FuncionarioModel::where('id_loja', $id)->get();
                foreach ($removerFuncionariosLoja as $removerFuncionarios) {
                    $removerFuncionarios->delete();
                }

                $removerLoja = LojaModel::find($id);
                $removerLoja->delete();
            });

            return redirect()->route('lojas.index')->with('sucesso', 'Loja removida com sucesso!');
        } catch (PDOexception $e) {
            return redirect()->route('lojas.index')->with('error', $e->getMessage());
        }
    }
}
