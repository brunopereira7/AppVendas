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

Route::group(array('prefix' => 'app'), function()
{

    Route::get('/', function () {
        return response()->json(['message' => 'AppVendas API', 'status' => 'Connected']);;
    });

    Route::resource('login', 'LoginController');
    @session_start();
//    if (isset($_SESSION['login'])){
        Route::resource('empresa', 'EmpresaController');
        Route::resource('cadastro', 'CadastroController');
        Route::resource('grupo-liberacao', 'GrupoLiberacaoController');
        Route::resource('usuario', 'UsuarioController');
//    }
});

Route::get('/', function () {
    return redirect('api/app');
});
