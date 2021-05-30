<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\User;
use Illuminate\Http\Request;

class ListaUserController extends Controller
{
    /**
     * Adiciona usuários a lista
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'lista' => 'required',
            'user' => 'required',
        ]);

        $lista = Lista::find($input['lista']);
        if (!$lista) return response(["message" => "lista não encontrada"], 403);

        $usuario = User::where("email", "=", $input['user'])->first();

        if ($usuario) {
            if (!$lista->user()->where('id', "=", $usuario->id)->exists()) {
                $lista->user()->attach($usuario->id);
                return response(["message" => "Compartilhada com sucesso!"], 201);
            } else {
                return response(["message" => "usuário já tem permisão para editar a lista"], 403);
            }
        } else {
            return ["message" => "Foi enviado um email para: $input[user]"];
        }
    }

    /**
     * Remove usuario
     */
    public function destroy($id, Request $request)
    {

        $inputs = $request->validate([
            "user" => "required",
        ]);

        $user = User::find($inputs["user"]);
        $lista = Lista::find($id);

        return $lista->user()->detach($user->id);
    }
}
