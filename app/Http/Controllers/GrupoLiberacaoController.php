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

            return response()->json($liberacao, 201);
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

    public function validaLiberacao(Request $request, $vemDeUsuario){
        $sec = new Seguranca();
        $arrayReturn = array('erro' => false, 'campos' => '', 'data' => '');
        if (!$vemDeUsuario)
            $request_data = $request;
        if(!$sec->ehNulo($request['id_empresa'])){
            $request_data['id_empresa'] = $sec->soNumero($request['id_empresa']);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'id_empresa|';
        }
        if(!$sec->ehNulo($request['acesso_descricao'])){
            $request_data['acesso_descricao'] = $sec->verificaRequest($request['acesso_descricao'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'acesso_descricao|';
        }
        if($sec->valida_s_n($request['acesso_adm'])){
            $request_data['acesso_adm'] = $sec->verificaRequest($request['acesso_adm'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'acesso_adm|';
        }
        if($sec->valida_s_n($request['libera_cadastrar_pessoa'])){
            $request_data['libera_cadastrar_pessoa'] = $sec->verificaRequest($request['libera_cadastrar_pessoa'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'libera_cadastrar_pessoa|';
        }
        if($sec->valida_s_n($request['libera_editar_pessoa'])){
            $request_data['libera_editar_pessoa'] = $sec->verificaRequest($request['libera_editar_pessoa'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'libera_editar_pessoa|';
        }
        if($sec->valida_s_n($request['libera_deletar_pessoa'])){
            $request_data['libera_deletar_pessoa'] = $sec->verificaRequest($request['libera_deletar_pessoa'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'libera_deletar_pessoa|';
        }
        if($sec->valida_s_n($request['libera_visualizar_pessoa'])){
            $request_data['libera_visualizar_pessoa'] = $sec->verificaRequest($request['libera_visualizar_pessoa'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'libera_visualizar_pessoa|';
        }
        if($sec->valida_s_n($request['libera_venda_balcao'])){
            $request_data['libera_venda_balcao'] = $sec->verificaRequest($request['libera_venda_balcao'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'libera_venda_balcao|';
        }
        if($sec->valida_s_n($request['libera_venda_pedido'])){
            $request_data['libera_venda_pedido'] = $sec->verificaRequest($request['libera_venda_pedido'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'libera_venda_pedido|';
        }
        if($sec->valida_s_n($request['libera_venda_comanda'])){
            $request_data['libera_venda_comanda'] = $sec->verificaRequest($request['libera_venda_comanda'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'libera_venda_comanda|';
        }
        if($sec->valida_s_n($request['libera_venda_desconto'])){
            $request_data['libera_venda_desconto'] = $sec->verificaRequest($request['libera_venda_desconto'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'libera_venda_desconto|';
        }
        if($sec->valida_s_n($request['libera_venda_desconto_acima_teto'])){
            $request_data['libera_venda_desconto_acima_teto'] = $sec->verificaRequest($request['libera_venda_desconto_acima_teto'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'libera_venda_desconto_acima_teto|';
        }
        if($sec->valida_s_n($request['visualiza_venda_propia'])){
            $request_data['visualiza_venda_propia'] = $sec->verificaRequest($request['visualiza_venda_propia'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'visualiza_venda_propia|';
        }
        if($sec->valida_s_n($request['libera_venda_edita'])){
            $request_data['libera_venda_edita'] = $sec->verificaRequest($request['libera_venda_edita'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'libera_venda_edita|';
        }
        if($sec->valida_s_n($request['libera_venda_cancela'])){
            $request_data['libera_venda_cancela'] = $sec->verificaRequest($request['libera_venda_cancela'],false,true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'libera_venda_cancela|';
        }

        $arrayReturn['data'] = $request_data;
        return $arrayReturn;

    }
}
