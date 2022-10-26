<?php

namespace App\Http\Livewire\Asignacion;

use App\Models\Assignment;
use App\Models\Card;
use App\Models\Competence;
use App\Models\Event;
use App\Models\LearningOutcome;
use App\Models\Program;
use Livewire\Component;

class EditarAsignacion extends Component
{

    public $evento;
    public $fichaSeleccionada;
    public $programaFormacion;
    public $competencias;
    public $competenciaSeleccionada;
    public $resultados;
    public $resultadoSeleccionado;
    public $competenciaAsignacion;
    public $resultadoAsignacion;

    public function mount($evento)
    {
        $this->evento = $evento;
        $asignacion = Assignment::find($this->evento->fk_assignment);
        $this->fichaSeleccionada = $asignacion->fk_ficha;
        $ficha = Card::find($this->fichaSeleccionada);
        $this->programaFormacion = Program::where('id', $ficha->fk_programa)->first();
        $this->competencias = Competence::where('fk_programa', $this->programaFormacion->id)->get();
        $this->competenciaSeleccionada = $asignacion->fk_competencia;
        $this->competenciaAsignacion = Competence::where('id', $this->competenciaSeleccionada)->first();
        if ($this->competenciaSeleccionada) {
            $this->resultados = LearningOutcome::where('fk_competencia', $this->competenciaSeleccionada)->get();
            $this->resultadoSeleccionado = $asignacion->fk_resultado;
            $this->resultadoAsignacion = LearningOutcome::where('id', $this->resultadoSeleccionado)->first();
        }
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
            'fichas' => Card::where('isEliminated', false)->get()
        ]);
    }
}
