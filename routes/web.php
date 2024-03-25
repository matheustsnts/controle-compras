<?php

use App\Http\Controllers\{
    UserController,
    DepartamentoController,
    HomeController
};
use App\Mail\newLaravelTips;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('envio-email', function() {
    $user = new stdClass();
    $user->name = 'Matheus';
    $user->email = 'matheusteixeras1@gmail.com';
    return new newLaravelTips($user);
});

Route::middleware(['auth'])->group(function () {
    
    //Users
    // Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('/editar_dados_usuario', [UserController::class, 'create'])->name('users.create');
    Route::post('/editar_dados_usuario', [UserController::class, 'store'])->name('users.store');
    Route::get('/mostrar_usuario', [UserController::class, 'show'])->name('users.show');
    // Route::get('/users/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/editar_usuario', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/editar_usuario', [UserController::class, 'update'])->name('alterar_user');
    // Route::get('/users/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::post('/apagar_usuario', [UserController::class, 'destroy'])->name('deletar_user');
    // Route::get('/users/departamentos', [UserController::class, 'departamentos'])->name('users.departamentos');
    // Route::post('/users/departamentos/insert', [UserController::class, 'insertDepartamentos'])->name('users.departamentos.insert');
    // Route::get('/users/apagar_departamento', [UserController::class, 'selectDepartamentos'])->name('users.departamentos.apagar');
    // Route::get('/users/administrador', [UserController::class, 'user_administrador'])->name('adm_user');
    // Route::post('/users/administrador', [UserController::class, 'user_admistrador_request'])->name('adm_user_request');
    // Route::get('/perfil', [UserController::class,'perfil_user'])->name('perfil_user');
    
    //Departamento
    Route::get('/departamentos/index', [DepartamentoController::class, 'index'])->name('departamentos.index');
    Route::get('/departamentos/create', [DepartamentoController::class, 'create'])->name('departamentos.create');
    Route::post('/departamentos/store', [DepartamentoController::class, 'store'])->name('departamentos.store');
    Route::get('/departamentos/show/{id}', [DepartamentoController::class, 'show'])->name('departamentos.show');
    Route::get('/departamentos/edit/{id}', [DepartamentoController::class, 'edit'])->name('departamentos.edit');
    Route::post('/departamentos/edit/{id}', [DepartamentoController::class, 'update'])->name('departamentos.update');
    Route::get('/departamentos/delete/{id}', [DepartamentoController::class, 'delete'])->name('departamentos.delete');
    Route::post('/departamentos/delete/{id}', [DepartamentoController::class, 'destroy'])->name('deletar_departamento');
    Route::post('/departamentos/index/{id}', [DepartamentoController::class, 'insertUser'])->name('inserir_departamento');
    Route::get('/departamentos/usuarios/{id}', [DepartamentoController::class, 'usuarios'])->name('departamento.usuarios');
    Route::post('/departamentos/usuarios/{id}/insert', [DepartamentoController::class, 'insertUsers'])->name('departamento.usuarios.update');
    Route::get('/adicionar_produto/{id}', [DepartamentoController::class, 'produtos'])->name('departamentos.produtos');
    //Route::post('/adicionar_produto/{id}/insert', [DepartamentoController::class, 'insertProdutos'])->name('departamentos.produtos.insert');
    Route::delete('/departamentos/show/deleteUser/{id}', [DepartamentoController::class, 'dShow'])->name('departamentos.showDelete');
    Route::post('/adicionar_produto/{id}/insert', [DepartamentoController::class, 'deptProdutos'])->name('insertDeptProdutos');
    Route::delete('/departamentos/show/deleteProduto/{id}', [DepartamentoController::class, 'dShowProduto'])->name('departamentos.showDeleteProduto');
    Route::get('/departamentos/sorteado/{id}', [DepartamentoController::class, 'sorteado'])->name('departamento.sorteado');
    Route::get('/departamentos/sorteados/{id}', [DepartamentoController::class, 'showSorted'])->name('departamento.showSorted');
    Route::post('/admin', [DepartamentoController::class, 'admin_user'])->name('admin_user');

    //Produtos
    Route::get('/produtos', [App\Http\Controllers\ProdutoController::class, 'index'])->name('produtos.index')->middleware('permission:admin');
    Route::get('/criar_produtos', [App\Http\Controllers\ProdutoController::class, 'create'])->name('produtos.create')->middleware('permission:nivel-1|nivel-2|nivel-3|nivel-4');
    Route::post('/criar_produtos', [App\Http\Controllers\ProdutoController::class, 'store'])->name('registrar_produto');
    Route::get('/produtos/show/{id}', [App\Http\Controllers\ProdutoController::class, 'show'])->name('produtos.show');
    Route::get('/produtos/edit/{id}', [App\Http\Controllers\ProdutoController::class, 'edit'])->name('produtos.edit')->middleware('permission:nivel-1|nivel-2|nivel-3|nivel-4');
    Route::post('/produtos/edit/{id}', [App\Http\Controllers\ProdutoController::class, 'update'])->name('alterar_produto');
    Route::get('/produtos/selecionar', [App\Http\Controllers\ProdutoController::class, 'select'])->name('produtos.select');
    Route::post('/produtos/select/deletar', [App\Http\Controllers\ProdutoController::class, 'deletar'])->name('produtos.deletar');

    //Sorteios
    Route::get('/mostrar_sorteios', [App\Http\Controllers\SorteioController::class, 'index'])->name('sorteios.index');
    Route::get('/sorteios/create', [App\Http\Controllers\SorteioController::class, 'create'])->name('sorteios.create');
    Route::post('/sorteios/create', [App\Http\Controllers\SorteioController::class, 'store'])->name('sorteios.store');
    Route::get('/sorteios/show/{id}', [App\Http\Controllers\SorteioController::class, 'show'])->name('sorteios.show');
    Route::get('/sorteios/edit/{id}', [App\Http\Controllers\SorteioController::class, 'edit'])->name('sorteios.edit');
    Route::post('/sorteios/edit/{id}', [App\Http\Controllers\SorteioController::class, 'update'])->name('alterar_sorteio');
    Route::get('/sorteios/delete/{id}', [App\Http\Controllers\SorteioController::class, 'delete'])->name('sorteios.delete');
    Route::post('/sorteios/delete/{id}', [App\Http\Controllers\SorteioController::class, 'destroy'])->name('excluir_sorteio');

    //Departamento_Usuarios
    Route::get('/departamento_usuarios/index', [App\Http\Controllers\Departamento_UsuarioController::class, 'index'])->name('departamento_usuarios.index');
    Route::get('/departamento_usuarios/create', [App\Http\Controllers\Departamento_UsuarioController::class, 'create'])->name('departamento_usuarios.create');
    Route::post('/departamento_usuarios/create', [App\Http\Controllers\Departamento_UsuarioController::class, 'store'])->name('registrar_departamento_usuario');
    Route::get('/departamento_usuarios/show/{id}', [App\Http\Controllers\Departamento_UsuarioController::class, 'show'])->name('departamento_usuarios.show');
    Route::get('/departamento_usuarios/edit/{id}', [App\Http\Controllers\Departamento_UsuarioController::class, 'edit'])->name('departamento_usuarios.edit');
    Route::post('/departamento_usuarios/edit/{id}', [App\Http\Controllers\Departamento_UsuarioController::class, 'update'])->name('alterar_departamento_usuario');
    Route::get('/departamento_usuarios/delete/{id}', [App\Http\Controllers\Departamento_UsuarioController::class, 'delete'])->name('departamento_usuarios.delete');
    Route::post('/departamento_usuarios/delete/{id}', [App\Http\Controllers\Departamento_UsuarioController::class, 'destroy'])->name('excluir_departamento_usuario');
});


