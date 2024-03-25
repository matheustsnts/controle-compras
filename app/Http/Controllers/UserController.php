<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;


use App\Models\{
    User,
    Departamento,
    DepartamentoUsuario
};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function index()
    {
        $user = User::with(['departamentos'])->orderBy('name')->get();
        $userAuth = Auth::user();
        $departamento = $userAuth->departamentos()->first();
        //dd($departamento->users);
        $userName = DB::table('users')->select('name');


        return view('users.index', compact('user', 'userAuth', 'userName', 'departamento'));
    }

    public function create()
    {
        $user = Auth::user();

        return view('users.create', compact('user'));
    }

    public function store(Request $request)
    {
        
        if ($request->name == null && $request->email != null) {
            Auth::user()->update(
                ['email' => $request->email]
            );

            return redirect()->route('users.show')->with(['msg' => 'User Criado com Sucesso']);
        }

        if ($request->name != null && $request->email == null) {
            Auth::user()->update(
                ['name' => $request->name]
            );

            return redirect()->route('users.show')->with(['msg' => 'User Criado com Sucesso']);
        }

        if ($request->name != null && $request->email != null) {
            Auth::user()->update(
                [
                    'name' => $request->name,
                    'email' => $request->email
                ]
            );

            return redirect()->route('users.show')->with(['msg' => 'User Criado com Sucesso']);
        }

        if (!$request->name && !$request->email) {
            return redirect()->back()->withErrors(['erro_nome' => 'Ambos os campos não podem está vazio.', 'erro_email' => 'Ambos os campos não podem está vazio    .']);
        }
    }

    public function show()
    {
        $user = Auth::user();
        //dd($user);

        return view('users.show', ['user' => $user]);
    }

    public function edit()
    {
        $user = Auth::user();

        return view('users.edit', ['user' => $user]);
    }

    public function update(PasswordRequest $request)
    {
        //dd($request->all());

        $user = Auth::user();

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('home')->with('updated', 'Dados alterados com sucesso!!!');
    }

    public function selectDepartamentos()
    {
        $users = User::with('departamentos')->get();

        $departamentos = Departamento::all();


        return view('users.select_departamentos', compact('users', 'departamentos'));
    }

    public function delete()
    {
        $user = Auth::user();
        return view('users.delete', compact('user'));
    }

    public function destroy()
    {
        $user = Auth::user();
        $user->delete();

        return redirect()->route('login')->with(['apagado' => 'User Excluido com Sucesso']);
    }

    public function departamentos()
    {
        $user = Auth::user();

        $departamento = Departamento::get();

        return view('users.departamentos', compact('user', 'departamento'));
    }

    public function insertDepartamentos(Request $request)
    {
        $user = Auth::user();

        foreach ($request->departamentos as $departamento) {
            DepartamentoUsuario::create([
                'departamento_id' => $departamento,
                'user_id' => $user->id
            ]);
        }

        return redirect()->route('users.index');
    }

    public function user_administrador()
    {
        if (Auth::user()->admin == false) {
            abort(403, 'USUÁRIO NÃO É ADMINISTRADOR');
        }

        $departamento = Auth::user()->departamentos()->first();

        return view('users.administrador', compact('departamento'));
    }

    public function user_admistrador_request(Request $request)
    {

        $departamento = Auth::user()->departamentos()->first();

        foreach ($request->users as $users) {
            $departamento->users()->update(['admin' => true]);
        }

        return redirect()->route('home');
    }

    public function perfil_user()
    {
    }
}
