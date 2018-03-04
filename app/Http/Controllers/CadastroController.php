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


        if ($request['id_empresa'] != null && $request['id_empresa'] != ''){
            $request['id_empresa'] = $sec->verificaRequest($request['id_empresa'], false, false);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'id_empresa|';
        }

        if (($request['ativo'] != null && $request['ativo'] != '') && ($request['ativo'] == 'N' || $request['ativo'] == 'S')) {
            $request['ativo'] = $sec->verificaRequest($request['ativo'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'ativo|';
        }

        if ($request['nome_completo'] != null && $request['nome_completo'] != ''){
            $request['nome_completo'] = $sec->verificaRequest($request['nome_completo'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'nome_completo|';
        }

        if (($request['pessoa_f_j'] != null && $request['pessoa_f_j'] != '') && ($request['pessoa_f_j'] == 'F' || $request['pessoa_f_j'] == 'J ')) {
            $request['pessoa_f_j'] = $sec->verificaRequest($request['pessoa_f_j'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'pessoa_f_j|';
        }

        if (($request['listar_para_usuarios'] != null && $request['listar_para_usuarios'] != '') && ($request['listar_para_usuarios'] == 'S' || $request['listar_para_usuarios'] == 'N ')) {
            $request['listar_para_usuarios'] = $sec->verificaRequest($request['listar_para_usuarios'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'listar_para_usuarios|';
        }

        if (($request['eh_usuarios'] != null && $request['eh_usuarios'] != '') && ($request['eh_usuarios'] == 'S' || $request['eh_usuarios'] == 'N ')) {
            $request['eh_usuarios'] = $sec->verificaRequest($request['eh_usuarios'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'eh_usuarios|';
        }

        if (($request['eh_cliente'] != null && $request['eh_cliente'] != '') && ($request['eh_cliente'] == 'S' || $request['eh_cliente'] == 'N ')) {
            $request['eh_cliente'] = $sec->verificaRequest($request['eh_cliente'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'eh_cliente|';
        }

        if (($request['eh_fornecedor'] != null && $request['eh_fornecedor'] != '') && ($request['eh_fornecedor'] == 'S' || $request['eh_fornecedor'] == 'N ')) {
            $request['eh_fornecedor'] = $sec->verificaRequest($request['eh_fornecedor'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'eh_fornecedor|';
        }

        if ($request['cadastro_data'] != null && $request['cadastro_data'] != '') {
            $request['cadastro_data'] = $sec->verificaRequest($request['cadastro_data'], false, false);
        }else{
            $request['cadastro_data'] = date("Y-m-d H:i:s");
        }

        $request['cadastro_usuario'] = $_SESSION['conexao']['login'];
        $request['cadastro_usuario_id'] = $sec->descriptPadrao($_SESSION['conexao']['id']);

        $request['cpf_cnpj'] = $sec->verificaRequest($request['cpf_cnpj'], false, false);
        $request['cpf_cnpj'] = $sec->soNumero($request['cpf_cnpj']);

        $request['nome_fantasia'] = $sec->verificaRequest($request['nome_fantasia'], false, true);
        $request['rg_ssp'] = $sec->verificaRequest($request['rg_ssp'], false, false);
        $request['inscricao_estadual'] = $sec->verificaRequest($request['inscricao_estadual'], false, true);
        $request['data_nascimento'] = $sec->verificaRequest($request['data_nascimento'], false, false);

        $request['telefone_principal'] = $sec->verificaRequest($request['telefone_principal'], false, false);
        $request['telefone_principal'] = $sec->soNumero($request['telefone_principal']);

        $request['telefone_um'] = $sec->verificaRequest($request['telefone_um'], false, false);
        $request['telefone_um'] = $sec->soNumero($request['telefone_um']);

        $request['email_principal'] = $sec->verificaRequest($request['email_principal'], false, true);
        $request['pessoa_contato'] = $sec->verificaRequest($request['pessoa_contato'], false, true);
        $request['endereco'] = $sec->verificaRequest($request['endereco'], false, true);
        $request['endereco_numero'] = $sec->verificaRequest($request['endereco_numero'], false, true);
        $request['endereco_complemento'] = $sec->verificaRequest($request['endereco_complemento'], false, true);
        $request['endereco_bairro'] = $sec->verificaRequest($request['endereco_bairro'], false, true);
        $request['endereco_municipio_cod'] = $sec->verificaRequest($request['endereco_municipio_cod'], false, false);
        $request['observacao'] = $sec->verificaRequest($request['observacao'], false, true);

        $request['endereco_cep'] = $sec->verificaRequest($request['endereco_cep'], false, false);
        $request['endereco_cep'] = $sec->soNumero($request['endereco_cep']);





        $arrayReturn['data'] = $request;
        return $arrayReturn;

    }
}
