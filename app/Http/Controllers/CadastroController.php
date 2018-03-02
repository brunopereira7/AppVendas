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
        $pessoa = Cadastro::find($id);
        if(!$pessoa) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        return response()->json($pessoa);
    }

    public function store(Request $request)
    {
        $pessoa = new Cadastro();
        $returnRequest = $this->validaCadastro($request);
        $pessoa->fill($returnRequest->all());
        $pessoa->save();
        return response()->json($pessoa, 201);
    }

    public function update(Request $request, $id)
    {
        $pessoa = Cadastro::find($id);
        if(!$pessoa) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        $pessoa->fill($request->all());
        $pessoa->save();
        return response()->json($pessoa);
    }

    public function destroy($id)
    {
        $pessoa = Cadastro::find($id);
        if(!$pessoa) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        $pessoa->delete();
        return response()->json(['message'   => 'Deletado com sucesso!',], 200);
    }

    public function validaCadastro(Request $request){
        $sec = new Seguranca();
        $gerouErro = false;
        $arrayErro = '';
        if ($request['id_empresa'] != null || $request['id_empresa'] != ''){
            $request['id_empresa'] = $sec->verificaRequest($request['id_empresa'], false, false);
        }else{
            $gerouErro = true;
            $arrayErro = array('id_empresa');
        }

        if (($request['ativo'] != null || $request['ativo'] != '') && ($request['ativo'] != 'N' || $request['ativo'] != 'S')) {
            $request['ativo'] = $sec->verificaRequest($request['ativo'], false, true);
        }else{
            $gerouErro = true;
            $arrayErro = array('ativo');
        }

        if ($request['nome_completo'] != null || $request['nome_completo'] != '') {
            $request['nome_completo'] = $sec->verificaRequest($request['nome_completo'], false, true);
        }else{
            $gerouErro = true;
            $arrayErro = array('nome_completo');
        }

        if ($request['nome_fantasia'] != null || $request['nome_fantasia'] != '') {
            $request['nome_fantasia'] = $sec->verificaRequest($request['nome_fantasia'], false, true);
        }

        if ($request['pessoa_f_j'] != null || $request['pessoa_f_j'] != '') {
            $request['pessoa_f_j'] = $sec->verificaRequest($request['pessoa_f_j'], false, true);
        }else{
            $gerouErro = true;
            $arrayErro = array('pessoa_f_j');
        }

        if ($request['cpf_cnpj'] != null || $request['cpf_cnpj'] != '') {
            $request['cpf_cnpj'] = $sec->verificaRequest($request['cpf_cnpj'], false, false);
        }
        if ($request['rg_ssp'] != null || $request['rg_ssp'] != '') {
            $request['rg_ssp'] = $sec->verificaRequest($request['rg_ssp'], false, true);
        }

        if ($request['inscricao_estadual'] != null || $request['inscricao_estadual'] != '') {
            $request['inscricao_estadual'] = $sec->verificaRequest($request['inscricao_estadual'], false, false);
        }

        if ($request['data_nascimento'] != null || $request['data_nascimento'] != '') {
            $request['data_nascimento'] = $sec->verificaRequest($request['data_nascimento'], false, false);
        }

        if ($request['telefone_principal'] != null || $request['telefone_principal'] != '') {
            $request['telefone_principal'] = $sec->verificaRequest($request['telefone_principal'], false, false);
        }

        if ($request['telefone_um'] != null || $request['telefone_um'] != '') {
            $request['telefone_um'] = $sec->verificaRequest($request['telefone_um'], false, false);
        }

        if ($request['email_principal'] != null || $request['email_principal'] != '') {
            $request['email_principal'] = $sec->verificaRequest($request['email_principal'], false, false);
        }

        if ($request['pessoa_contato'] != null || $request['pessoa_contato'] != '') {
            $request['pessoa_contato'] = $sec->verificaRequest($request['pessoa_contato'], false, true);
        }

        if ($request['endereco'] != null || $request['endereco'] != '') {
            $request['endereco'] = $sec->verificaRequest($request['endereco'], false, true);
        }

        if ($request['endereco_numero'] != null || $request['endereco_numero'] != '') {
            $request['endereco_numero'] = $sec->verificaRequest($request['endereco_numero'], false, true);
        }

        if ($request['endereco_complemento'] != null || $request['endereco_complemento'] != '') {
            $request['endereco_complemento'] = $sec->verificaRequest($request['endereco_complemento'], false, true);
        }

        if ($request['endereco_bairro'] != null || $request['endereco_bairro'] != '') {
            $request['endereco_bairro'] = $sec->verificaRequest($request['endereco_bairro'], false, true);
        }

        if ($request['endereco_municipio_cod'] != null || $request['endereco_municipio_cod'] != '') {
            $request['endereco_municipio_cod'] = $sec->verificaRequest($request['endereco_municipio_cod'], false, false);
        }

        if ($request['endereco_cep'] != null || $request['endereco_cep'] != '') {
            $request['endereco_cep'] = $sec->verificaRequest($request['endereco_cep'], false, true);
        }
        if ($request['listar_para_usuarios'] != null || $request['listar_para_usuarios'] != '') {
            $request['listar_para_usuarios'] = $sec->verificaRequest($request['listar_para_usuarios'], false, true);
        }
        if ($request['eh_usuarios'] != null || $request['eh_usuarios'] != '') {
            $request['eh_usuarios'] = $sec->verificaRequest($request['eh_usuarios'], false, true);
        }

        if ($request['eh_cliente'] != null || $request['eh_cliente'] != ''){
            $request['eh_cliente'] = $sec->verificaRequest($request['eh_cliente'], false, true);
        }
        if ($request['eh_fornecedor'] != null || $request['eh_fornecedor'] != ''){
            $request['eh_fornecedor'] = $sec->verificaRequest($request['eh_fornecedor'], false, true);
        }

        if ($request['cadastro_data'] != null || $request['cadastro_data'] != ''){
            $request['cadastro_data'] = $sec->verificaRequest($request['cadastro_data'], false, true);
        }

        if ($request['cadastro_usuario'] != null || $request['cadastro_usuario'] != ''){
            $request['cadastro_usuario'] = $sec->verificaRequest($request['cadastro_usuario'], false, true);
        }

        if ($request['cadastro_usuario_id'] != null || $request['cadastro_usuario_id'] != ''){
            $request['cadastro_usuario_id'] = $sec->verificaRequest($request['cadastro_usuario_id'], false, true);
        }

        if ($request['observacao'] != null || $request['observacao'] != ''){
            $request['observacao'] = $sec->verificaRequest($request['observacao'], false, true);
        }
    }
}
