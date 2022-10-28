<?php

namespace App\Http\Livewire\Asignacion;

use App\Models\Assignment;
use App\Models\Card;
use App\Models\Competence;
use App\Models\Environment;
use App\Models\Event;
use App\Models\Instructor;
use App\Models\LearningOutcome;
use App\Models\Program;
use Livewire\Component;

class EditarAsignacion extends Component
{

    public $evento;
    public $tipoAsignacion;
    public $fichaSeleccionada;
    public $programaFormacion;
    public $competencias;
    public $competenciaSeleccionada;
    public $competenciaAsignacion;
    public $resultados;
    public $resultadoSeleccionado;
    public $resultadoAsignacion;
    public $tituloEvento;
    public $descripcionEvento;
    public $instructorSeleccionado;
    public $ambienteSeleccionado;

    public function mount($idevento)
    {
        $this->evento = Event::find($idevento);
        $asignacion = Assignment::find($this->evento->fk_assignment);
        $this->tipoAsignacion = $asignacion->tipo;
        $this->instructorSeleccionado = $asignacion->fk_instructor;
        $this->ambienteSeleccionado = $asignacion->fk_ambiente;
        if ($this->tipoAsignacion == "Titulada") {
            $this->fichaSeleccionada = $asignacion->fk_ficha;
            $ficha = Card::find($this->fichaSeleccionada);
            $this->programaFormacion = Program::where('id', $ficha->fk_programa)->first();
            $this->competencias = Competence::where('fk_programa', $this->programaFormacion->id)->get();
            $this->competenciaSeleccionada = $asignacion->fk_competencia;
            $this->competenciaAsignacion = Competence::where('id', $this->competenciaSeleccionada)->first();
            $this->resultados = LearningOutcome::where('fk_competencia', $this->competenciaAsignacion->id)->get();
            $this->resultadoSeleccionado = $asignacion->fk_resultado;
            $this->resultadoAsignacion = LearningOutcome::where('id', $this->resultadoSeleccionado)->first();
        } else {
            $this->tituloEvento = $this->evento->title;
        }
        $this->descripcionEvento = $asignacion->descripcion;
    }

    public function seleccionarPrograma()
    {
        $ficha = Card::find($this->fichaSeleccionada);
        $this->programaFormacion = Program::where('id', $ficha->fk_programa)->first();
        $this->competencias = Competence::where('fk_programa', $this->programaFormacion->id)->get();
    }

    public function seleccionarResultados()
    {
        $this->competenciaAsignacion = Competence::where('id', $this->competenciaSeleccionada)->first();
        $this->resultados = LearningOutcome::where('fk_competencia', $this->competenciaSeleccionada)->get();
    }

    public function asignarResultado()
    {
        $this->resultadoAsignacion = LearningOutcome::where('id', $this->resultadoSeleccionado)->first();
    }

    public function render()
    {
        return view('livewire.asignacion.editar-asignacion', [
            'fichas' => Card::where('isEliminated', false)->get(),
            'instructores' => Instructor::where('isEliminated', false)->get(),
            'ambientes' => Environment::where('isEliminated', false)->get()
        ]);
    }
}
