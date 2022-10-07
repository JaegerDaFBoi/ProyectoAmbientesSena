<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Card;
use App\Models\Event;
use App\Models\Instructor;
use Carbon\Carbon;
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
        $event = new Event(); //Crear objeto evento
        $ficha = $request->input('fichaAsignacion'); //Traer id de ficha por request
        $fichaasignacion = Card::find($ficha); //Consultar ficha
        $instructor = $request->input('instructorAsignacion'); //Traer id de instructor por request
        $instructorasignacion = Instructor::find($instructor); //Consultar instructor
        $ambiente = $request->input('ambienteAsignacion'); //Traer id de ambiente por request
        
        
        $fechainicio = $request->input('fechaInicio'); //Traer fecha de inicio
        $fechafin = $request->input('fechaFin'); //Traer fecha de fin
        if (Assignment::whereIn('id', 
        Event::select('fk_assignment')->where([['start', '>=', $fechainicio],['end', '<=', $fechafin]])->get()->toArray()
        )->where(function ($query) use ($instructor, $ficha, $ambiente){
            $query->where('fk_instructor', $instructor)->orWhere('fk_ficha', $ficha)->orWhere('fk_ambiente', $ambiente);
        })->exist()) {
            return Redirect::route('eventos.index')->with("message", "No se puede crear el evento. Ya existe un evento con el rango de fechas solicitado");
        } else {
            if ($request->input('tipoAsignacion') == "Titulada") {
                $assignment = new Assignment();
                $assignment->fk_ficha = $ficha;
                $assignment->fk_competencia = $request->input('competenciaAsignacion');
                $assignment->fk_resultado = $request->input('resultadoAsignacion');
                $assignment->fk_instructor = $instructor;
                $assignment->fk_ambiente = $ambiente;
                $assignment->tipo = $request->input('tipoAsignacion');
                $assignment->descripcion = $request->input('descripcionAsignacion');
                $assignment->save();
                $assignmentkey = $assignment->id;
                $event = new Event();
                $numeroficha = strval($assignment->ficha->numero);
                $tituloevento = $numeroficha . ' ' . $assignment->instructor->nombre . ' ' . $assignment->instructor->apellidos;
                $event->title = $tituloevento;
                $event->description = $assignment->descripcion;
                $event->start = $request->input('fechaInicio');
                $event->end = $request->input('fechaFin');
                $event->fk_assignment = $assignmentkey;
                $event->save();
            } else {
                $assignment = new Assignment();
                $assignment->fk_instructor = $instructor;
                $assignment->tipo = $request->input('tipoAsignacion');
                $assignment->fk_ambiente = $ambiente;
                $assignment->descripcion = $request->input('descripcionEvento');
                $assignment->save();
                $assignmentkey = $assignment->id;
                $event = new Event();
                $tituloeventoopt = $request->input('tituloEvento');
                $descripcionevento = $assignment->descripcion;
                $event->title = $tituloeventoopt;
                $event->description = $descripcionevento;
                $event->start = $request->input('fechaInicio');
                $event->end = $request->input('fechaFin');
                $event->fk_assignment = $assignmentkey;
                $event->save();
            }
        }
        // if ($request->input('tipoAsignacion') == "Titulada") {
        //     $assignment = new Assignment();
        //     $assignment->fk_ficha = $request->input('fichaAsignacion');
        //     $assignment->fk_competencia = $request->input('competenciaAsignacion');
        //     $assignment->fk_resultado = $request->input('resultadoAsignacion');
        //     $assignment->fk_instructor = $request->input('instructorAsignacion');
        //     $assignment->fk_ambiente = $request->input('ambienteAsignacion');
        //     $assignment->tipo = $request->input('tipoAsignacion');
        //     $assignment->descripcion = $request->input('descripcionAsignacion');
        //     $assignment->save();
        //     $assignmentkey = $assignment->id;
        //     $event = new Event();
        //     $numeroficha = strval($assignment->ficha->numero);
        //     $tituloevento = $numeroficha . '-' . $assignment->instructor->nombre . ' ' . $assignment->instructor->apellidos;
        //     $descripcionevento = $assignment->descripcion;
        //     $event->title = $tituloevento;
        //     $event->description = $descripcionevento;
        //     $event->start = $request->input('fechaInicio');
        //     $event->end = $request->input('fechaFin');
        //     $event->fk_assignment = $assignmentkey;
        //     $event->save();
        // } else {
        //     $assignment = new Assignment();
        //     $assignment->fk_instructor = $request->input('instructorAsignacion');
        //     $assignment->tipo = $request->input('tipoAsignacion');
        //     $assignment->fk_ambiente = $request->input('ambienteAsignacion');
        //     $assignment->descripcion = $request->input('descripcionEvento');
        //     $assignment->save();
        //     $assignmentkey = $assignment->id;
        //     $event = new Event();
        //     $tituloevento = $request->input('tituloEvento');
        //     $descripcionevento = $assignment->descripcion;
        //     $event->title = $tituloevento;
        //     $event->description = $descripcionevento;
        //     $event->start = $request->input('fechaInicio');
        //     $event->end = $request->input('fechaFin');
        //     $event->fk_assignment = $assignmentkey;
        //     $event->save();
        // }
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
        $eventos = Event::all();

        return response()->json($eventos);
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
