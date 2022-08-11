<?php

namespace App\Http\Livewire\Ambiente;

use App\Models\Environment;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class TablaAmbientes extends Component
{
    public $ambientes;
    public $mostrar = false;
    public $idambiente;
    public $nombre;
    public $tipo;
    public $aforo;

    protected $rules = [
        'nombre' => 'required|alpha_num',
        'tipo' => 'required',
        'aforo' => 'required|numeric'
    ];

    public function mount($ambientes)
    {
        $this->ambientes = $ambientes;
    }

    public function mostrarEdicion($id){
        $this->mostrar = true;
        $ambiente = Environment::where('isEliminated', false)->where('id', $id)->first();
        $this->idambiente = $ambiente->id;
        $this->nombre = $ambiente->nombre;
        $this->tipo = $ambiente->tipo;
        $this->aforo = $ambiente->aforo;
    }

    public function cerrar()
    {
        $this->mostrar = false;
    }

    public function editarAmbiente()
    {
        $this->validate();
        $ambiente = Environment::where('isEliminated', false)->where('id', $this->idambiente)->first();
        $ambiente->nombre = $this->nombre;
        $ambiente->tipo = $this->tipo;
        $ambiente->aforo = $this->aforo;
        $ambiente->save();
        return Redirect::route('ambientes.index');
    }

    public function render()
    {
        return view('livewire.ambiente.tabla-ambientes');
    }
}
