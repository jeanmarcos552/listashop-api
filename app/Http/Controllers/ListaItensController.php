<?php

namespace App\Http\Controllers;

use App\Models\Itens;
use App\Models\ItensLista;
use App\Models\Lista;
use App\Models\User;
use Illuminate\Http\Request;

class ListaItensController extends Controller
{
    public function showByStatus($id, Request $request)
    {
        $inputs = $request->validate([
            'status' => 'required',
        ]);

        return Lista::find($id)
            ->itens()
            ->where("status", "=", $inputs["status"])
            ->get();
    }

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


        if (isset($inputs['itens'][0])) {
            $itensId = [];
            foreach ($inputs['itens'] as $item) {
                if (!$lista->itens()->where('id', $item)->exists()) {
                    $itensId[] = $item;
                }
            }
        } else {
            if (!$lista->itens()->where('id', $inputs['itens'])->exists()) {
                $itensId[] = $inputs['itens'];
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
        }
        return true;
    }

    public function removeItem($lista_id, $item_id)
    {
        $lista = new ItensLista();
        $item = $lista->where("itens_id", $item_id)
            ->where("lista_id", $lista_id);

        if (!$item->exists())  return response("Item não existe nessa lista!", 404);

        $isDeleted = $item->delete();

        if ($isDeleted) return response("Deletado com sucesso!", 201);

        return response("Erro ao Deletar!", 500);
    }

    public function updateItem($lista_id, $item_id, Request $request)
    {

        $item = ItensLista::where("itens_id", $item_id)
            ->where("lista_id", $lista_id)->update($request->all());
        return $item;
    }
}
