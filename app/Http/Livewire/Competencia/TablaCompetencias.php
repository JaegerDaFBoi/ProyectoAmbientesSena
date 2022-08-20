<?php

namespace App\Http\Livewire\Competencia;

use App\Models\Competence;
use Livewire\Component;

class TablaCompetencias extends Component
{

    public $programa;

    public function mount($programa)
    {
        $this->programa = $programa;
    }

    public function render()
    {
        return view('livewire.competencia.tabla-competencias', [
            'competencias' => $this->programa->competencias()->get()
        ]);
    }
}
