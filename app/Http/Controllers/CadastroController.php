<?php
namespace App\Http\Controllers;
use App\Cadastro;
use Illuminate\Http\Request;
class CadastroController extends Controller
{
    public function index()
    {
        $pessoa = Cadastro::all();
        return response()->json($pessoa);
    }
    public function show($id)
    {
        $sec = new Seguranca();
        $pessoa = Cadastro::find($sec->verificaRequest($id,false,false));
        if(!$pessoa) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        return response()->json($pessoa);
    }

    public function store(Request $request)
    {
        $arrayReturn = $this->validaCadastro($request);

        if (!$arrayReturn['erro']) {
            $pessoa = new Cadastro();
            $data = $arrayReturn['data'];
            $pessoa->fill($data->all());
            $pessoa->save();
            return response()->json($pessoa, 201);
        }else{
            $arrayReturn['data'] = null;
            return response()->json($arrayReturn, 406);
        }
    }

    public function update(Request $request)
    {
        $arrayReturn = $this->validaCadastro($request);

        if (!$arrayReturn['erro']) {
            $data = $arrayReturn['data'];
            $pessoa = Cadastro::find($data['id']);
            if (!$pessoa) {
                return response()->json([
                    'message' => 'Record not found',
                ], 404);
            }
            $pessoa->fill($request->all());
            $pessoa->save();
            return response()->json($pessoa, 201);

        }else{
            $arrayReturn['data'] = null;
            return response()->json($arrayReturn, 406);
        }
    }

    public function destroy($id)
    {
        $sec = new Seguranca();
        $pessoa = Cadastro::find($sec->verificaRequest($id,false,false));
        if(!$pessoa) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        $pessoa->ativo = 'N';
        $pessoa->save();
        return response()->json(['message'   => 'Deletado com sucesso!',], 200);
    }

    public function validaCadastro(Request $request){
        $sec = new Seguranca();
        $arrayReturn = array('erro' => false, 'campos' => '', 'data' => '');

        if (($request['ativo'] != null || $request['ativo'] != '') && ($request['ativo'] == 'N' || $request['ativo'] == 'S')) {
            $request['ativo'] = $sec->verificaRequest($request['ativo'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'ativo|';
        }

        if (($request['razao_social'] != null || $request['razao_social'] != '')) {
            $request['razao_social'] = $sec->verificaRequest($request['razao_social'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'razao_social|';
        }

        if (($request['nome_fantasia'] != null || $request['nome_fantasia'] != '')) {
            $request['nome_fantasia'] = $sec->verificaRequest($request['nome_fantasia'], false, true);
        }

        if (($request['pessoa_f_j'] != null || $request['pessoa_f_j'] != '') && ($request['pessoa_f_j'] == 'N' || $request['pessoa_f_j'] == 'S')) {
            $request['pessoa_f_j'] = $sec->verificaRequest($request['pessoa_f_j'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'pessoa_f_j|';
        }

        if (($request['cpf_cnpj'] != null || $request['cpf_cnpj'] != '')) {
            $request['cpf_cnpj'] = $sec->verificaRequest($request['cpf_cnpj'], false, true);
        }

        if (($request['rg_ssp'] != null || $request['rg_ssp'] != '')) {
            $request['rg_ssp'] = $sec->verificaRequest($request['rg_ssp'], false, true);
        }

        if (($request['inscricao_estadual'] != null || $request['inscricao_estadual'] != '')) {
            $request['inscricao_estadual'] = $sec->verificaRequest($request['inscricao_estadual'], false, true);
        }

        if (($request['telefone_principal'] != null || $request['telefone_principal'] != '')) {
            $request['telefone_principal'] = $sec->verificaRequest($request['telefone_principal'], false, true);
        }

        if (($request['telefone_um'] != null || $request['telefone_um'] != '')) {
            $request['telefone_um'] = $sec->verificaRequest($request['telefone_um'], false, true);
        }

        if (($request['email_principal'] != null || $request['email_principal'] != '')) {
            $request['email_principal'] = $sec->verificaRequest($request['email_principal'], false, true);
        }

        if (($request['pessoa_contato'] != null || $request['pessoa_contato'] != '')) {
            $request['pessoa_contato'] = $sec->verificaRequest($request['pessoa_contato'], false, true);
        }

        if (($request['endereco'] != null || $request['endereco'] != '')) {
            $request['endereco'] = $sec->verificaRequest($request['endereco'], false, true);
        }

        if (($request['endereco_numero'] != null || $request['endereco_numero'] != '')) {
            $request['endereco_numero'] = $sec->verificaRequest($request['endereco_numero'], false, true);
        }

        if (($request['endereco_complemento'] != null || $request['endereco_complemento'] != '')) {
            $request['endereco_complemento'] = $sec->verificaRequest($request['endereco_complemento'], false, true);
        }

        if (($request['endereco_bairro'] != null || $request['endereco_bairro'] != '')) {
            $request['endereco_bairro'] = $sec->verificaRequest($request['endereco_bairro'], false, true);
        }

        if (($request['endereco_municipio_cod'] != null || $request['endereco_municipio_cod'] != '')) {
            $request['endereco_municipio_cod'] = $sec->verificaRequest($request['endereco_municipio_cod'], false, true);
        }

        if (($request['endereco_cep'] != null || $request['endereco_cep'] != '')) {
            $request['endereco_cep'] = $sec->verificaRequest($request['endereco_cep'], false, true);
        }

        if (($request['cadastro_usuario'] != null || $request['cadastro_usuario'] != '')) {
            $request['cadastro_usuario'] = $sec->verificaRequest($request['cadastro_usuario'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'cadastro_usuario|';
        }

        if (($request['cadastro_usuario_id'] != null || $request['cadastro_usuario_id'] != '')) {
            $request['cadastro_usuario_id'] = $sec->verificaRequest($request['cadastro_usuario_id'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'cadastro_usuario_id|';
        }

        if (($request['cadastro_data'] != null || $request['cadastro_data'] != '')) {
            $request['cadastro_data'] = $sec->verificaRequest($request['cadastro_data'], false, true);
        }else{
            $request['Empresa_data'] = date("Y-m-d H:i:s");
        }

        if (($request['licenca_software'] != null || $request['licenca_software'] != '')) {
            $request['licenca_software'] = $sec->verificaRequest($request['licenca_software'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'licenca_software|';
        }

        if (($request['cod_verificacao'] != null || $request['cod_verificacao'] != '')) {
            $request['cod_verificacao'] = $sec->verificaRequest($request['cod_verificacao'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'cod_verificacao|';
        }

        if (($request['observacao'] != null || $request['observacao'] != '')) {
            $request['observacao'] = $sec->verificaRequest($request['observacao'], false, true);
        }

        $arrayReturn['data'] = $request;
        return $arrayReturn;

    }
}
