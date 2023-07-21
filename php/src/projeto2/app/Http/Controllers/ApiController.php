<?php

namespace App\Http\Controllers;

use App\Models\Contatos;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function obterContatos()
    {
        $contatos = Contatos::get()->toJson(JSON_PRETTY_PRINT);
        return response($contatos, 200);
    }

    public function cadastrarContato(Request $request)
    {
        $contato = new Contatos;
        $contato->nome = $request->nome;
        $contato->email = $request->email;
        $contato->telefone = $request->telefone;
        $contato->whatsapp = $request->whatsapp;
        $contato->save();

        return response()->json([
            "id" => $contato->id,
            "message" => "Contato criado!"
        ], 201);
    }

    public function obterContato($id)
    {
        if (Contatos::where('id', $id)->exists()) {
            $contato = Contatos::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($contato, 200);
        } else {
            return response()->json([
                "message" => "Contato não encontrado"
            ], 404);
        }
    }

    public function atualizarContato(Request $request, $id)
    {
        if (Contatos::where('id', $id)->exists()) {
            $contato = Contatos::find($id);
            $contato->nome = is_null($request->nome) ? $contato->nome : $request->nome;
            $contato->email = is_null($request->email) ? $contato->email : $request->email;
            $contato->telefone = is_null($request->telefone) ? $contato->telefone : $request->telefone;
            $contato->whatsapp = is_null($request->whatsapp) ? $contato->whatsapp : $request->whatsapp;
            $contato->save();

            return response()->json([
                "message" => "Registros atualizados!"
            ], 200);
        } else {
            return response()->json([
                "message" => "Registro não encontrado!"
            ], 404);
        }
    }

    public function apagarContato($id)
    {
        if (Contatos::where('id', $id)->exists()) {
            $contato = Contatos::find($id);
            $contato->delete();

            return response()->json([
                "message" => "registro apagado com sucesso!"
            ], 202);
        } else {
            return response()->json([
                "message" => "registro não encontrado!"
            ], 404);
        }
    }
}
