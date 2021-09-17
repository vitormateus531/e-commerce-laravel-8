<?php

namespace App\Http\Controllers;

use App\Models\LojaModel;
use App\Models\ProdutosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDOException;

class ProdutoController extends Controller
{
    //
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuario = Auth::user()->id;
        $loja = LojaModel::where('id',$request->loja)->first();
        $produtos = ProdutosModel::select('produtos.id','produtos.nome','produtos.codigo','produtos.valor','loja.nome as loja_nome')
        ->join('loja','produtos.id_loja','loja.id')
        ->where('produtos.id_loja', $loja->id)
        ->where('loja.id_user', $usuario)
        ->get();

        return view('produtos.index',compact('produtos','loja'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $usuario = Auth::user()->id;
        $loja = LojaModel::where('id_user', $usuario)->where('id',$request->loja)->first();
        return view('produtos.create', compact('loja'));
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

            $cadastrarProduto = new ProdutosModel;
            $cadastrarProduto->nome = $request->input('nome');
            $cadastrarProduto->codigo = $request->input('codigo');
            $cadastrarProduto->valor = $request->input('valor');
            $cadastrarProduto->id_loja = $request->input('loja');
            $cadastrarProduto->save();

            return redirect()->route('produtos.index',['loja' => $request->input('loja')])->with('sucesso', 'produto cadastrado com sucesso!');
        } catch (PDOexception $e) {
            return redirect()->route('produtos.index',['loja' => $request->input('loja')])->with('error', $e->getMessage());
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
        $loja = LojaModel::where('id',$request->loja)->first();
        $produtos = ProdutosModel::where('id', $id)->first();

        return view('produtos.edit', compact('produtos','loja'));
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
        try{
            $atualizarProduto = ProdutosModel::find($id);
            $atualizarProduto->nome = $request->input('nome');
            $atualizarProduto->codigo = $request->input('codigo');
            $atualizarProduto->valor = $request->input('valor');
            $atualizarProduto->save();

            return redirect()->route('produtos.index',['loja' => $request->loja])->with('sucesso', 'produto atualizado com sucesso!');
        }catch(PDOException $e){
            return redirect()->route('produtos.index',['loja' => $request->loja])->with('error', $e->getMessage());
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
        try{
            $removerProduto = ProdutosModel::find($id);
            $removerProduto->delete();

            return redirect()->route('produtos.index',['loja' => $request->loja])->with('sucesso', 'produto removido com sucesso!');
        }catch(PDOexception $e){
            return redirect()->route('produtos.index',['loja' => $request->loja])->with('error', $e->getMessage());
        }
    }
}
