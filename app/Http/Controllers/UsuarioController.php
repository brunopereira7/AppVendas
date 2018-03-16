<?php

namespace App\Http\Controllers;

use App\GrupoLiberacao;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuario = Usuario::all();
        return response()->json($usuario);
    }
    public function show($id)
    {
        $sec = new Seguranca();
        
        $usuario = DB::table('tbl_usuario')
            ->where('tbl_usuario.id', $sec->verificaRequest($id,false,false))
            ->join('tbl_grupo_liberacao', 'tbl_usuario.grupo_liberacao_id', '=', 'tbl_grupo_liberacao.id')
            ->first();

        if(!$usuario) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        return response()->json($usuario);
    }

    public function store(Request $request)
    {
        $arrayReturn = $this->validaUsuario($request);

        if (!$arrayReturn['erro']) {
            $data = $arrayReturn['data'];

            $usuario = new Usuario();
            $sec = new Seguranca();

            $liberacao = new GrupoLiberacaoController();

            $liberacao_return = $liberacao->store($request);



            if($liberacao_return['erro'] == false){
                $data['cadastro_usuario_id'] = $sec->descriptPadrao($_SESSION['conexao']['id']);

                $usuario->fill($data->all());
                $usuario->save();

                $liberacao = $liberacao_return['liberacao'];

                return response()->json(['usuario'=>$usuario,'liberacao'=>$liberacao], 201);
            }else{
                $arrayReturn['data'] = null;
//                $liberacao = (array) $liberacao;
                return response()->json([$arrayReturn,$liberacao], 406);
            }

        }else{
            $arrayReturn['data'] = null;
            return response()->json($arrayReturn, 406);
        }

    }

    public function update(Request $request)
    {
        $arrayReturn = $this->validaCadastro($request);

        if (!$arrayReturn['erro']){
            $sec = new Seguranca();

            $data = $arrayReturn['data'];
            $usuario = Usuario::find($sec->verificaRequest($data['id'],false,false));

            if(!$usuario) {
                return response()->json([
                    'message'   => 'Record not found = '.$request['id'],
                ], 404);
            }
            if ($request['senha'] == '********') {
                $request['senha'] = $usuario->senha;
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

    public function validaUsuario(Request $request){
        $sec = new Seguranca();

        $arrayReturn = array('erro' => false, 'campos' => '', 'data' => '');

        if ($request['ativo'] ='S' || $request['ativo'] != 'N') {
            $request['ativo'] = $sec->verificaRequest($request['ativo'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'ativo|';
        }
        
        if (strpos($request['senha'], ' ')==0 && $request['senha'] != '********'){
            $request['senha'] = $sec->verificaRequest($request['senha'],true,false);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'senha|';
        }
        
        if (strpos($request['login'], ' ')==0){
            $request['login'] = $sec->verificaRequest($request['login'],true,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'login|';
        }

        $request['cadastro_id'] = $sec->soNumero($request['cadastro_id']);
        $request['grupo_liberacao_id'] = $sec->soNumero($request['grupo_liberacao_id']);


        $arrayReturn['data'] = $request;
        return $arrayReturn;
    }
}
