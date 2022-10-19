<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Card;
use App\Models\Event;
use App\Models\Instructor;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
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
        //Variables que almacenan los datos de Asignacion 
        $fichaAsignacion = $request->input('fichaAsignacion');
        $competenciaAsignacion = $request->input('competenciaAsignacion');
        $resultadoAsignacion = $request->input('resultadoAsignacion');
        $instructorAsignacion = $request->input('instructorAsignacion');
        $ambienteAsignacion = $request->input('ambienteAsignacion');
        $tipoAsignacion = $request->input('tipoAsignacion');
        $descripcionAsignacion = $request->input('descripcionAsignacion');
        //Variables que almacenan los datos del Evento
        $instructor = Instructor::find($instructorAsignacion); //Consulto Instructor por Id
        $ficha = Card::find($fichaAsignacion); //Consulto Ficha por Id
        $tituloEvento = $ficha->numero . '-' . $instructor->nombre . ' ' . $instructor->apellidos;
        $descripcionEvento = $descripcionAsignacion;
        $format = "Y-m-d H:i:s"; //Formato de fechas
        $fechaInicio = Carbon::parse($request->input('fechaInicio'))->format($format); // Parseo las fechas con Carbon
        $fechaFin = Carbon::parse($request->input('fechaFin'))->format($format); //
        $fechaconcat = $fechaInicio . '' . $fechaFin;

        //Creo el objeto Asignacion
        $asignacion = new Assignment();
        //Asigno los valores a los campos de la tabla sin guardar aún
        $asignacion->fk_ficha = $fichaAsignacion;
        $asignacion->fk_competencia = $competenciaAsignacion;
        $asignacion->fk_resultado = $resultadoAsignacion;
        $asignacion->fk_instructor = $instructorAsignacion;
        $asignacion->fk_ambiente = $ambienteAsignacion;
        $asignacion->tipo = $tipoAsignacion;
        $asignacion->descripcion = $descripcionAsignacion;
        $asignaciones = Assignment::whereIn(
            'id',
            Event::select('fk_assignment')->whereBetween('start', [$fechaInicio, $fechaFin])->orwhereBetween('end', [$fechaInicio, $fechaFin])->get()->toArray()
        )->where(function ($query) use ($instructorAsignacion, $fichaAsignacion, $ambienteAsignacion) {
            $query->where('fk_instructor', $instructorAsignacion)
                ->orWhere('fk_ficha', $fichaAsignacion)
                ->orWhere('fk_ambiente', $ambienteAsignacion);
        })->get();
        if (count($asignaciones) > 0){
            return Redirect::route('eventos.index')->with("message", "No se puede crear el evento. Ya existe un evento con el rango de fechas solicitado");
        } else {
            if ($request->input('tipoAsignacion') == "Titulada") {
                $asignacion->fk_ficha = $fichaAsignacion;
                $asignacion->fk_competencia = $competenciaAsignacion;
                $asignacion->fk_resultado = $resultadoAsignacion;
                $asignacion->fk_instructor = $instructorAsignacion;
                $asignacion->fk_ambiente = $ambienteAsignacion;
                $asignacion->tipo = $tipoAsignacion;
                $asignacion->descripcion = $descripcionAsignacion;
                $asignacion->save();
                $assignmentkey = $asignacion->id;
                $event = new Event();
                $numeroficha = strval($asignacion->ficha->numero);
                $tituloevento = $numeroficha . '-' . $asignacion->instructor->nombre . ' ' . $asignacion->instructor->apellidos;
                $descripcionevento = $asignacion->descripcion;
                $event->title = $tituloevento;
                $event->description = $descripcionevento;
                $event->start = $request->input('fechaInicio');
                $event->end = $request->input('fechaFin');
                $event->fk_assignment = $assignmentkey;
                $event->save();
            } else {
                $assignment = new Assignment();
                $assignment->fk_instructor = $request->input('instructorAsignacion');
                $assignment->tipo = $request->input('tipoAsignacion');
                $assignment->fk_ambiente = $request->input('ambienteAsignacion');
                $assignment->descripcion = $request->input('descripcionEvento');
                $assignment->save();
                $assignmentkey = $assignment->id;
                $event = new Event();
                $tituloevento = $request->input('tituloEvento');
                $descripcionevento = $assignment->descripcion;
                $event->title = $tituloevento;
                $event->description = $descripcionevento;
                $event->start = $request->input('fechaInicio');
                $event->end = $request->input('fechaFin');
                $event->fk_assignment = $assignmentkey;
                $event->save();
            }
            return Redirect::route('eventos.index');
        }
        // $eventosExistentes = Event::whereBetween('start', [$fechaInicio, $fechaFin])
        // ->orWhereBetween('end' , [$fechaInicio, $fechaFin])->get();



    }




    //Metodo store

    // $format = "Y-m-d H:i:s";
    // $fecha_inicio_periodo = DateTime::createFromFormat($format, $fechainicio);
    // $fecha_fin_periodo = DateTime::createFromFormat($format, $fechafin);
    // $periodo = new DatePeriod($fecha_inicio_periodo, new DateInterval('P1D'), $fecha_fin_periodo);
    // $rango = [];
    // foreach ($periodo as $fecha) {
    //     $rango[] = $fecha->format($format);
    // }
    // $rango[] = $fechafin;
    // $solofecha = Carbon::parse($fechainicio)->format('Y-m-d');
    // $eventos = Event::whereDate('start', $solofecha)->whereDate('end', $solofecha)->get();

    // $event = new Event(); 
    // $ficha = $request->input('fichaAsignacion'); 
    // $instructor = $request->input('instructorAsignacion'); 
    // $ambiente = $request->input('ambienteAsignacion'); 
    // $fechainicio = $request->input('fechaInicio'); 
    // $fechafin = $request->input('fechaFin'); 
    // $eventos = Event::whereBetween('start', [$fechainicio, $fechafin])->whereBetween('end', [$fechainicio, $fechafin])->get();
    // $assignmentsdue = [];
    // foreach ($eventos as $evento) {
    //     $assignmentsdue[] = Assignment::where('id', $evento->fk_assignment)->first();
    // }
    // if (count($eventos) != 0) {
    //     return Redirect::route('eventos.index')->with("message", "No se puede crear el evento. Ya existe un evento con el rango de fechas solicitado");
    // } else {
    //     foreach ($assignmentsdue as $assignment) {
    //         if ($assignment->fk_ambiente == $ambiente) {
    //             return Redirect::route('eventos.index')->with("message", "No se puede crear el evento. El ambiente ya tiene un evento en este horario");
    //         } elseif ($assignment->fk_ficha == $ficha) {
    //             return Redirect::route('eventos.index')->with("message", "No se puede crear el evento. La ficha ya tiene un evento en este horario");
    //         } elseif ($assignment->fk_instructor == $instructor) {
    //             return Redirect::route('eventos.index')->with("message", "No se puede crear el evento. El instructor ya tiene un evento en este horario");
    //         } else {
    //             if ($request->input('tipoAsignacion') == "Titulada") {
    //                 $assignment = new Assignment();
    //                 $assignment->fk_ficha = $ficha;
    //                 $assignment->fk_competencia = $request->input('competenciaAsignacion');
    //                 $assignment->fk_resultado = $request->input('resultadoAsignacion');
    //                 $assignment->fk_instructor = $instructor;
    //                 $assignment->fk_ambiente = $ambiente;
    //                 $assignment->tipo = $request->input('tipoAsignacion');
    //                 $assignment->descripcion = $request->input('descripcionAsignacion');
    //                 $assignment->save();
    //                 $assignmentkey = $assignment->id;
    //                 $event = new Event();
    //                 $numeroficha = strval($assignment->ficha->numero);
    //                 $tituloevento = $numeroficha . ' ' . $assignment->instructor->nombre . ' ' . $assignment->instructor->apellidos;
    //                 $event->title = $tituloevento;
    //                 $event->description = $assignment->descripcion;
    //                 $event->start = $request->input('fechaInicio');
    //                 $event->end = $request->input('fechaFin');
    //                 $event->fk_assignment = $assignmentkey;
    //                 $event->save();
    //                 break;
    //             } else {
    //                 $assignment = new Assignment();
    //                 $assignment->fk_instructor = $instructor;
    //                 $assignment->tipo = $request->input('tipoAsignacion');
    //                 $assignment->fk_ambiente = $ambiente;
    //                 $assignment->descripcion = $request->input('descripcionEvento');
    //                 $assignment->save();
    //                 $assignmentkey = $assignment->id;
    //                 $event = new Event();
    //                 $tituloeventoopt = $request->input('tituloEvento');
    //                 $descripcionevento = $assignment->descripcion;
    //                 $event->title = $tituloeventoopt;
    //                 $event->description = $descripcionevento;
    //                 $event->start = $request->input('fechaInicio');
    //                 $event->end = $request->input('fechaFin');
    //                 $event->fk_assignment = $assignmentkey;
    //                 $event->save();
    //                 break;
    //             }
    //         }
    //     } 

    // }
    // if (Assignment::whereIn(
    //     'id',
    //     Event::select('fk_assignment')->whereBetween('start', [$fechainicio, $fechafin])->whereBetween('end', [$fechainicio, $fechafin])->get()->toArray()
    // )->where(function ($query) use ($instructor, $ficha, $ambiente) {
    //     $query->where('fk_instructor', $instructor)
    //         ->where('fk_ficha', $ficha)
    //         ->where('fk_ambiente', $ambiente);
    // })->exists()) {
    //     return Redirect::route('eventos.index')->with("message", "No se puede crear el evento. Ya existe un evento con el rango de fechas solicitado");
    // } else {

    //     }


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
    // return Redirect::route('eventos.index');

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
