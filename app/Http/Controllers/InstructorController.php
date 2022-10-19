<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Card;
use App\Models\Competence;
use App\Models\Event;
use App\Models\Instructor;
use App\Models\LearningOutcome;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('instructores.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('instructores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function show(Instructor $instructor)
    {
        $ids = [];
        $assignments = Assignment::where('fk_instructor', $instructor->id)->get();
        foreach ($assignments as $assignment) {
            array_push($ids, $assignment->id);
        }
        $events = Event::select()->whereIn('fk_assignment', $ids)->get();
        json_encode($events);
        return view('instructores.horarios', compact('events', 'instructor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instructor $instructor)
    {
        return view('instructores.edit', compact('instructor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Instructor $instructor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instructor  $instructor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Instructor $instructor)
    {
        //
    }

    /**
     * Search for an event with assignment information
     * 
     * @param \App\Models\Event $eventid
     * @return \Illuminate\Http\Response
     */
    public function searchEvent($eventid)
    {
        $data = [];
        $event = Event::find($eventid);
        $assignment = Assignment::where('id', $event->fk_assignment)->first();
        if ($assignment->tipo == "Complementaria" || $assignment->tipo == "Adicionales") {
            $instructor = $assignment->instructor;
            $ambiente = $assignment->ambiente->nombre;
            $nombreinstructor = $instructor->nombre . " " . $instructor->apellidos;
            $titulo = $event->title;
            if (empty($event->description)) {
                $descripcion = " ";
            } else {
                $descripcion = $event->description;
            }
            $fecha = $event->start;
            $newfecha = Carbon::parse($fecha)->format('d/m/Y');
            $horainicio = $event->start;
            $horafin = $event->end;
            $newhorainicio = Carbon::parse($horainicio)->format('h:i A');
            $newhorafin = Carbon::parse($horafin)->format('h:i A');
            $data['idevento'] = $event->id;
            $data['fecha'] = $newfecha;
            $data['inicioevento'] = $newhorainicio;
            $data['finevento'] = $newhorafin;
            $data['instructor'] = $nombreinstructor;
            $data['ambiente'] = $ambiente;
            $data['titulo'] = $titulo;
            $data['descripcion'] = $descripcion;
            $data['tipo'] = $assignment->tipo;
        } else {
            $instructor = $assignment->instructor;
            $ficha = $assignment->ficha;
            $programa = $ficha->programa->nombre;
            $competencia = Competence::where('id', $assignment->fk_competencia)->first();
            $descripcioncompetencia = $competencia->descripcion;
            $resultado = LearningOutcome::where('id', $assignment->fk_resultado)->first();
            $descripcionresultado = $resultado->descripcion;
            $ambiente = $assignment->ambiente->nombre;
            $nombreinstructor = $instructor->nombre . " " . $instructor->apellidos;
            if (empty($event->description)) {
                $descripcion = " ";
            } else {
                $descripcion = $event->description;
            }
            $fecha = $event->start;
            $newfecha = Carbon::parse($fecha)->format('d/m/Y');
            $horainicio = $event->start;
            $horafin = $event->end;
            $newhorainicio = Carbon::parse($horainicio)->format('h:i A');
            $newhorafin = Carbon::parse($horafin)->format('h:i A');
            $data['idevento'] = $event->id;
            $data['fecha'] = $newfecha;
            $data['inicioevento'] = $newhorainicio;
            $data['finevento'] = $newhorafin;
            $data['instructor'] = $nombreinstructor;
            $data['ficha'] = $ficha->numero;
            $data['programa'] = $programa;
            $data['competencia'] = $descripcioncompetencia;
            $data['resultado'] = $descripcionresultado;
            $data['ambiente'] = $ambiente;
            $data['descripcion'] = $descripcion;
            $data['tipo'] = $assignment->tipo;
        }

        return response()->json($data);
    }
}
