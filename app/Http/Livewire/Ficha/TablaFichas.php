<?php

namespace App\Http\Livewire\Ficha;

use App\Models\Card;
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
        $this->instructor = $ficha->instructor->nombre . ' ' . $ficha->instructor->apellidos;
        $this->cantidad = $ficha->cantidad;
    }

    public function render()
    {
        return view('livewire.ficha.tabla-fichas');
    }
}
