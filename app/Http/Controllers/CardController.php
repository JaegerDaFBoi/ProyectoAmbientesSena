<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Card;
use App\Models\Competence;
use App\Models\Environment;
use App\Models\Event;
use App\Models\Instructor;
use App\Models\LearningOutcome;
use App\Models\Program;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
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
    public function show(Card $ficha)
    {
        $ids = [];
        $assignments = Assignment::where('fk_ficha', $ficha->id)->get();
        foreach ($assignments as $assignment) {
            array_push($ids, $assignment->id);
        }
        $events = Event::select()->whereIn('fk_assignment', $ids)->get();
        return view('fichas.horarios',compact('events', 'ficha'));
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

    /**
     * Display a list of ievents by instructor in a table.
     *
     * @param \App\Models\Card $ficha
     * @return \Illuminate\Http\Response
     */
    public function listEvents(Card $ficha)
    {
        $eventosaMostrar = new Collection();
        $eventos = Event::whereIn(
            'fk_assignment',
            Assignment::select('id')->where('fk_ficha', $ficha->id)
            ->get()->toArray()
        )->orderBy('start', 'DESC')
        ->get();
        foreach ($eventos as $evento) {
            $fecha = $evento->start;
            $newfecha = Carbon::parse($fecha)->format('d/m/Y');
            $horainicio = $evento->start;
            $horafin = $evento->end;
            $newhorainicio = Carbon::parse($horainicio)->format('h:i A');
            $newhorafin = Carbon::parse($horafin)->format('h:i A');
            $asignacion = Assignment::find($evento->fk_assignment);
            $instructor = Instructor::find($asignacion->fk_instructor);
            $nombreinstructor = $instructor->nombre . " " . $instructor->apellidos;
            $ambiente = Environment::find($asignacion->fk_ambiente);
            $nombreambiente = $ambiente->nombre;
            $competencia = Competence::find($asignacion->fk_competencia);
            $codigocompetencia = $competencia->codigo;
            if (empty($eventosaMostrar)) {
                $eventosaMostrar = collect([[
                    'fechaevento' => $newfecha,
                    'horainicio' => $newhorainicio,
                    'horafin' => $newhorafin,
                    'nombreinstructor' => $nombreinstructor,
                    'nombreambiente' => $nombreambiente,
                    'codigocompetencia' => $codigocompetencia
                ]]);
            } else {
                $eventosaMostrar->push([
                    'fechaevento' => $newfecha,
                    'horainicio' => $newhorainicio,
                    'horafin' => $newhorafin,
                    'nombreinstructor' => $nombreinstructor,
                    'nombreambiente' => $nombreambiente,
                    'codigocompetencia' => $codigocompetencia
                ]);
            }
        }
        return view('fichas.listahorarios', compact('ficha', 'eventosaMostrar'));
    }
}
