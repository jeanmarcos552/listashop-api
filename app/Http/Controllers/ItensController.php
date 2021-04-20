<?php

namespace App\Http\Controllers;

use App\Models\Itens;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ItensController extends Controller
{
    private $itensPerPage = 10;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Itens::where('ativo', '=', true)->paginate($this->itensPerPage);
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

        return Itens::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Itens  $itens
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Itens::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Itens  $itens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Itens::find($id);
        $item->update($request->all());
        return $item;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Itens  $itens
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Itens::find($id);
        return $item->delete($id);
    }

    // public function querySearch(Request $request)
    // {
    //     if ($request->get('name')) {
    //         $q = Itens::where('name', 'like', '%'.$request->get('name').'%');
    //     }

    //     if ($request->get('ativo')) {
    //         $q = Itens::where('ativo', '=', $request->get('ativo'));
    //     }

    //     return $q->paginate($this->itensPerPage);
    // }
}
