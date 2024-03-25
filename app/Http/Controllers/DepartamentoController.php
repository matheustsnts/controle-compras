<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartamentoStoreRequest;
use Illuminate\Http\Request;
use App\Models\Departamento;
use App\Models\DepartamentoUsuario;
use App\Models\DepartamentoProduto;
use App\Models\Produto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DepartamentoController extends Controller
{

    public function index()
    {
        $user_departamento = Auth::user()->departamentos()->first();
        $departamento = Departamento::with(['users', 'sorteio', 'produtos'])->orderBy('nome')->get();
        return view('departamentos.index', compact('departamento', 'user_departamento'));
    }

    public function create()
    {
        return view('departamentos.create');
    }

    public function store(DepartamentoStoreRequest $request)
    {
        dd($request->validated());

        // Departamento::create($request->all());
        // return redirect()->route('departamentos.index')->with(['msg' => 'Departamento Criado com Sucesso']);
    }

    public function show($id)
    {
        $departamento = Departamento::findOrFail($id);

        return view('home', compact('departamento'));
    }



    public function showSorted($id)
    {
        $departamento = Departamento::with('users', 'produtos')->findOrFail($id);

        $user = $departamento->users()->inRandomOrder()->first();

        $produto = $departamento->produtos()->inRandomOrder()->first();

        //$produto

        //dd($user, $departamento);

        return response()->json([$departamento, $user, $produto]);
    }

    public function dShow($id, Request $request)
    {
        $departamento = Departamento::findOrFail($id);

        $user = DepartamentoUsuario::where('departamento_id', $departamento->id)->where('user_id', $request->user_id)->first();

        DepartamentoUsuario::where('departamento_id', $departamento->id)->where('user_id', $request->user_id)->delete();

        return redirect()->route('home', ['id' => $departamento])->with("status", "Usuário $user->name deletado com sucesso!!!");
    }

    public function dShowProduto($id, Request $request)
    {
        $departamento = Departamento::findOrFail($id);

        $produto = DepartamentoProduto::where('departamento_id', $departamento->id)->where('produto_id', $request->produto_id)->first();

        DepartamentoProduto::where('departamento_id', $departamento->id)->where('produto_id', $request->produto_id)->delete();

        return redirect()->route('home')->with("status", "Produto $produto->nome deletado com sucesso!!!");
    }

    public function edit($id)
    {
        $departamentos = Departamento::findOrFail($id);

        return view('departamentos.edit', ['departamentos' => $departamentos]);
    }

    public function update(DepartamentoStoreRequest $request, $id)
    {
        //dd($request->all());
        $departamentos = Departamento::findOrFail($id);

        $departamentos->update($request->all());

        return redirect()->route('departamentos.index')->with('Departamento Alterado com Sucesso');
    }

    public function delete($id)
    {
        $departamento = Departamento::findOrFail($id);
        return view('departamentos.delete', compact('departamento'));
    }

    public function destroy($id)
    {
        $departamento = Departamento::findOrFail($id);
        $departamento->delete();

        return redirect()->route('departamentos.index')->with('Departamento Excluído com Sucesso');
    }

    public function usuarios($id)
    {

        if (Auth::user()->admin == false) {
            abort(403, 'ACESSO RESTRITO');
        }

        $departamento = Departamento::findOrFail($id);

        $user = User::whereDoesntHave('departamentos')->orderBy('name', 'asc')->get();

        if ($user->isEmpty()) {
            return view('departamentos.usuarios', compact('departamento', 'user'));
        }

        foreach ($user as $users) {
            if ($users->admin == true) {
                $users->update(['admin' => false]);
            }
        }

        return view('departamentos.usuarios', compact('departamento', 'user'));
    }

    public function insertUsers($id, Request $request)
    {
        $departamento = Departamento::findOrFail($id);

        if ($request->users == null) {
            return redirect()->back()->withErrors(['erro_user' => 'Você não adicionou nenhum usuário.']);
        } else {
            foreach ($request->users as $user) {
                $user = DepartamentoUsuario::create([
                    'user_id' => $user,
                    'departamento_id' => $departamento->id,
                ]);
            }

            if (count($request->users) == 1) {
                return redirect()->route('home')->with('add', "Usuário adicionado com sucesso!!!");
            }
    
            if (count($request->users) > 1) {
                return redirect()->route('home')->with('add', "Usuários adicionados com sucesso!!!");
            }
    
            if (count($request->users) <= 0) {
                return redirect()->route('home');
            }
    
        }

        
    }

    public function deletarUsuario($id, Request $request)
    {
        $user = User::findOrFail($id);

        foreach ($request->departamentos as $departamento) {
            DepartamentoUsuario::create([
                'departamento_id' => $departamento,
                'user_id' => $user->id
            ]);
        }
    }

    public function produtos($id)
    {
        $departamento = Departamento::findOrFail($id);
        //dd($departamento->produtos);
        $produto = Produto::whereNotIn('id', $departamento->produtos->modelKeys())->get();
        //dd($produto);
        return view('departamentos.produtos', compact('departamento', 'produto'));
    }

    public function deptProdutos($id, Request $request)
    {
        $departamento = Departamento::findOrFail($id);

        //dd($request->all());

        if ($request->produtos == null) {
            return redirect()->back()->withErrors(['erro_produto' => 'Você não inseriu nenhum produto.']);
        } else {
            foreach ($request->produtos as $produto) {
                if (!in_array($produto, $departamento->produtos->modelKeys())) {
                    DepartamentoProduto::create([
                        'departamento_id' => $departamento->id,
                        'produto_id' => $produto
                    ]);
                } 
            }
            return redirect()->route('home')->with('produtos_inseridos','Produtos inseridos com sucesso!!!');
        }   
    }

    public function insertProdutos($id, Request $request)
    {
        $departamento = Departamento::findOrFail($id);
        // dd($request->all());
        foreach ($request->produtos as $produto) {
            DepartamentoProduto::create([
                'departamento_id' => $departamento->id,
                'produto_id' => $produto
            ]);
        }

        return redirect()->route('departamentos.index');
    }

    public function admin_user(Request $request)
    {

        $user = User::findOrFail($request->user_id);

        if (Auth::user()->id === $user->id) {
            $user->update(['admin' => false]);
            return redirect()->route('home')->with('not_admin','Você não é mais administrador!!!');
        } else {
            if ($user->admin == true) {
                $user->update(['admin' => false]);
                return response()->json($user);
            }
            if ($user->admin == false) {
                $user->update(['admin' => true]);
                return response()->json($user);
            }
        }
    }

}
