<?php

namespace App\Http\Controllers;

use App\Models\ItensLista;
use App\Models\Lista;
use Illuminate\Http\Request;

class ListaItensController extends Controller
{
    public function addItem(Request $request)
    {
        $inputs = $request->validate([
            'lista' => 'required',
            'itens' => 'required|array',
            'user' => 'required',
        ]);

        $lista = Lista::find($inputs['lista']);

        if (!$lista->user()->where('id', $inputs['user'])->exists()) {
            return response(["message" => "Voce não tem permisão para adicionar itens a essa lista!"], 403);
        }

        $itensId = [];
        foreach ($inputs['itens'] as $item) {
            if (!$lista->itens()->where('id', $item)->exists()) {
                $itensId[] = $item;
            }
        }

        if (!empty($itensId)) {
            foreach ($itensId as $item) {
                $lista->itens()->attach(
                    $item['itens_id'],
                    [
                        'qty' => $item['qty'],
                        'value' => isset($item['value']) ? $item['value'] : 0,
                    ]
                );
            }

            $output = $lista;
            $output['user'] = $lista->user;
            $output['itens'] = $lista->itens;
            return $output;
        } else {
            return response(
                [
                    'message' => 'Os itens informados, já estão inseridos na lista!'
                ],
                401
            );
        }
    }

    public function removeItem(Request $request)
    {
        $lista = new ItensLista();
        $item = $lista->where(
            "itens_id",
            $request->get('item_id')
        )
            ->where("lista_id", $request->get('lista'));
        return $item->delete();
    }

    public function updateItem(Request $request)
    {
        $inputs = $request->validate([
            'lista_id' => 'required',
            'itens_id' => 'required',
        ]);

        $lista = new ItensLista();

        $item = $lista
            ->where("itens_id", $inputs['itens_id'])
            ->where("lista_id", $inputs['lista_id'])->update($request->all());
        return $item;
    }
}
