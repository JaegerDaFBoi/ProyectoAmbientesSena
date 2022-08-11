<?php

namespace App\Http\Livewire\Ambiente;

use App\Models\Environment;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class CrearAmbiente extends Component
{

    public $mostrarFormulario = false;
    public $nombre;
    public $tipo;
    public $aforo;

    protected $rules = [
        'nombre' => 'required|alpha_num',
        'tipo' => 'required',
        'aforo' => 'required|numeric'
    ];

    public function guardarAmbiente()
    {
        $this->validate();
        $ambiente = new Environment();
        $ambiente->nombre = $this->nombre;
        $ambiente->tipo = $this->tipo;
        $ambiente->aforo = $this->aforo;
        $ambiente->save();
        return Redirect::route('ambientes.index');
    }

    public function mostrar()
    {
        $this->mostrarFormulario = true;
    }

    public function cerrar()
    {
        $this->mostrarFormulario = false;
    }

    public function render()
    {
        return view('livewire.ambiente.crear-ambiente');
    }
}
