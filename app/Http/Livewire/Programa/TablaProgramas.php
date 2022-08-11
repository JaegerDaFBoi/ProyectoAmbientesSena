<?php

namespace App\Http\Livewire\Programa;

use App\Models\Program;
use Livewire\Component;

class TablaProgramas extends Component
{

    public $info = false;
    public $codigo;
    public $nombre;
    public $duracionlectiva;
    public $duracionpractica;
    public $nivelformacion;
    public $perfilinstructor;
    public $totaltrimestres;
    public $descripcion;

    public function mostrarInfo($id)
    {
        $this->info = true;
        $programa = Program::where('isEliminated', false)->where('id', $id)->first();
        $this->codigo = $programa->codigo;
        $this->nombre = $programa->nombre;
        $this->duracionlectiva = $programa->duracionlectiva;
        $this->duracionpractica = $programa->duracionpractica;
        $this->nivelformacion = $programa->nivelformacion;
        $this->perfilinstructor = $programa->perfilinstructor;
        $this->totaltrimestres = $programa->totaltrimestres;
        $this->descripcion = $programa->descripcion;
    }

    public function cerrar()
    {
        $this->info = false;
    }

    public function render()
    {
        return view('livewire.programa.tabla-programas', [
            'programas' => Program::where('isEliminated', false)->get()
        ]);
    }
}
