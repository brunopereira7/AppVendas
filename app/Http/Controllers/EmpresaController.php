<?php
namespace App\Http\Controllers;
use App\Empresa;
use Illuminate\Http\Request;
class EmpresaController extends Controller
{
    public function index()
    {
        $empresa = Empresa::all();
        return response()->json($empresa);
    }
    public function show($id)
    {
        $sec = new Seguranca();
        $empresa = Empresa::find($sec->verificaRequest($id,false,false));
        if(!$empresa) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        return response()->json($empresa);
    }

    public function store(Request $request)
    {
        $arrayReturn = $this->validaEmpresa($request);

        if (!$arrayReturn['erro']) {
            $empresa = new Empresa();
            $data = $arrayReturn['data'];
            $empresa->fill($data->all());
            $empresa->save();
            return response()->json($empresa, 201);
        }else{
            $arrayReturn['data'] = null;
            return response()->json($arrayReturn, 406);
        }
    }

    public function update(Request $request)
    {
        $arrayReturn = $this->validaEmpresa($request);

        if (!$arrayReturn['erro']) {
            $data = $arrayReturn['data'];
            $empresa = Empresa::find($data['id']);
            if (!$empresa) {
                return response()->json([
                    'message' => 'Record not found',
                ], 404);
            }
            $empresa->fill($request->all());
            $empresa->save();
            return response()->json($empresa, 201);

        }else{
            $arrayReturn['data'] = null;
            return response()->json($arrayReturn, 406);
        }
    }

    public function destroy($id)
    {
        $sec = new Seguranca();
        $empresa = Empresa::find($sec->verificaRequest($id,false,false));

        if(!$empresa) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }
        $empresa->ativo = 'N';
        $empresa->save();
        return response()->json(['message'   => 'Deletado com sucesso!',], 200);
    }

    public function validaEmpresa(Request $request){
        $sec = new Seguranca();
        $arrayReturn = array('erro' => false, 'campos' => '', 'data' => '');


        if (($request['ativo'] != null || $request['ativo'] != '') && ($request['ativo'] == 'N' || $request['ativo'] == 'S')) {
            $request['ativo'] = $sec->verificaRequest($request['ativo'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'ativo|';
        }

        if ($request['nome_completo'] != null || $request['nome_completo'] != '') {
            $request['nome_completo'] = $sec->verificaRequest($request['nome_completo'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'nome_completo|';
        }

        if ($request['nome_fantasia'] != null || $request['nome_fantasia'] != '') {
            $request['nome_fantasia'] = $sec->verificaRequest($request['nome_fantasia'], false, true);
        }

        if (($request['pessoa_f_j'] != null || $request['pessoa_f_j'] != '') && ($request['pessoa_f_j'] == 'F' || $request['pessoa_f_j'] == 'J')) {
            $request['pessoa_f_j'] = $sec->verificaRequest($request['pessoa_f_j'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'pessoa_f_j|';
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

        if (($request['listar_para_usuarios'] != null || $request['listar_para_usuarios'] != '') && ($request['listar_para_usuarios'] != 'N' || $request['listar_para_usuarios'] != 'S')) {
            $request['listar_para_usuarios'] = $sec->verificaRequest($request['listar_para_usuarios'], false, true);
        }else{
            $request['listar_para_usuarios'] = 'S';
        }

        if (($request['eh_usuarios'] != null || $request['eh_usuarios'] != '') && ($request['eh_usuarios'] != 'N' || $request['eh_usuarios'] != 'S')) {
            $request['eh_usuarios'] = $sec->verificaRequest($request['eh_usuarios'], false, true);
        }else{
            $request['eh_usuarios'] = 'N';
        }

        if (($request['eh_cliente'] != null || $request['eh_cliente'] != '') && ($request['eh_cliente'] != 'N' || $request['eh_cliente'] != 'S')) {
            $request['eh_cliente'] = $sec->verificaRequest($request['eh_cliente'], false, true);
        }else{
            $request['eh_cliente'] = 'N';
        }

        if (($request['eh_fornecedor'] != null || $request['eh_fornecedor'] != '') && ($request['eh_fornecedor'] != 'N' || $request['eh_fornecedor'] != 'S')) {
            $request['eh_fornecedor'] = $sec->verificaRequest($request['eh_fornecedor'], false, true);
        }else{
            $request['eh_fornecedor'] = 'N';
        }

        if ($request['Empresa_data'] != null || $request['Empresa_data'] != ''){
            $request['Empresa_data'] = $sec->verificaRequest($request['Empresa_data'], false, true);
        }else{
            $request['Empresa_data'] = date("Y-m-d H:i:s");
        }

        if ($request['Empresa_usuario'] != null || $request['Empresa_usuario'] != ''){
            $request['Empresa_usuario'] = $sec->verificaRequest($request['Empresa_usuario'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'Empresa_usuario|';
        }

        if ($request['Empresa_usuario_id'] != null || $request['Empresa_usuario_id'] != ''){
            $request['Empresa_usuario_id'] = $sec->verificaRequest($request['Empresa_usuario_id'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'Empresa_usuario_id|';
        }

        if ($request['observacao'] != null || $request['observacao'] != ''){
            $request['observacao'] = $sec->verificaRequest($request['observacao'], false, true);
        }
        $arrayReturn['data'] = $request;
        return $arrayReturn;

    }
}
