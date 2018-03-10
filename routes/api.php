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

@session_start();
Route::group(array('prefix' => 'login'), function() {

    Route::get('/verifica_login', 'LoginController@index');
    Route::get('/faz_login', 'LoginController@store');
    Route::get('/faz_logoff', 'LoginController@destroy');
});

if (isset($_SESSION['conexao'])){
    Route::group(array('prefix' => 'empresa'), function() {

        Route::get('/all', 'EmpresaController@index');
        Route::get('/id/{id}', 'EmpresaController@show');
        Route::get('/new', 'EmpresaController@store');
        Route::get('/edit', 'EmpresaController@update');
        Route::get('/delete/{id}', 'EmpresaController@destroy');
    });

    Route::group(array('prefix' => 'cadastro'), function() {

        Route::get('/all', 'CadastroController@index');
        Route::get('/id/{id}', 'CadastroController@show');
        Route::get('/new', 'CadastroController@store');
        Route::get('/edit', 'CadastroController@update');
        Route::get('/delete/{id}', 'CadastroController@destroy');
    });

     Route::group(array('prefix' => 'liberacao'), function() {

         Route::get('/all', 'GrupoLiberacaoController@index');
         Route::get('/id/{id}', 'GrupoLiberacaoController@show');
         Route::get('/new', 'GrupoLiberacaoController@store');
         Route::get('/edit', 'GrupoLiberacaoController@update');
         Route::get('/delete/{id}', 'GrupoLiberacaoController@destroy');
     });
 
   Route::group(array('prefix' => 'usuario'), function() {
        Route::get('/all', 'UsuarioController@index');
        Route::get('/id/{id}', 'UsuarioController@show');
        Route::get('/new', 'UsuarioController@store');
        Route::get('/edit', 'UsuarioController@update');
        Route::get('/delete/{id}', 'UsuarioController@destroy');
    });
}

