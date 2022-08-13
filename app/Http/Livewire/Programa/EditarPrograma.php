<?php

namespace App\Http\Livewire\Programa;

use App\Models\Program;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class EditarPrograma extends Component
{
    public $idprograma;
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

    public function mount($programa)
    {
        $this->idprograma = $programa->id;
        $this->codigo = $programa->codigo;
        $this->nombre = $programa->nombre;
        $this->duracionlectiva = $programa->duracionlectiva;
        $this->duracionpractica = $programa->duracionpractica;
        $this->nivelformacion = $programa->nivelformacion;
        $this->perfilinstructor = $programa->perfilinstructor;
        $this->totaltrimestres = $programa->totaltrimestres;
        $this->descripcion = $programa->descripcion;
    }

    public function editarPrograma($idprograma)
    {
        $this->validate();
        $programa = Program::where('isEliminated', false)->where('id', $idprograma)->first();
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
        return view('livewire.programa.editar-programa');
    }
}
