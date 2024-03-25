<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdutoStoreRequest;
use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Auth\Access\Gate;

class ProdutoController extends Controller
{
    public function index()
    {

        $produto = Produto::paginate(10);

        if($produto->currentPage() > $produto->lastPage()) {
            return redirect()->back();
        }

        return view('produtos.index', compact('produto'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(ProdutoStoreRequest $request)
    {
        Produto::create($request->validated());

        return redirect()->route('produtos.index');
    }

    public function show($id)
    {
        $produto = Produto::findOrFail($id);

        return view('produtos.show', ['produto' => $produto]);
    }

    public function edit($id)
    {
        $produtos = Produto::findOrFail($id);

        return view('produtos.edit', compact('produtos'));
    }

    public function update(ProdutoStoreRequest $request, $id)
    {
        $produtos = Produto::findOrFail($id);

        $produtos->update(
            $request->all()
        );
        
        return redirect()->route('produtos.index', compact('produtos'))->with('Produto Alterado com Sucesso');
    }

    public function delete($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.delete', compact('produto'));
    }

    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('produtos.index')->with("produto_excluido","Produto $produto->nome excluído com sucesso!!!");
    }

    public function select()
    {
        $produto = Produto::all();

        return view('produtos.select', compact('produto'));
    }

    public function deletar(Request $request)
    {
        // dd($request->all());

        Produto::destroy($request->produto_id);

        //dd($request->produto_id);

        return redirect()->route('produtos.index')->with('produto_excluido', 'Produto Deletado com Sucesso');
    }
}
