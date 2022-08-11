<?php

namespace App\Http\Livewire\Programa;

use App\Models\Program;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class CrearPrograma extends Component
{

    public $codigo;
    public $nombre;
    public $duracionlectiva;
    public $duracionpractica;
    public $nivelformacion;
    public $perfilinstructor;
    public $totaltrimestres;
    public $descripcion;

    protected $rules = [
        'codigo' => 'required',
        'nombre' => 'required',
        'duracionlectiva' => 'required|numeric',
        'duracionpractica' => 'required|numeric',
        'nivelformacion' => 'required|alpha',
        'perfilinstructor' => 'required|string',
        'descripcion' => 'required|string'
    ];

    public function guardarPrograma()
    {
        $this->validate();
        $programa = new Program();
        $programa->codigo = $this->codigo;
        $programa->nombre = $this->nombre;
        $programa->duracionlectiva = $this->duracionlectiva;
        $programa->duracionpractica = $this->duracionpractica;
        $programa->nivelformacion = $this->nivelformacion;
        $programa->perfilinstructor = $this->perfilinstructor;
        $programa->totaltrimestres = ($this->duracionlectiva + $this->duracionpractica) / 3;
        $programa->descripcion = $this->descripcion;
        $programa->save();
        return Redirect::route('programas.index');
    }

    public function render()
    {
        return view('livewire.programa.crear-programa');
    }
}
