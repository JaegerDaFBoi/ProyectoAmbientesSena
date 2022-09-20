<?php

namespace App\Http\Livewire\Eventos;

use App\Models\Card;
use App\Models\Competence;
use App\Models\Environment;
use App\Models\Instructor;
use App\Models\LearningOutcome;
use App\Models\Program;
use Livewire\Component;

class CrearEvento extends Component
{

    public $formularioEvento = false;
    public $fichaSeleccionada;
    public $programaFormacion;
    public $competencias;
    public $competenciaSeleccionada;
    public $competenciaAsignacion;
    public $resultados;
    public $resultadoSeleccionado;
    public $resultadoAsignacion;
    public $instructorSeleccionado;
    public $ambienteSeleccionado;

    public function mostrarFormulario()
    {
        $this->formularioEvento = true;
    }

    public function seleccionarPrograma()
    {
        $ficha = Card::where('id', $this->fichaSeleccionada)->first();
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
        return view('livewire.eventos.crear-evento', [
            'fichas' => Card::where('isEliminated', false)->get(),
            'instructores' => Instructor::where('isEliminated', false)->get(),
            'ambientes' => Environment::where('isEliminated', false)->get()
        ]);
    }
}
