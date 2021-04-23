<?php

namespace App\Http\Controllers;

use App\Models\Lista;
use Illuminate\Http\Request;

class ListaUserController extends Controller
{
    public function addUserToList(Request $request)
    {
        $inputs = $request->validate([
            'lista' => 'required',
            'user' => 'required',
        ]);

        $lista = Lista::find($inputs['lista']);

        if (!$lista->user()->where('id', $inputs['user'])->exists()) {
            $lista->user()->attach($inputs['user']);
            return response(null, 201);
        } else {
            return response(["message" => "usuário já tem permisão para editar a lista"], 403);
        }
    }
}
