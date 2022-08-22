<?php

namespace App\Http\Livewire\Competencia;

use App\Models\Competence;
use App\Models\LearningOutcome;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class TablaCompetencias extends Component
{

    public $programa;
    public $mostrarEditar = false;
    public $mostrarResultados = false;
    public $idprograma;
    public $idcompetencia;
    public $codigo;
    public $descripcion;
    public $resultados;

    protected $rules = [
        'idprograma' => 'required',
        'codigo' => 'required',
        'descripcion' => 'required'
    ];

    public function mount($programa)
    {
        $this->programa = $programa;
        $this->idprograma = $programa->id;
    }

    public function mostrarEditar($id)
    {
        $this->mostrarEditar = true;
        $this->mostrarResultados = false;
        $competencia = Competence::where('isEliminated', false)->where('id', $id)->first();
        $this->idcompetencia = $competencia->id;
        $this->codigo = $competencia->codigo;
        $this->descripcion = $competencia->descripcion;
        $this->idprograma = $competencia->fk_programa;
        
    }

    public function cerrar()
    {
        $this->mostrarEditar = false;
    }

    public function guardarCompetencia()
    {
        $this->validate();
        $competencia = Competence::where('isEliminated', false)->where('id', $this->idcompetencia)->first();
        $competencia->codigo = $this->codigo;
        $competencia->descripcion = $this->descripcion;
        $competencia->fk_programa = $this->idprograma;
        $competencia->save();
        return Redirect::route('competencias.index', ['idprograma' => $this->idprograma]);
    }

    public function borrarCompetencia($id)
    {
        $competencia = Competence::where('isEliminated', false)->where('id', $id)->first();
        $competencia->isEliminated = true;
        $competencia->save();
        return Redirect::route('competencias.index', ['idprograma' => $this->idprograma]);
    }

    public function mostrarResultados($id)
    {
        $competencia = Competence::where('isEliminated', false)->where('id', $id)->first();
        $this->idcompetencia = $competencia->id;
        $this->codigo = $competencia->codigo;
        $this->resultados = LearningOutcome::where('isEliminated', false)->where('fk_competencia', $id)->get();
        $this->mostrarEditar = false;
        $this->mostrarResultados = true;
    }

    public function render()
    {
        return view('livewire.competencia.tabla-competencias', [
            'competencias' => $this->programa->competencias()->where('isEliminated', false)->get()
        ]);
    }
}
