<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\Request;

class ListaUserController extends Controller
{
    /**
     * Adiciona usuários a lista
     */
    public function store(Request $request)
    {
        $inputs = $request->validate([
            'lista' => 'required',
            'user' => 'required',
        ]);

        $lista = Lista::find($inputs['lista']);
        return $lista->user()->get();

        if (!$lista->user()->where('id', $inputs['user'])->exists()) {
            $lista->user()->attach($inputs['user']);
            return response(null, 201);
        } else {
            return response(["message" => "usuário já tem permisão para editar a lista"], 403);
        }
    }

    /**
     * Remove usuario
     */
    public function destroy($id) {
        $user = auth()->user()->id;
        $lista = Lista::find($id);
        return $lista->user()->detach($user);
    }
}
