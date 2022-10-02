<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventos = Event::all();
        return response()->view('asignaciones.index', [$eventos]);
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
        $assignment = new Assignment();
        $assignment->fk_ficha = $request->input('fichaAsignacion');
        $assignment->fk_competencia = $request->input('competenciaAsignacion');
        $assignment->fk_resultado = $request->input('resultadoAsignacion');
        $assignment->fk_instructor = $request->input('instructorAsignacion');
        $assignment->fk_ambiente = $request->input('ambienteAsignacion');
        $assignment->tipo = $request->input('tipoAsignacion');
        $assignment->descripcion = $request->input('descripcionAsignacion');
        $assignment->save();
        $assignmentkey = $assignment->id;
        $event = new Event();
        $numeroficha = strval($assignment->ficha->numero);
        $tituloevento = $numeroficha . '-' . $assignment->instructor->nombre . ' ' . $assignment->instructor->apellidos;
        $descripcionevento = $assignment->descripcion;
        $event->title = $tituloevento;
        $event->description = $descripcionevento;
        $event->start = $request->input('fechaInicio');
        $event->end = $request->input('fechaFin');
        $event->fk_assignment = $assignmentkey;
        $event->save();
        return Redirect::route('eventos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $evento = Event::all();
        return response()->json($evento);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
