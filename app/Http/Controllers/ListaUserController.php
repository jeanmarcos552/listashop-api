<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use App\Models\Notifications;
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
            'notification_id' => 'required'
        ]);

        $lista = Lista::find($input['lista']);
        if (!$lista) return response(["message" => "lista não encontrada"], 403);

        $usuario = User::where("email", "=", $input['user'])->first();

        if ($usuario) {
            if (!$lista->user()->where('id', "=", $usuario->id)->exists()) {
                $lista->user()->attach($usuario->id);

                $notification = Notifications::find($input['notification_id']);
                $notification->update(["status", true]);

                return response("Compartilhada com sucesso!", 201);
            } else {
                return response("usuário já tem permisão para editar a lista", 403);
            }
        } else {
            return response("Foi enviado um email para: $input[user]");
        }
    }

    /**
     * Remove usuario
     */
    public function destroy($lista_id, $user_id, Request $request)
    {

        $user = User::find($user_id);
        $lista = Lista::find($lista_id);

        return $lista->user()->detach($user->id);
    }
}