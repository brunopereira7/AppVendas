<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('/', function () {
    return response()->json(['message' => 'AppVendas API', 'status' => 'Connected']);;
});

Route::resource('login', 'LoginController');
@session_start();
$_SESSION['login'] = 0;
if (isset($_SESSION['login'])){
    Route::group(array('prefix' => 'empresa'), function() {

        Route::get('/all', 'EmpresaController@index');
        Route::get('/id', 'EmpresaController@show');
        Route::post('/new', 'EmpresaController@store');
        Route::post('/edit', 'EmpresaController@update');
        Route::get('/delete', 'EmpresaController@delete');
    });

    Route::group(array('prefix' => 'cadastro'), function() {

        Route::get('/all', 'CadastroController@index');
        Route::get('/id/{id}', 'CadastroController@show');
        Route::get('/new', 'CadastroController@store');
        Route::post('/edit', 'CadastroController@update');
        Route::get('/delete', 'CadastroController@delete');
    });

    Route::group(array('prefix' => 'grupo-liberacao'), function() {

        Route::get('/all', 'GrupoLiberacaoController@index');
        Route::get('/id', 'GrupoLiberacaoController@show');
        Route::post('/new', 'GrupoLiberacaoController@store');
        Route::post('/edit', 'GrupoLiberacaoController@update');
        Route::get('/delete', 'GrupoLiberacaoController@delete');
    });

//    Route::group(array('prefix' => 'usuario'), function() {
//
//        Route::get('/all', 'UsuarioController@index');
//        Route::get('/id', 'UsuarioController@show');
//        Route::post('/new', 'UsuarioController@store');
//        Route::post('/edit', 'UsuarioController@update');
//        Route::get('/delete', 'UsuarioController@delete');
//    });
}

