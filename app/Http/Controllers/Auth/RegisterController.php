<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\DepartamentoUsuario;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // public function showRegistrationForm()
    // {
    //     $departamentos = Departamento::all();

    //     return view('auth.register', compact('departamentos'));
    // }

    protected function validator(array $data)
    {   
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'avatar' => ['image','mimes:jpg,png,jpg,gif,svg','max:2048'],
            'departamento_id' => ['required', 'string', 'exists:departamentos,id'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        
        DepartamentoUsuario::create([
            'departamento_id' => $data['departamento_id'],
            'user_id' => $user->id
        ]);

        return $user;
    }

    public function showRegistrationForm(Request $request)
    {
        $departamentos = Departamento::get();

        $request1 = $request;

        return view('auth.register', compact('departamentos','request1'));
    }
}
