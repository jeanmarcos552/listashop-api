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
        $lista =  User::find(auth()->user()->id)
            ->lista()
            ->with('user', 'itens')
            ->where("ativo", "=", true)
            ->paginate(10);

        return isset($lista[0]) ? $lista[0] : [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $lista = Lista::create($request->all());

        // adicionar permisão a lista
        $lista->user()->attach(auth()->user()->id);
        return $lista;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Lista::with('user', 'itens')
            ->where('id', $id)
            ->where('ativo', true)
            ->orderBy('name', 'DESC')->get();
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
        return $item;
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
            $listas = $lista->with('user', 'itens')->get()[0];

            if (count($listas->user) > 0) {
                foreach ($listas->user as $user) {
                    User::find($user->id)->lista()->detach();
                }
            }

            $lista->itens()->detach();
            return $lista->delete($id);
        }

        return ["code" => 403, "message" => "nenhuma lista encontrada"];
    }
}
