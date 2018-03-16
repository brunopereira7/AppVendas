<?php

namespace App\Http\Controllers;

use App\GrupoLiberacao;
use Illuminate\Http\Request;

class GrupoLiberacaoController extends Controller
{
    public function index()
    {
        $liberacao = GrupoLiberacao::all();
        return response()->json($liberacao);
    }
    public function show($id)
    {
        $sec = new Seguranca();
        $liberacao = GrupoLiberacao::find($sec->verificaRequest($id,false,false));
        if(!$liberacao) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        return response()->json($liberacao);
    }

    public function store(Request $request)
    {
        $arrayReturn = $this->validaLiberacao($request,false);

        if (!$arrayReturn['erro']) {
            $liberacao = new GrupoLiberacao();

            $data = $arrayReturn['data'];

            $liberacao->fill($data->all());
            $liberacao->save();

            return response()->json(['liberacao'=>$liberacao,'erro'=>false], 201);
        }else{
            $arrayReturn['data'] = null;
            return response()->json($arrayReturn, 406);
        }
    }

    public function update(Request $request)
    {
        $arrayReturn = $this->validaLiberacao($request,false);

        if (!$arrayReturn['erro']) {
            $data = $arrayReturn['data'];
            $liberacao = GrupoLiberacao::find($data['id']);

            if (!$liberacao) {
                return response()->json([
                    'message' => 'Record not found',
                ], 404);
            }

            $liberacao->fill($data->all());
            $liberacao->save();
            return response()->json($liberacao, 201);

        }else{
            $arrayReturn['data'] = null;
            return response()->json($arrayReturn, 406);
        }
    }

//    public function destroy($id)
//    {
//        $sec = new Seguranca();
//        $liberacao = GrupoLiberacao::find($sec->verificaRequest($id,false,false));
//
//        if(!$liberacao) {
//            return response()->json([
//                'message'   => 'Record not found',
//            ], 404);
//        }
//        $liberacao->ativo = 'N';
//        $liberacao->save();
//        return response()->json(['message'   => 'Deletado com sucesso!',], 200);
//    }

    public function validaLiberacao(Request $request){
        $sec = new Seguranca();
        $arrayReturn = array('erro' => false, 'campos' => '', 'data' => '');

        foreach ($request as $chave_do_indice => &$valor){
            $campos_numericos = array('id_empresa');
            $campos_textos = array('acesso_descricao');
            $nao_validar = array('attributes','request','query','server','files','cookies','headers');

            if (!in_array($chave_do_indice, $nao_validar)){
                if (!in_array($chave_do_indice, $campos_numericos) && !in_array($chave_do_indice, $campos_textos)){
                    if ($sec->valida_s_n($valor))
                        $valor = $sec->verificaRequest($valor,false,true);
                    else{
                        $arrayReturn['erro'] = true;
                        $arrayReturn['campos'] .= $chave_do_indice.'|';
                    }
                }else{
                    if (in_array($chave_do_indice,$campos_numericos)){
                        if(!$sec->ehNulo($valor)){
                            $valor = $sec->soNumero($valor);
                        }else{
                            $arrayReturn['erro'] = true;
                            $arrayReturn['campos'] .= $chave_do_indice.'|';
                        }
                    }elseif (in_array($chave_do_indice,$campos_numericos)){
                        if(!$sec->ehNulo($valor)){
                            $valor = $sec->verificaRequest($valor,false,true);
                        }else{
                            $arrayReturn['erro'] = true;
                            $arrayReturn['campos'] .= $chave_do_indice.'|';
                        }
                    }
                }
            }

        }

        $arrayReturn['data'] = $request;
        return $arrayReturn;

    }
}
