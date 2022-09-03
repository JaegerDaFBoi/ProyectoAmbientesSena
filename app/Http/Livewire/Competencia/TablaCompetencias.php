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
    public $editarResultado = false;
    public $mostrarResultados = false;
    public $idprograma;
    public $idcompetencia;
    public $codigo;
    public $descripcion;
    public $resultados;
    public $idresultado;
    public $descripcionresultado;
    public $trimestreasignacion;
    public $trimestreevaluacion;
    public $horassemana;

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

    public function editarResultado($id)
    {
      $resultado = LearningOutcome::where('isEliminated', false)->where('id', $id)->first();
      $this->editarResultado = true;
      $this->idresultado = $id;
      $this->idcompetencia = $resultado->fk_competencia;
      $this->descripcionresultado = $resultado->descripcion;
      $this->trimestreasignacion = $resultado->trimestreasignacion;
      $this->trimestreevaluacion = $resultado->trimestreevaluacion;
      $this->horassemana = $resultado->horassemana;
    }

    public function guardarResultado()
    {
      $resultado = LearningOutcome::where('isEliminated', false)->where('id', $this->idresultado)->first();
      $resultado->descripcion = $this->descripcionresultado;
      $resultado->trimestreasignacion = $this->trimestreasignacion;
      $resultado->trimestreevaluacion = $this->trimestreevaluacion;
      $resultado->horassemana = $this->horassemana;
      $resultado->fk_competencia = $this->idcompetencia;
      $resultado->save();
      return Redirect::route('competencias.index', ['idprograma' => $this->idprograma]);

    }

    public function borrarResultado($id)
    {
      $resultado = LearningOutcome::where('isEliminated', false)->where('id', $id)->first();
      $resultado->isEliminated = true;
      $resultado->save();
      return Redirect::route('competencias.index', ['idprograma' => $this->idprograma]);
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
