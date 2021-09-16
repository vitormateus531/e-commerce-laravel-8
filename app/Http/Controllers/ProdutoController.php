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
    public function index()
    {
        $produtos = ProdutosModel::select('produtos.id','produtos.nome','produtos.codigo','produtos.valor','loja.nome as loja_nome')
        ->join('loja','produtos.id_loja','loja.id')->get();

        return view('produtos.index',compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario = Auth::user()->id;
        $lojas = LojaModel::where('id_user', $usuario)->get();
        return view('produtos.create', compact('lojas'));
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

            return redirect()->route('produtos.index')->with('sucesso', 'produto cadastrado com sucesso!');
        } catch (PDOexception $e) {
            return redirect()->route('produtos.index')->with('error', $e->getMessage());
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
