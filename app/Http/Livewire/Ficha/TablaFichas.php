<?php

namespace App\Http\Livewire\Ficha;

use App\Models\Card;
use App\Models\Instructor;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class TablaFichas extends Component
{

    public $fichas;
    public $mostrarficha = false;
    public $numero;
    public $programa;
    public $jornada;
    public $modalidad;
    public $fechainicio;
    public $fechafin;
    public $instructor;
    public $cantidad;

    public function mount($fichas)
    {
        $this->fichas = $fichas;
    }

    public function mostrar($id)
    {
        $this->mostrarficha = true;
        $ficha = Card::where('isEliminated', false)->where('id', $id)->first();
        $this->numero = $ficha->numero;
        $this->programa = $ficha->programa->nombre;
        $this->jornada = $ficha->jornada;
        $this->modalidad = $ficha->modalidad;
        $this->fechainicio = $ficha->fechainicio;
        $this->fechafin = $ficha->fechafin;
        $instructor = Instructor::where('isEliminated', false)->where('id', $ficha->fk_instructor)->first();
        $nombre = $instructor->nombre . " " . $instructor->apellidos;
        $this->instructor = $nombre;
        $this->cantidad = $ficha->cantidad;
    }

    public function eliminarFicha($id)
    {
        $ficha = Card::where('isEliminated', false)->where('id', $id)->first();
        $ficha->isEliminated = true;
        $ficha->save();
        return Redirect::route('fichas.index');
    }

    public function render()
    {
        return view('livewire.ficha.tabla-fichas');
    }
}
