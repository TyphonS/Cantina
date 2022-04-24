<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CantinaController;
use App\Http\Controllers\RelacaoController;
use App\Http\Controllers\ResponsavelController;
use App\Http\Controllers\UserController;

/* Rota inicial direciona para a view inicial */
Route::get('/', function () {
    return view('auth.login');
});

/* Conjunto de rotas da cantina */
Route::prefix('cantina')->name('cantina.')->group(function(){
    Route::middleware(['guest:cantina','PreventBackHistory'])->group(function(){
        Route::post('/check',[CantinaController::class,'check'])->name('check');
        Route::view('/cantinasu','cantinahome')->name('cantinasu');

    });

    Route::middleware(['auth:cantina','PreventBackHistory'])->group(function(){
        
        Route::get('/logistica','App\Http\Controllers\RelacaoController@index')->name('logistica');
        Route::post('/sair',[CantinaController::class,'sair'])->name('sair');
        Route::post('/cadastrarproduto',[RelacaoController::class,'cadastrar'])->name('cadastrarproduto');
        Route::get('/del/{id}',[RelacaoController::class,'excluir'])->name('del');
        Route::get('/edit/{id}',[RelacaoController::class,'editar']);
        Route::put('/edit',[RelacaoController::class,'editaracao'])->name('editarprod');
        Route::get('/done/{id}',[RelacaoController::class,'done'])->name('done');

        Route::post('/cadastrarresponsavel',[RelacaoController::class,'cadastrarResp'])->name('cadastrarresponsavel');
        Route::get('/delresp/{id}',[RelacaoController::class,'excluirResp'])->name('delresp');
        Route::get('/editresp/{id}',[RelacaoController::class,'editarResp']);
        Route::put('/editresp',[RelacaoController::class,'editaracaoresp'])->name('editarresp');
       

    });

    
});

/* Conjunto de rotas do responsável */
Route::prefix('/responsavel')->name('responsavel.')->group(function(){
    Route::middleware(['guest:responsavel','PreventBackHistory'])->group(function(){
        Route::post('/check',[ResponsavelController::class,'check'])->name('check');
        Route::view('/cantinasu','cantinahome')->name('cantinasu');
    });

    Route::middleware(['auth:responsavel','PreventBackHistory'])->group(function(){
        Route::get('/painel','App\Http\Controllers\RelacaoController@indexResp')->name('painel');
        Route::post('/cadastraraluno',[RelacaoController::class,'cadastrarAlu'])->name('cadastraraluno');
        Route::get('/delaluno/{id}',[RelacaoController::class,'excluirAluno'])->name('delaluno');
        Route::post('/sair',[ResponsavelController::class,'sair'])->name('sair');
        Route::get('/editalu/{id}',[RelacaoController::class,'editarAluno']);
        Route::put('/editalu',[RelacaoController::class,'editaracaoaluno'])->name('editaraluno');
        Route::get('/depositar/{id}',[RelacaoController::class,'depositar']);
        Route::post('/depositaluno',[RelacaoController::class,'depositaracao'])->name('deposito');
        Route::get('/testando/{id}',[RelacaoController::class,'testando']);
        Route::post('/bloquearpaluno',[RelacaoController::class,'bloquearpaluno'])->name('bloquearpaluno');
        Route::get('/exportar/{id}',[RelacaoController::class,'exportar'])->name("exportar");
    });

});

/* Conjunto de rotas do aluno */
Route::prefix('/aluno')->name('aluno.')->group(function(){
    Route::middleware(['guest:aluno','PreventBackHistory'])->group(function(){
        Route::post('/check',[AlunoController::class,'check'])->name('check');
        Route::view('/cantinasu','cantinahome')->name('cantinasu');
    });
    
    Route::middleware(['auth:aluno','PreventBackHistory'])->group(function(){
        Route::get('/painel','App\Http\Controllers\RelacaoController@indexAlu')->name('painel');
        Route::post('/sair',[AlunoController::class,'sair'])->name('sair');
        Route::get('/pegarproduto/{id}/{alunoId}',[RelacaoController::class,'carrinho']);
        Route::post('/colocarcarrinho',[RelacaoController::class,'colocar'])->name('colocar');

    });
});

/* Conjunto de rotas do administrador */
Route::group(['prefix'=>'admin','middleware'=>['isAdmin','auth','PreventBackHistory']], function(){
    Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::get('settings',[AdminController::class,'settings'])->name('admin.settings');
    Route::post('dashboard',[AdminController::class,'register'])->name('admin.register');
    
});

Route::middleware(['middleware'=>'PreventBackHistory'])->group(function(){
    Auth::routes();
});

/* Rota responsável por retornar a página inicial da cantina */
Route::get('/cantinasu', function(){
    return view('cantinahome');
});


/* Rota que recebe o nome da cantina na página inicial e vai para a página correspondente */
Route::post('cantinasu',[CantinaController::class,'inicio'])->name('cantinasu');


Route::get('/logout',[AdminController::class,'logout'])->name('logout');




Route::group(['prefix'=>'user','middleware'=>['isUser','auth','PreventBackHistory']], function(){
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::get('profile',[UserController::class,'profile'])->name('user.profile');
    Route::get('settings',[UserController::class,'settings'])->name('user.settings');
    
}); 

