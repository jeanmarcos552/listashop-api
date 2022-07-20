<?php

namespace App\Http\Controllers;

use App\Models\Itens;
use App\Models\ItensLista;
use App\Models\Lista;
use App\Models\User;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::find(auth()->user()->id)
            ->lista()
            ->with('user', 'itens')
            ->where("ativo", "=", true)
            ->orderBy('created_at', 'desc')->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
        ]);
        $input['created_by'] = auth()->user()->id;
        $lista = Lista::create($input);

        // adicionar permisão a lista
        $lista->user()->attach(auth()->user()->id);

        return User::find(auth()->user()->id)
            ->lista()
            ->with('user', 'itens')
            ->where("id", $lista->id)
            ->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $output = [];

        $lista = Lista::find($id);
        if (!$lista) return response("Lista nao encontrada!", 404);
        $output = $lista;
        $user = $lista->user()->orderBy('name', 'desc')->get();
        $output['user'] = $user;

        $itens = $lista->itens();
        if ($request->has("itens")) {
            $itens->where("status", "=", $request->get('itens'));
        }

        if ($request->has("order")) {
            $itens->orderBy('name',  $request->get('order'));
        } else {
            $itens->orderBy('name', 'DESC');
        }


        $output['itens'] = $itens->get();
        $output['category'] = $lista->category()->get();

        $output['info'] = [
            "user" => $user->count(),
            "itens" => $itens->count(),
        ];

        return $output;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Lista::find($id);
        $item->update($request->all());
        return $item->where("id", $id)->with("category")->first();;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lista = Lista::find($id);

        if ($lista) {
            $lista->itens()->detach();
            $lista->user()->detach();
            $isDelete = $lista->delete($id);

            if ($isDelete) {
                return  response("Lista foi deletada!", 201);
            }
            return  response("Não foi possível deletar a Lista!", 403);
        }

        return  response("nenhuma lista encontrada", 404);
    }
}