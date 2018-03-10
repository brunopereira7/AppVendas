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
            $sec = new Seguranca();

            $data = $arrayReturn['data'];
            $data['cadastro_usuario_id'] = $sec->descriptPadrao($_SESSION['conexao']['id']);
            $data['licenca_software'] = $sec->verificaRequest($request['licenca_software'], false, false);
            $data['cod_verificacao'] = $sec->verificaRequest($request['cod_verificacao'], false, false);

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
            
            $data['cadastro_usuario_id'] = $empresa->cadastro_usuario_id;
            $data['licenca_software'] = $empresa->licenca_software;
            $data['cod_verificacao'] = $empresa->cod_verificacao;
            
            $empresa->fill($data->all());
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

//    public function atualizaLicenca(Request $request){
//
//        $sec = new Seguranca();
//
//        $data['licenca_software'] = $sec->verificaRequest($request['licenca_software'], false, false);
//        $data['id'] = $sec->verificaRequest($request['id'], false, false);
//
//
//        if (!$arrayReturn['erro']) {
//            $data = $arrayReturn['data'];
//            $empresa = Empresa::find($data['id']);
//
//            if (!$empresa) {
//                return response()->json([
//                    'message' => 'Record not found',
//                ], 404);
//            }
//            $empresa->fill($request->all());
//            $empresa->save();
//            return response()->json($empresa, 201);
//
//        }else{
//            $arrayReturn['data'] = null;
//            return response()->json($arrayReturn, 406);
//        }
//
//    }

    public function validaEmpresa(Request $request){
        $sec = new Seguranca();
        $arrayReturn = array('erro' => false, 'campos' => '', 'data' => '');

        if (($request['ativo'] != null || $request['ativo'] != '') && ($request['ativo'] == 'N' || $request['ativo'] == 'S')) {
            $request['ativo'] = $sec->verificaRequest($request['ativo'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'ativo|';
        }

        if ($request['razao_social'] != null || $request['razao_social'] != '') {
            $request['razao_social'] = $sec->verificaRequest($request['razao_social'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'razao_social|';
        }

        if (($request['pessoa_f_j'] != null || $request['pessoa_f_j'] != '') && ($request['pessoa_f_j'] == 'F' || $request['pessoa_f_j'] == 'J')) {
            $request['pessoa_f_j'] = $sec->verificaRequest($request['pessoa_f_j'], false, true);
        }else{
            $arrayReturn['erro'] = true;
            $arrayReturn['campos'] .= 'pessoa_f_j|';
        }

        if ($request['cadastro_data'] != null && $request['cadastro_data'] != '') {
            $request['cadastro_data'] = $sec->verificaRequest($request['cadastro_data'], false, false);
        }else{
            $request['cadastro_data'] = date("Y-m-d H:i:s");
        }

        $request['nome_fantasia'] = $sec->verificaRequest($request['nome_fantasia'], false, true);
        $request['cpf_cnpj'] = $sec->verificaRequest($request['cpf_cnpj'], false, false);
        $request['cpf_cnpj'] = $sec->soNumero($request['cpf_cnpj']);
        $request['rg_ssp'] = $sec->verificaRequest($request['rg_ssp'], false, true);
        $request['inscricao_estadual'] = $sec->verificaRequest($request['inscricao_estadual'], false, true);
        $request['telefone_principal'] = $sec->soNumero($request['telefone_principal']);
        $request['telefone_um'] = $sec->soNumero($request['telefone_um']);
        $request['email_principal'] = $sec->verificaRequest($request['email_principal'], false, true);
        $request['pessoa_contato'] = $sec->verificaRequest($request['pessoa_contato'], false, true);
        $request['endereco'] = $sec->verificaRequest($request['endereco'], false, true);
        $request['endereco_numero'] = $sec->verificaRequest($request['endereco_numero'], false, true);
        $request['endereco_complemento'] = $sec->verificaRequest($request['endereco_complemento'], false, true);
        $request['endereco_bairro'] = $sec->verificaRequest($request['endereco_bairro'], false, true);
        $request['endereco_municipio_cod'] = $sec->soNumero($request['endereco_municipio_cod']);
        $request['endereco_cep'] = $sec->soNumero($request['endereco_cep']);
        $request['endereco_cep'] = $sec->soNumero($request['endereco_cep']);
        $request['cadastro_usuario'] = $_SESSION['conexao']['login'];
        $request['observacao'] = $sec->verificaRequest($request['observacao'], false, true);

        $arrayReturn['data'] = $request;
        return $arrayReturn;

    }
}
