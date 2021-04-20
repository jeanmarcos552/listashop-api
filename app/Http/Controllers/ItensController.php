<?php

namespace App\Http\Controllers;

use App\Models\Itens;
use Illuminate\Http\Request;

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
}
