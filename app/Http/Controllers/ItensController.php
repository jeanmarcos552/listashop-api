<?php

namespace App\Http\Controllers;

use App\Models\Itens;
use Illuminate\Http\Request;

class ItensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $itens = Itens::where('ativo', true)->get();
        return $itens;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Itens::create([
            'name' => $request->name,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Itens  $itens
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $itens = Itens::all();
        return $itens;
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Itens  $itens
     * @return \Illuminate\Http\Response
     */
    public function edit(Itens $itens)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Itens  $itens
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Itens $itens)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Itens  $itens
     * @return \Illuminate\Http\Response
     */
    public function destroy(Itens $itens)
    {
        //
    }
}
