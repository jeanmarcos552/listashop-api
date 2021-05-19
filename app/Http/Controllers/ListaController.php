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
            ->lista()->with('user', 'itens')->where("ativo", "=", true)->paginate(10);
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

        $lista = Lista::with('user', 'itens')
            ->where('id', $id)->get()[0];

        // foreach ($lista['user'] as $user) :
        //     $user_item = ItensLista::find($user->pivot->user_id);
        //     echo $user_item;
        //     // $user_item->delete($user_item);
        // endforeach;


        // $item = Lista::find($id);
        // return $item->delete($id);
    }
}
