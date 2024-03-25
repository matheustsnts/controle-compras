<?php

namespace App\Http\Controllers;

use App\Models\{
    User,
    Departamento,
    Sorteio,
    Sorteado,
    Produto
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $departamento = Auth::user()->departamentos()->first();
        //dd($departamento);

        return view('home', compact('departamento'));
    }
}
