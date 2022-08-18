<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Instructor;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fichas = Card::where('isEliminated', false)->get();
        return view('fichas.index', compact('fichas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programas = Program::where('isEliminated', false)->get();
        $instructores = Instructor::where('isEliminated', false)->get();
        return view('fichas.create', compact('programas', 'instructores'));
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
            'numeroFicha' => 'required|numeric',
            'programaFicha' => 'required',
            'jornadaFicha' => 'required',
            'modalidadFicha' => 'required',
            'inicioFicha' => 'required|date',
            'finalFicha' => 'required|date',
            'instructorFicha' => 'required',
            'cantidadAprendices' => 'required|numeric'
        ]);
        $ficha = new Card();
        $ficha->numero = $request->numeroFicha;
        $ficha->fk_programa = $request->programaFicha;
        $ficha->jornada = $request->jornadaFicha;
        $ficha->modalidad = $request->modalidadFicha;
        $ficha->fechainicio = $request->inicioFicha;
        $ficha->fechafin = $request->finalFicha;
        $ficha->fk_instructor = $request->instructorFicha;
        $ficha->cantidad = $request->cantidadAprendices;
        $ficha->save();
        return Redirect::route('fichas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function edit(Card $ficha)
    {
        $ficha = Card::where('id', $ficha->id)->first();
        return view('fichas.edit', compact('ficha'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function destroy(Card $card)
    {
        //
    }
}
