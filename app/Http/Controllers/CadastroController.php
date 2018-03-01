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
        $pessoa->fill($request->all());
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
}
