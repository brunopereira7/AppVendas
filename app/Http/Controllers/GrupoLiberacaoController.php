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
        $liberacao = GrupoLiberacao::find($id);

        if(!$liberacao) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json($liberacao);
    }

    public function store(Request $request)
    {
        $liberacao = new GrupoLiberacao();
        $liberacao->fill($request->all());
        $liberacao->save();

        return response()->json($liberacao, 201);
    }

    public function update(Request $request, $id)
    {
        $liberacao = GrupoLiberacao::find($id);

        if(!$liberacao) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $liberacao->fill($request->all());
        $liberacao->save();

        return response()->json($liberacao);
    }

    public function destroy($id)
    {
        $liberacao = GrupoLiberacao::find($id);

        if(!$liberacao) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $liberacao->delete();

        return response()->json(['message'   => 'Deletado com sucesso!',], 200);
    }
}
