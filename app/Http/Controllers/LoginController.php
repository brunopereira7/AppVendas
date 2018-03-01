<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        @session_start();
        //verifica se estou logado buscando dados da tabela de log de login
        if (isset($_SESSION['login'])){
            $logLogin = new LogLoginController();
            return $logLogin->show($_SESSION['login']);//retorna todos os dados do login atual (caso tenha feito login);
        }else{
            return response()->json(null, 404);
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
            ->first();

        if ($usuario){
            //cria histórico de login
            $arrayReturn = array(
                'result' => criptPadrao($usuario->id),
                'status' => 200
            );
            @session_start();
            $_SESSION['login'] = $arrayReturn['result'];
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
        if (isset($_SESSION['login'])){
            $logLogin = new LogLoginController();
            return $logLogin->destroy($_SESSION['login']);//retorna todos os dados do login atual (caso tenha feito login);
        }else{
            return response()->json(null, 404);
        }
    }
}
