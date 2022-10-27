<?php

namespace App\Http\Livewire\Asignacion;

use Livewire\Component;

class EditarAsignacion extends Component
{

    public $evento;

    public function mount($evento){
        $this->evento = $evento;
    }

    public function render()
    {
        return view('livewire.asignacion.editar-asignacion');
    }
}
