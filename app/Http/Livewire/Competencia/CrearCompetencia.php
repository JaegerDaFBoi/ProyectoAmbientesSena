<?php

namespace App\Http\Livewire\Competencia;

use App\Models\Competence;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class CrearCompetencia extends Component
{

    public $mostrar = false;
    public $programa;
    public $idprograma;
    public $codigo;
    public $descripcion;

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

    public function mostrarFormulario()
    {
        $this->mostrar = true;
    }

    public function cerrar()
    {
        $this->mostrar = false;
    }

    public function guardarCompetencia()
    {
        $this->validate();
        $competencia = new Competence();
        $competencia->codigo = $this->codigo;
        $competencia->descripcion = $this->descripcion;
        $competencia->fk_programa = $this->idprograma;
        $competencia->save();
        return Redirect::route('competencias.index', ['idprograma' => $this->idprograma]);
    }

    public function render()
    {
        return view('livewire.competencia.crear-competencia');
    }
}
