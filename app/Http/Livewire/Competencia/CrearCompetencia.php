<?php

namespace App\Http\Livewire\Competencia;

use Livewire\Component;

class CrearCompetencia extends Component
{

    public $mostrar = false;
    public $programa;
    public $idprograma;
    public $codigo;
    public $descripcion;

    public function mount($programa)
    {
        $this->programa = $programa;
    }

    public function mostrarFormulario()
    {
        $this->mostrar = true;
    }

    public function render()
    {
        return view('livewire.competencia.crear-competencia');
    }
}
