<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use App\Models\{Sorteio, Produto};
use App\Models\DepartamentoUsuario;
use App\Models\DepartamentoProduto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SorteioController extends Controller
{

    public function index()
    {
        $departamento = Auth::user()->departamentos()->first();

        $sorteio = $departamento->sorteio()->paginate(10);

        //dd($sorteio);

        /* Se no caso, a página atual for maior que a última página, 
        impossível, pois como por exemplo, uma paginação ter 5 páginas 
        e a atual ser a 6ª página, IMPOSSÍVEL!!!. Aí no caso, há essa 
        operação de 'abort 404' (que é no caso o 'NOT FOUND'), se no caso, 
        o usuário, tente burlar a paginação, caso queira colocar uma página inexistente. */
        
        if ($sorteio->currentPage() > $sorteio->lastPage()) {
            return redirect()->back();
        }

        //dd($sorteio->count());

        $data = Carbon::now()->settings(['locale' => 'pt_BR', 'timezone' => 'America/Sao_Paulo']);

        //dd($sorteio);

        return view('sorteios.index', compact('departamento','data','sorteio'));

    }

    public function create()
    {
        return view('sorteios.create');
    }

    public function store(Request $request)
    {
        
        $departamento = Departamento::find($request->departamento_id);

        if (!$departamento) {
            return response()->json(['erro' => 'Departamento Inválido!!!', 400]);
        }


        $users = $departamento->users;
        $produtos = $departamento->produtos;
        
        // Se tanto 'usuários' e 'produtos' tiverem vazia em 'departamentos'
        if($users->isEmpty() || $produtos->isEmpty()) {
            return response()->json(['alerta' => 'Usuário ou Produtos não cadastrados. Por favor, cadastre primeiro, para a realização do sorteio!!!']);
        }

        // Pega a data em tempo real
        $data = Carbon::now()->settings(['locale' => 'pt_BR', 'timezone' => 'America/Sao_Paulo']);

        //O 'sorteio1' vai pegar o id do 'usuario', enquanto o 'sorteio2' vai pegar o id do 'produto'
        $sorteio1 = Sorteio::where('departamento_id', $departamento->id)->whereMonth('created_at', $data->month)->pluck('user_id');
        $sorteio2 = Sorteio::where('departamento_id', $departamento->id)->whereMonth('created_at', $data->month)->pluck('produto_id');

        $usuarios_nao_sorteados = $users->filter(function ($value, $key) use ($sorteio1) {
            if ($value->nivel == null) {
                return !in_array($value->id, $sorteio1->all());
            }
        });

        $produto_nao_sorteado = $produtos->filter(function ($value, $key) use ($sorteio2) {
            return !in_array($value->id, $sorteio2->all());
        });

        if ($users->count() <= 1) {
            return response()->json(['menor' => 'Impossível fazer o sorteio com essa quantidade de pessoas']);
        }


        // Se a quantidade de produtos for maior que a quantidade de usuários
        if ($produto_nao_sorteado->count() > $usuarios_nao_sorteados->count()) {
            return response()->json(['aviso' => 'Como a quantidade de produtos é maior do que a de usuários, impossivel realizar o sorteio!!!']);
        }
        
        if ($produto_nao_sorteado->isEmpty()) {
            return response()->json(['msg' => 'Todos os produtos já foram sorteados!!!']);
        }

        $usuario_sorteado = $usuarios_nao_sorteados->random();
        $produto_sorteado = $produto_nao_sorteado->random();

        Sorteio::create([
            'departamento_id' => $departamento->id,
            'user_id' => $usuario_sorteado->id,
            'produto_id' => $produto_sorteado->id,
            'status' => 'A',
        ]);

        return response()->json(['sorteado' => $usuario_sorteado->name, 'produto' => $produto_sorteado->nome, 'data' => $data->isoFormat('DD/MM/YYYY HH:mm:ss'), 'segura' => $produto_nao_sorteado, 'quantidade' => $produto_nao_sorteado->count()]);
    }

    public function show($id)
    {
        $sorteio = Sorteio::findOrFail($id);

        return view('sorteios.show', ['sorteio' => $sorteio]);
    }

    public function edit($id)
    {
        $sorteio = Sorteio::findOrFail($id);

        return view('sorteios.edit', ['sorteio' => $sorteio]);
    }

    public function update(Request $request, $id)
    {
        $sorteio = Sorteio::findOrFail($id);

        $sorteio->update([
            //Aqui fica as atualizações do banco de dados
        ]);

        return redirect()->route('sorteios.index')->with(['msg' => 'Sorteio Criado com Sucesso']);
    }

    public function delete($id)
    {
        $sorteio = Sorteio::findOrFail($id);
        return view('sorteios.delete', compact('sorteio'));
    }

    public function destroy($id)
    {
        $sorteio = Sorteio::findOrFail($id);
        $sorteio->delete();

        return redirect()->route('sorteios.index')->with(['msg' => 'Sorteio Criado com Sucesso']);
    }
}
