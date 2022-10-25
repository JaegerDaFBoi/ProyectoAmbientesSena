<?php

namespace App\Http\Livewire\Asignacion;

use Livewire\Component;

class EditarAsignacion extends Component
{

    public $fechainicio;
    public $fechafin;

    public function mount($evento)
    {
        $this->fechainicio = $evento->start;
        $this->fechafin = $evento->end;
    }

    public function render()
    {
        return view('livewire.asignacion.editar-asignacion');
    }
}
