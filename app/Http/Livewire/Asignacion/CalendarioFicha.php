<?php

namespace App\Http\Livewire\Asignacion;

use Livewire\Component;

class CalendarioFicha extends Component
{

    public $events;

    public function mount($events)
    {
        $this->events = json_encode($events);
    }

    public function render()
    {
        return view('livewire.asignacion.calendario-ficha');
    }
}
