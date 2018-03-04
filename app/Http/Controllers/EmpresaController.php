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


        $arrayReturn['data'] = $request;
        return $arrayReturn;

    }
}
