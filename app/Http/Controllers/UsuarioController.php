<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuario = Usuario::all();
        return response()->json($usuario);
    }
    public function show($id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        return response()->json($usuario);
    }

    public function create(Request $request)
    {
        if ($request['senha'] == $request['senha_confirma'] && strpos($request['senha'], ' ')==0){
            $usuario = new Usuario();
            $cript = new Seguranca();
            $request['login'] = $cript->verificaRequest($request['login'],true,true);//previne sql injection e espaços
            $request['senha'] = $cript->verificaRequest($request['senha'],true,false);//previne sql injection e espaços
            $usuario->fill($request->all());
            $usuario->save();

            return response()->json($usuario, 201);
        }
        else{
            $arrayReturn = array(
              'mensagem' => 'Informe os dados do usuário corretamente.'
            );
            return response()->json($arrayReturn, 406);
        }

    }

    public function update(Request $request)
    {

        if ($request['senha'] == $request['senha_confirma'] && strpos($request['senha'], ' ')==0){
            $usuario = Usuario::find($request['id']);

            if(!$usuario) {
                return response()->json([
                    'message'   => 'Record not found = '.$request['id'],
                ], 404);
            }

            $usuario->fill($request->all());
            $usuario->save();

            return response()->json($usuario,200);
        }
        else{
            $arrayReturn = array(
                'mensagem' => 'Informe os dados do usuário corretamente.'
            );
            return response()->json($arrayReturn, 406);
        }
    }

}
