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
        $request->validate([
            'tipoAsignacion' => 'required',
            'recurrencia' => 'required'
        ]);
        if ($request->input('recurrencia') == 1) {
            $fichaAsignacion = $request->input('fichaAsignacion');
            $competenciaAsignacion = $request->input('competenciaAsignacion');
            $resultadoAsignacion = $request->input('resultadoAsignacion');
            $instructorAsignacion = $request->input('instructorAsignacion');
            $ambienteAsignacion = $request->input('ambienteAsignacion');
            $tipoAsignacion = $request->input('tipoAsignacion');
            if (empty($request->input('descripcionAsignacion'))) {
                $descripcionAsignacion = " ";
            } else {
                $descripcionAsignacion = $request->input('descripcionAsignacion');
            }
            $format = "Y-m-d H:i:s";
            $fechaInicio = Carbon::parse($request->input('fechaInicio'))->format($format);
            $fechaFin = Carbon::parse($request->input('fechaFin'))->format($format); //
            $asignacion = new Assignment();
            $semanas_que_se_repite_evento = $request->input('numSemanas');
            $fechaInicioRecurrencia = Carbon::createFromTimeString($fechaInicio);
            $fechaFinRecurrencia = Carbon::createFromTimeString($fechaFin);
            $asignaciones = Assignment::whereIn(
                'id',
                Event::select('fk_assignment')->whereBetween('start', [$fechaInicio, $fechaFin])->orwhereBetween('end', [$fechaInicio, $fechaFin])->get()->toArray()
            )->where(function ($query) use ($instructorAsignacion, $fichaAsignacion, $ambienteAsignacion) {
                $query->where('fk_instructor', $instructorAsignacion)
                    ->orWhere('fk_ficha', $fichaAsignacion)
                    ->orWhere('fk_ambiente', $ambienteAsignacion);
            })->get();
            if (count($asignaciones) > 0) {
                return Redirect::route('eventos.index')->with("message", "No se puede crear el evento. Ya existe un evento en este rango de fechas con las asignaciones solicitadas. Verifique la asignación de instructor, ambiente o ficha de formación");
            } else {
                if ($request->input('tipoAsignacion') == "Titulada") {
                    $asignacion = new Assignment();
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
                    $event->start = $fechaInicio;
                    $event->end = $fechaFin;
                    $event->fk_assignment = $assignmentkey;
                    $event->save();
                } else {
                    $asignacion = new Assignment();
                    $asignacion->fk_instructor = $request->input('instructorAsignacion');
                    $asignacion->tipo = $request->input('tipoAsignacion');
                    $asignacion->fk_ambiente = $request->input('ambienteAsignacion');
                    $asignacion->descripcion = $request->input('descripcionEvento');
                    $asignacion->save();
                    $assignmentkey = $asignacion->id;
                    $event = new Event();
                    $tituloevento = $request->input('tituloEvento');
                    $descripcionevento = $asignacion->descripcion;
                    $event->title = $tituloevento;
                    $event->description = $descripcionevento;
                    $event->start = $fechaInicio;
                    $event->end = $fechaFin;
                    $event->fk_assignment = $assignmentkey;
                    $event->save();
                }
            }
            $semanas_que_se_repite_evento = $semanas_que_se_repite_evento - 1;
            for ($i = 0; $i < $semanas_que_se_repite_evento; $i++) {
                $fecha_siguiente_semana_inicio = $fechaInicioRecurrencia->addWeek();
                $fecha_siguiente_semana_fin = $fechaFinRecurrencia->addWeek();
                $asignaciones = Assignment::whereIn(
                    'id',
                    Event::select('fk_assignment')->whereBetween('start', [$fecha_siguiente_semana_inicio, $fecha_siguiente_semana_fin])->orwhereBetween('end', [$fecha_siguiente_semana_inicio, $fecha_siguiente_semana_fin])->get()->toArray()
                )->where(function ($query) use ($instructorAsignacion, $fichaAsignacion, $ambienteAsignacion) {
                    $query->where('fk_instructor', $instructorAsignacion)
                        ->orWhere('fk_ficha', $fichaAsignacion)
                        ->orWhere('fk_ambiente', $ambienteAsignacion);
                })->get();
                if (count($asignaciones) > 0) {
                    return Redirect::route('eventos.index')->with("message", "No se puede crear el evento. Ya existe un evento en este rango de fechas con las asignaciones solicitadas. Verifique la asignación de instructor, ambiente o ficha de formación");
                } else {
                    if ($request->input('tipoAsignacion') == "Titulada") {
                        $asignacion = new Assignment();
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
                        $event->start = $fecha_siguiente_semana_inicio;
                        $event->end = $fecha_siguiente_semana_fin;
                        $event->fk_assignment = $assignmentkey;
                        $event->save();
                    } else {
                        $asignacion = new Assignment();
                        $asignacion->fk_instructor = $request->input('instructorAsignacion');
                        $asignacion->tipo = $request->input('tipoAsignacion');
                        $asignacion->fk_ambiente = $request->input('ambienteAsignacion');
                        $asignacion->descripcion = $request->input('descripcionEvento');
                        $asignacion->save();
                        $assignmentkey = $asignacion->id;
                        $event = new Event();
                        $tituloevento = $request->input('tituloEvento');
                        $descripcionevento = $asignacion->descripcion;
                        $event->title = $tituloevento;
                        $event->description = $descripcionevento;
                        $event->start = $fecha_siguiente_semana_inicio;
                        $event->end = $fecha_siguiente_semana_fin;
                        $event->fk_assignment = $assignmentkey;
                        $event->save();
                    }
                }
            }
            return Redirect::route('eventos.index');
        } else {
            //+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
            //Variables que almacenan los datos de Asignacion 
            $fichaAsignacion = $request->input('fichaAsignacion');
            $competenciaAsignacion = $request->input('competenciaAsignacion');
            $resultadoAsignacion = $request->input('resultadoAsignacion');
            $instructorAsignacion = $request->input('instructorAsignacion');
            $ambienteAsignacion = $request->input('ambienteAsignacion');
            $tipoAsignacion = $request->input('tipoAsignacion');
            if (empty($request->input('descripcionAsignacion'))) {
                $descripcionAsignacion = " ";
            } else {
                $descripcionAsignacion = $request->input('descripcionAsignacion');
            }
            //Variables que almacenan los datos del Evento
            $format = "Y-m-d H:i:s"; //Formato de fechas
            $fechaInicio = Carbon::parse($request->input('fechaInicio'))->format($format); // Parseo las fechas con Carbon
            $fechaFin = Carbon::parse($request->input('fechaFin'))->format($format); //

            //Creo el objeto Asignacion
            $asignaciones = Assignment::whereIn(
                'id',
                Event::select('fk_assignment')->whereBetween('start', [$fechaInicio, $fechaFin])->orwhereBetween('end', [$fechaInicio, $fechaFin])->get()->toArray()
            )->where(function ($query) use ($instructorAsignacion, $fichaAsignacion, $ambienteAsignacion) {
                $query->where('fk_instructor', $instructorAsignacion)
                    ->orWhere('fk_ficha', $fichaAsignacion)
                    ->orWhere('fk_ambiente', $ambienteAsignacion);
            })->get();
            if (count($asignaciones) > 0) {
                return Redirect::route('eventos.index')->with("message", "No se puede crear el evento. Ya existe un evento en este rango de fechas con las asignaciones solicitadas. Verifique la asignación de instructor, ambiente o ficha de formación");
            } else {
                if ($request->input('tipoAsignacion') == "Titulada") {
                    $asignacion = new Assignment();
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
                    $asignacion = new Assignment();
                    $asignacion->fk_instructor = $request->input('instructorAsignacion');
                    $asignacion->tipo = $request->input('tipoAsignacion');
                    $asignacion->fk_ambiente = $request->input('ambienteAsignacion');
                    $asignacion->descripcion = $request->input('descripcionEvento');
                    $asignacion->save();
                    $assignmentkey = $asignacion->id;
                    $event = new Event();
                    $tituloevento = $request->input('tituloEvento');
                    $descripcionevento = $asignacion->descripcion;
                    $event->title = $tituloevento;
                    $event->description = $descripcionevento;
                    $event->start = $request->input('fechaInicio');
                    $event->end = $request->input('fechaFin');
                    $event->fk_assignment = $assignmentkey;
                    $event->save();
                }
                return Redirect::route('eventos.index');
            }
        }
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
    public function edit($idevento)
    {
        $evento = Event::find($idevento);
        $fechainicio = $evento->start;
        $fechafin = $evento->end;
        return view('asignaciones.edit', compact('idevento', 'fechainicio', 'fechafin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idevento)
    {
        $evento = Event::find($idevento);
        $assignmentkey = $evento->fk_assignment;
        $asignacion = Assignment::find($assignmentkey);
        $fichaAsignacion = $request->input('fichaAsignacion');
        $competenciaAsignacion = $request->input('competenciaAsignacion');
        $resultadoAsignacion = $request->input('resultadoAsignacion');
        $instructorAsignacion = $request->input('instructorAsignacion');
        $ambienteAsignacion = $request->input('ambienteAsignacion');
        $tipoAsignacion = $asignacion->tipo;
        $descripcionAsignacion = $asignacion->descripcion;
        $format = "Y-m-d H:i:s";
        $fechaInicio = Carbon::parse($request->input('fechaInicio'))->format($format);
        $fechaFin = Carbon::parse($request->input('fechaFin'))->format($format);
        if ($fechaInicio != $evento->start || $fechaFin != $evento->end) {
            $asignaciones = Assignment::whereIn(
                'id',
                Event::select('fk_assignment')->whereBetween('start', [$fechaInicio, $fechaFin])->orwhereBetween('end', [$fechaInicio, $fechaFin])->get()->toArray()
            )->where(function ($query) use ($instructorAsignacion, $fichaAsignacion, $ambienteAsignacion) {
                $query->where('fk_instructor', $instructorAsignacion)
                    ->orWhere('fk_ficha', $fichaAsignacion)
                    ->orWhere('fk_ambiente', $ambienteAsignacion);
            })->get();
            if (count($asignaciones) > 0) {
                return Redirect::route('eventos.edit', $idevento)->with("message", "No se puede actualizar el evento. Ya existe un evento en este rango de fechas con las asignaciones solicitadas. Verifique la asignación de instructor, ambiente o ficha de formación");
            } else {
                if ($request->input('tipoAsignacion') == "Titulada") {
                    $asignacion->fk_ficha = $fichaAsignacion;
                    $asignacion->fk_competencia = $competenciaAsignacion;
                    $asignacion->fk_resultado = $resultadoAsignacion;
                    $asignacion->fk_instructor = $instructorAsignacion;
                    $asignacion->fk_ambiente = $ambienteAsignacion;
                    $asignacion->tipo = $tipoAsignacion;
                    if (empty($request->input('descripcionAsignacion'))) {
                        $asignacion->descripcion = " "; 
                    } else {
                        $asignacion->descripcion = $request->input('descripcionAsignacion');
                    }
                    $asignacion->save();
                    $ficha = Card::find($fichaAsignacion);
                    $instructor = Instructor::find($instructorAsignacion);
                    $numeroficha = strval($ficha->numero);
                    $tituloevento = $numeroficha . '-' . $instructor->nombre . ' ' . $instructor->apellidos;
                    $descripcionevento = $asignacion->descripcion;
                    $evento->title = $tituloevento;
                    $evento->description = $descripcionevento;
                    $evento->start = $fechaInicio;
                    $evento->end = $fechaFin;
                    $evento->save();
                } else {
                    $asignacion->fk_instructor = $instructorAsignacion;
                    $asignacion->fk_ambiente = $ambienteAsignacion;
                    $asignacion->tipo = $tipoAsignacion;
                    if (empty($request->input('descripcionAsignacion'))) {
                        $asignacion->descripcion = " "; 
                    } else {
                        $asignacion->descripcion = $request->input('descripcionAsignacion');
                    }
                    $asignacion->save();
                    $tituloevento = $request->input('tituloEvento');
                    $descripcionevento = $descripcionAsignacion;
                    $evento->title = $tituloevento;
                    $evento->description = $descripcionevento;
                    $evento->start = $fechaInicio;
                    $evento->end = $fechaFin;
                    $evento->save();
                }
                return Redirect::route('eventos.index');
            }
        } else {
            $asignaciones = Assignment::whereIn(
                'id',
                Event::select('fk_assignment')->whereBetween('start', [$fechaInicio, $fechaFin])->orwhereBetween('end', [$fechaInicio, $fechaFin])
                ->whereNot(function ($query) use ($asignacion) {
                    $query->where('fk_assignment', $asignacion->id);
                })->get()->toArray()
            )->where(function ($query) use ($instructorAsignacion, $fichaAsignacion, $ambienteAsignacion) {
                $query->where('fk_instructor', $instructorAsignacion)
                    ->orWhere('fk_ficha', $fichaAsignacion)
                    ->orWhere('fk_ambiente', $ambienteAsignacion);
            })
            ->whereNot(function ($query) use ($asignacion) {
                $query->where('id', $asignacion->id);
            })
            ->get();
            if (count($asignaciones) > 0) {
                return Redirect::route('eventos.edit', $idevento)->with("message", "No se puede actualizar el evento. Ya existe un evento en este rango de fechas con las asignaciones solicitadas. Verifique la asignación de instructor, ambiente o ficha de formación");
            } else {
                if ($tipoAsignacion == "Titulada") {
                    $asignacion->fk_ficha = $fichaAsignacion;
                    $asignacion->fk_competencia = $competenciaAsignacion;
                    $asignacion->fk_resultado = $resultadoAsignacion;
                    $asignacion->fk_instructor = $instructorAsignacion;
                    $asignacion->fk_ambiente = $ambienteAsignacion;
                    $asignacion->tipo = $tipoAsignacion;
                    if (empty($request->input('descripcionAsignacion'))) {
                        $asignacion->descripcion = " "; 
                    } else {
                        $asignacion->descripcion = $request->input('descripcionAsignacion');
                    }
                    $asignacion->save();
                    $ficha = Card::find($fichaAsignacion);
                    $instructor = Instructor::find($instructorAsignacion);
                    $numeroficha = strval($ficha->numero);
                    $tituloevento = $numeroficha . '-' . $instructor->nombre . ' ' . $instructor->apellidos;
                    $descripcionevento = $asignacion->descripcion;
                    $evento->title = $tituloevento;
                    $evento->description = $descripcionevento;
                    $evento->start = $fechaInicio;
                    $evento->end = $fechaFin;
                    $evento->save();
                } else {
                    $asignacion->fk_instructor = $instructorAsignacion;
                    $asignacion->fk_ambiente = $ambienteAsignacion;
                    $asignacion->tipo = $tipoAsignacion;
                    if (empty($request->input('descripcionAsignacion'))) {
                        $asignacion->descripcion = " "; 
                    } else {
                        $asignacion->descripcion = $request->input('descripcionAsignacion');
                    }
                    $asignacion->save();
                    $tituloevento = $request->input('tituloEvento');
                    $descripcionevento = $asignacion->descripcion;
                    $evento->title = $tituloevento;
                    $evento->description = $descripcionevento;
                    $evento->start = $fechaInicio;
                    $evento->end = $fechaFin;
                    $evento->save();
                }
                return Redirect::route('eventos.index');
            }
        }
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
