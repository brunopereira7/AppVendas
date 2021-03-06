<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        @session_start();
        //verifica se estou logado buscando dados da tabela de log de login

        if (isset($_SESSION['conexao'])){
            return response()->json(['conexao'=>$_SESSION['conexao'], 'conectado'=>true], 200);
        }else{
            return response()->json(['mensagem'=> 'Nenhum usuário localizado online nesse navegador.', 'conectado'=>false], 404);
        }
    }
    public function store(Request $request)
    {
        $cript = new Seguranca();

        //captura dados p/ login;
        $request['login'] = $cript->verificaRequest($request['login'],true,true);//previne sql injection e espaços
        $request['senha'] = $cript->verificaRequest($request['senha'],true,false);//previne sql injection e espaços

        //verifica se existe usuario p/ o conjunto de dados informado;
        $usuario = DB::table('tbl_usuario')
            ->where('login', $request['login'])
            ->where('senha', $request['senha'])
            ->join('tbl_grupo_liberacao', 'tbl_usuario.grupo_liberacao_id', '=', 'tbl_grupo_liberacao.id')
            ->first();

        if ($usuario){
            //cria histórico de login
            $arrayReturn = array(
                'result' => $cript->criptPadrao($usuario->id),
                'status' => 200
            );
            @session_start();
            $usuario->id = $cript->criptPadrao($usuario->id);
            $usuario->cadastro_id = $cript->criptPadrao($usuario->cadastro_id);
            $usuario->grupo_liberacao_id = $cript->criptPadrao($usuario->grupo_liberacao_id);
            $_SESSION['conexao'] = (array) $usuario;
            return response()->json($arrayReturn,$arrayReturn['status']);

        }
        else{
            @session_start();
            @session_unset();
            @session_destroy();
            $arrayReturn = array(
                'mensagem' => 'Informe corretamente o Login e Senha.',
                'result' => true,
                'status' => 404
            );
            return response()->json($arrayReturn,$arrayReturn['status']);
        }

    }
    public function destroy()
    {
        @session_start();
        //verifica se estou logado buscando dados da tabela de log de login
        if (isset($_SESSION['conexao'])){
            @session_destroy();
            return response()->json(['mensagem' => 'Logoff realizado com sucesso.'], 200);
        }else{
            @session_destroy();
            return response()->json(['mensagem' => 'Usuário de login não encontrado.'], 404);
        }
    }
}
