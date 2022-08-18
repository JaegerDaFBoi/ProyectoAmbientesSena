<?php

namespace App\Http\Livewire\Ficha;

use App\Models\Card;
use App\Models\Instructor;
use App\Models\Program;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class EditarFicha extends Component
{

    public $idficha;
    public $numero;
    public $programa;
    public $fechainicio;
    public $fechafin;
    public $jornada;
    public $modalidad;
    public $instructor;
    public $cantidad;

    protected $rules = [
        'numero' => 'required|numeric',
        'programa' => 'required',
        'jornada' => 'required',
        'modalidad' => 'required',
        'fechainicio' => 'required|date',
        'fechafin' => 'required|date',
        'instructor' => 'required',
        'cantidad' => 'required|numeric'
    ];

    public function mount($idficha)
    {
        $ficha = Card::where('id', $idficha)->where('isEliminated', false)->first();
        $this->idficha = $ficha->id;
        $this->numero = $ficha->numero;
        $this->programa = $ficha->fk_programa;
        $this->jornada = $ficha->jornada;
        $this->modalidad = $ficha->modalidad;
        $this->fechainicio = $ficha->fechainicio;
        $this->fechafin = $ficha->fechafin;
        $this->instructor = $ficha->fk_instructor;
        $this->cantidad = $ficha->cantidad;
    }


    public function editarFicha()
    {
        $this->validate(); 
        $ficha = Card::where('id', $this->idficha)->where('isEliminated', false)->first();
        $ficha->numero = $this->numero;
        $ficha->fk_programa = $this->programa;
        $ficha->jornada = $this->jornada;
        $ficha->modalidad = $this->modalidad;
        $ficha->fechainicio = $this->fechainicio;
        $ficha->fechafin = $this->fechafin;
        $ficha->fk_instructor = $this->instructor;
        $ficha->cantidad = $this->cantidad;
        $ficha->save();
        return Redirect::route('fichas.index');
    }

    public function render()
    {
        return view('livewire.ficha.editar-ficha', [
            'programas' => Program::where('isEliminated', false)->get(),
            'instructores' => Instructor::where('isEliminated', false)->get()
        ]);
    }
}
