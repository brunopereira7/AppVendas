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
        $empresa = Empresa::find($id);

        if(!$empresa) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json($empresa);
    }

    public function store(Request $request)
    {
        $empresa = new Empresa();
        $empresa->fill($request->all());
        $empresa->save();

        return response()->json($empresa, 201);
    }

    public function update(Request $request, $id)
    {
        $empresa = Empresa::find($id);

        if(!$empresa) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $empresa->fill($request->all());
        $empresa->save();

        return response()->json($empresa);
    }

    public function destroy($id)
    {
        $empresa = Empresa::find($id);

        if(!$empresa) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $empresa->delete();

        return response()->json(['message'   => 'Deletado com sucesso!',], 200);
    }
}
