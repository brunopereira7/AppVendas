<?php

namespace App\Http\Controllers;

use App\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function index()
    {
        $municipio = Municipio::all();
        return response()->json($municipio);
    }
    public function show($id)
    {
        $municipio = Municipio::find($id);

        if(!$municipio) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        return response()->json($municipio);
    }

    public function store(Request $request)
    {
        $municipio = new Municipio();
        $municipio->fill($request->all());
        $municipio->save();

        return response()->json($municipio, 201);
    }

    public function update(Request $request, $id)
    {
        $municipio = Municipio::find($id);

        if(!$municipio) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $municipio->fill($request->all());
        $municipio->save();

        return response()->json($municipio);
    }

    public function destroy($id)
    {
        $municipio = Municipio::find($id);

        if(!$municipio) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $municipio->delete();

        return response()->json(['message'   => 'Deletado com sucesso!',], 200);
    }
}
