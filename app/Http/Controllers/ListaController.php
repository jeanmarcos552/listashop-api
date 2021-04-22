<?php

namespace App\Http\Controllers;

use App\Models\Itens;
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
        return Lista::with('user', 'itens')->get();
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

        return Lista::create($request->all());
    }


    public function addItem(Request $request)
    {
        $inputs = $request->validate([
            'lista' => 'required',
            'itens' => 'required|array',
            'user' => 'required',
        ]);

        $lista = Lista::find($inputs['lista']);

        $itensId = [];
        foreach ($inputs['itens'] as $id) {
            if (!$lista->itens()->where('id', $id)->exists()) {
                $itensId[] = $id;
            }
        }

        if (!empty($itensId)) {
            $lista->itens()->attach($itensId);

            if (!$lista->user()->where('id', $inputs['user'])->exists()) {
                $lista->user()->attach($inputs['user']);
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Lista::with('user', 'itens')->where('id', $id)->get();
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
        $item = Lista::find($id);
        return $item->delete($id);
    }
}
